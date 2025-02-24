<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class UpdateAuthPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-auth-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the slug of the auth pages because curator picker thinks that it\'s filament auth pages and doesn\'t work';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pages = Page::whereIn('slug', ['login', 'register'])->get();

        foreach ($pages as $page) {
            $page->slug = 'auth-'.$page->slug;
            $page->save();
        }
    }
}
