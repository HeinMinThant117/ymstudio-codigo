<?php

namespace Database\Seeders;

use App\Models\ClassPack;
use App\Models\Promocode;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Promocode::factory(5)->create();
        ClassPack::factory(9)->create();
    }
}
