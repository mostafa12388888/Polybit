<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class UpdateAddressesSettingValue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-addresses-setting-value';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update addresses setting value form old address setting';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $address = json_decode(setting('address'), true) ?: [];
        } catch (\Exception $e) {
            $address = [];
        }

        foreach (array_filter($address) as $locale => $value) {
            $addresses[$locale][] = [
                'location_name' => null,
                'address' => $value,
            ];
        }

        if ($addresses ?? null) {
            setting(['addresses' => $addresses]);
        }

        Setting::where('key', 'address')->delete();

        $this->info('Addresses setting value updated successfully.');
    }
}
