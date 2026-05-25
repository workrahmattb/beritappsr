<?php

namespace App\Console\Commands;

use App\Services\ArticleService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:publish-scheduled-articles')]
#[Description('Publish articles that have reached their scheduled publish time')]
class PublishScheduledArticles extends Command
{
    public function handle(ArticleService $articleService)
    {
        $count = $articleService->publishScheduledArticles();

        if ($count > 0) {
            $this->info("Successfully published {$count} scheduled article(s).");
        } else {
            $this->info('No articles ready for scheduled publishing.');
        }

        return Command::SUCCESS;
    }
}