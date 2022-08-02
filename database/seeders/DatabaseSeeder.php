<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Role::create(["id"=>"1","tag"=> "مدیر کل سایت"]);
        \App\Models\Role::create(["id"=>"2","tag"=> "مدیر نمایش"]);
        \App\Models\Role::create(["id"=>"3","tag"=> "کاربر عادی"]);
        // \App\Models\User::factory(10)->create();
    }
}
