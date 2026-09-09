<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('apps')->truncate();

        DB::table('apps')->insert([
            [
                'name' => 'Continuous Medical Education',
                'code' => 'cme',
                'description' => 'Continuous Medical Education System (CME)',
                'icon' => '🩺',
                'url' => 'http://10.1.25.135/cme/sso-login.php',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'i-Monitor Pharmacy System',
                'code' => 'imonitor',
                'description' => 'Pharmacy Monitoring System',
                'icon' => '💊',
                'url' => 'http://10.1.25.135/imonitor/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Incident Reporting',
                'code' => 'ir',
                'description' => 'Incident Reporting System',
                'icon' => '⚠️',
                'url' => 'http://10.1.25.135/ir/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}