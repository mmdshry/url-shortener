<?php

namespace Database\Seeders;

use App\Models\Urls;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Urls::factory()->count(100)->create();
    }
}
