<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::first();

        $data = [
            [
                'name' => 'Andi Wijaya',
                'address' => 'Jl. Merdeka No. 10, Surabaya, Jawa Timur',
                'phone_number' => '081234567890',
                'email' => 'andi.wijaya@email.com',
            ],
            [
                'name' => 'Siti Rahmawati',
                'address' => 'Jl. Pahlawan No. 45, Malang, Jawa Timur',
                'phone_number' => '082345678901',
                'email' => 'siti.rahmawati@email.com',
            ]
        ];

        foreach ($data as $member) {
            $password = Str::random(10); // Generate password random 10 karakter

            $user = User::firstOrCreate(
                ['email' => $member['email']], // Cek berdasarkan email
                [
                    'name' => $member['name'],
                    'address' => $member['address'],
                    'phone_number' => $member['phone_number'],
                    'password' => Hash::make($password),
                    'created_by' => $superAdmin->id,
                ]
            );

            if (!$user->hasRole('member')) {
                $user->assignRole('member');
            }

            // Tampilkan password di console
            $this->command->info("User {$member['email']} password: {$password}");
        }
    }
}
