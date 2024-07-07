<?php

namespace App\StardewWatcher\Services;

use App\Events\WebsiteStatusChanged;
use App\Models\Checkup;
use App\Models\CheckupResult;
use App\Models\Website;
use App\StardewWatcher\Checkups\HasBasicAuth;
use App\StardewWatcher\Checkups\HasBlockingRobots;
use App\StardewWatcher\Checkups\HasHTML;
use App\StardewWatcher\Checkups\IsAvailableCheckup;
use App\StardewWatcher\Enums\CheckupType;
use App\StardewWatcher\Enums\WebsiteStatus;
use Psr\Log\LoggerInterface;

class CheckupService
{
    public function __construct(protected LoggerInterface $logger)
    {
    }

    public function checkWebsite(Website $website)
    {
        $checkups = $website->checkups()
            ->whereNull('next_checkup')
            ->orWhere('next_checkup', '>=', now())
            ->get();

        if ($checkups->isEmpty()) {
            return;
        }

        $checkupStatus = WebsiteStatus::Ok;
        foreach ($checkups as $checkup) {
            $checkupResult = $this->processCheckup($checkup, $website);

            if (!$checkupResult) {
                $checkupStatus = WebsiteStatus::Fail;
            }

            $this->recordCheckupResult(checkup: $checkup, website: $website, success: $checkupResult);
        }

        if ($website->status !== $checkupStatus) {
            $oldStatus = $website->status;
            $website->status = $checkupStatus;
            $website->save();
            WebsiteStatusChanged::dispatch($website, $oldStatus, $checkupStatus);
        }
    }

    public function processCheckup(Checkup $checkup, Website $website): bool
    {
        try {
            $checkupAction = match ($checkup->type) {
                CheckupType::IsAvailable => new IsAvailableCheckup(),
                CheckupType::HasBasicAuth => new HasBasicAuth(),
                CheckupType::HasBlockingRobots => new HasBlockingRobots(),
                CheckupType::HasHtml => new HasHTML('some'),
                default => throw new \Exception('Неизвестная проверка - ' . $checkup->type->value)
            };
            return $checkupAction->run($website);
        } catch (\Exception $ex) {
            $this->logger->error(
                'Исключение при выполнении проверки',
                ['exception' => $ex, 'checkup' => $checkup, 'website' => $website->toArray()]
            );
            return false;
        }
    }

    protected function recordCheckupResult(Checkup $checkup, Website $website, bool $success): void
    {
        CheckupResult::create([
            'checkup_id' => $checkup->id,
            'website_id' => $website->id,
            'passed' => $success
        ]);
    }
}
