<?php

namespace App\Console\Commands;

use App\Models\Site;
use Illuminate\Console\Command;

class UpdateArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the articles of sites stored on the app';

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
        $sites = Site::all();
        
        foreach ($sites as $key => $site) {
            $this->line("Grabbing newest articles of {$site->url}");
            
            $isNew = Site::grabNewestArticlesOf($site->url);
            
            if ($isNew) {
                $this->info('There is an update');
            } else {
                $this->line("There is no update");
            }
            $this->line('');
        }
    }
}
