<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'foo@bar.com'
            ], [
                'name' => 'Foo',
                'email' => 'foo@bar.com',
                'password' => '12345678',
            ]
        );

        User::factory()
            ->count(20)
            ->create();
    }
}
