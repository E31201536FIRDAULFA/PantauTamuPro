<?php
namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'bayu',
            'email' => 'bayu@gmail.com',
            'password' => bcrypt('admin'),
            'username' => 'bayu123',
            'alamat' => 'Jl. Contoh No. 123',
            'no_telepon' => '08123456789',
            'tanggal_lahir' => '1990-01-01',
        ]);
    }
}
