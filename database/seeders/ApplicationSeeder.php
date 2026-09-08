<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {

        Application::create([
            'name' => 'Continuous Medical Education',

            'code' => 'cme',

            'description' =>
                'Continuous Medical Education System',

            'server_ip' =>
                '10.1.25.135',

            'url' =>
                'http://10.1.25.135/cme',

            'icon' =>
                '📚',

            'active' =>
                true,

            'sso_type' =>
                'token',
        ]);


        Application::create([
            'name' => 'Incident Reporting',

            'code' => 'ir',

            'description' =>
                'Incident Reporting System',

            'server_ip' =>
                '10.1.25.135',

            'url' =>
                'http://10.1.25.135/ir',

            'icon' =>
                '⚠️',

            'active' =>
                true,

            'sso_type' =>
                'token',
        ]);


        Application::create([
            'name' => 'i-Monitor Pharmacy System',

            'code' => 'imonitor',

            'description' =>
                'Pharmacy Monitoring System',

            'server_ip' =>
                '10.1.25.135',

            'url' =>
                'http://10.1.25.135/imonitor',

            'icon' =>
                '💊',

            'active' =>
                true,

            'sso_type' =>
                'token',
        ]);

    }
}