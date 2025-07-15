<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Buat user beserta rolenya jika belum ada.
     */
    private function createUser(string $name, string $email, int $createdBy, string $role): User
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'created_by' => $createdBy,
            ]
        );

        // Pastikan role ditambahkan (walau user-nya sudah ada)
        if (!$user->hasRole($role)) {
            $user->assignRole($role);
        }

        return $user;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan semua role sudah tersedia
        $roles = ['developer', 'admin', 'staff', 'member'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Developer (Super Admin)
        $superAdmin = User::factory()->create([
            'name' => 'Developer',
            'email' => 'developer@demo.com',
            'phone_number' => '081234567890', // tambahkan ini
            'created_by' => 0,
        ])->assignRole('developer');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'adminsip@demo.com',
            'phone_number' => '081234567891', // tambahkan ini
            'created_by' => $superAdmin->id
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@demo.com',
            'phone_number' => '081234567892', // tambahkan ini
            'created_by' => $superAdmin->id
        ])->assignRole('staff');

        User::factory()->create([
            'name' => 'Arza',
            'email' => 'member@demo.com',
            'phone_number' => '081234567893', // tambahkan ini
            'created_by' => $superAdmin->id
        ])->assignRole('member');

    }
}
