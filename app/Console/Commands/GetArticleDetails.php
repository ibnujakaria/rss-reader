<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class GetArticleDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:get-article-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabbing the picture, title, and body of an article';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $articles = Article::noDetail()->get();

        foreach ($articles as $key => $article) {
            $this->info("Grabbing the detail of {$article->title} at {$article->link}");
            $article->getAndKeepTheDetail();
        }
    }
}
