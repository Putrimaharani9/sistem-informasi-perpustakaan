<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'app_name',
                'default_value' => 'Sistem Informasi Perpustakaan',
                'name' => 'Nama Aplikasi',
                'type' => Setting::SYSTEM_TYPE
            ],
            [
                'key' => 'app_icon',
                'default_value' => 'icon.png',
                'description' => 'Nama file, Simpan icon pada public/img',
                'name' => 'Ikon Aplikasi',
                'type' => Setting::SYSTEM_TYPE
            ],
            [
                'key' => 'app_cover',
                'default_value' => 'cover.png',
                'description' => 'Nama file, Simpan icon pada public/img',
                'name' => 'Cover Aplikasi',
                'type' => Setting::SYSTEM_TYPE
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
