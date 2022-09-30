<?php

namespace Database\Seeders;

use App\Models\Army;
use Illuminate\Database\Seeder;

class ArmySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Army::factory()->count(400)->create();
    }
}
