<?php
namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Admin;
=======
use App\Models\User;
>>>>>>> 1518b7b6e3b34bf4f6752cfcbb6d72ef7dcea744

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

    }
}
