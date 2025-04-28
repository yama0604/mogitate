<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        $seasons = ['spring', 'summer', 'autumn', 'winter'];
        foreach ($seasons as $name) {
            Season::create(['name' => $name]);
        }
    }
}
