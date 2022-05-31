<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'Satrio Setiawan I Lintang',
            'username'   => '88102332',
            'email'      => 'tio@gmail.com',
            'perusahaan' => 'PT IMIP',
            'divisi'     => 'IT - APPLICATION DEVELOPMENT',
            'password'   => bcrypt('12345678'),
        ]);

        // \App\Models\User::factory(4)->create();
        // \App\Models\User::factory(10)->create();
    }
}
