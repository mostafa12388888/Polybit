<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class BuildAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the assets for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! file_exists(base_path('theme.json'))) {
            return;
        }

        $theme = [
            'applied' => false,
            'colors' => [],
        ];

        try {
            $theme = file_get_contents(base_path('theme.json'));
            $theme = json_decode($theme, true);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $theme_applied = ! isset($theme['applied']) || $theme['applied'];

        if ($theme_applied) {
            return;
        }

        $process = Process::fromShellCommandline('export PATH=$PATH:./node_modules/.bin:~/node/bin && npm run build')
            ->setWorkingDirectory(base_path());

        $process->run();

        $this->info($process->getOutput());

        if ($error = $process->getErrorOutput()) {
            $this->error($error);
        }

        if (stripos($process->getOutput(), '✓ built') === false) {
            return;
        }

        $theme['applied'] = true;

        file_put_contents(base_path('theme.json'), json_encode($theme, JSON_PRETTY_PRINT));
    }
}
