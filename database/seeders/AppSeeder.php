<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('applications')->truncate();

        DB::table('applications')->insert([
            // --- SSO Authenticated Apps (Internal) ---
            [
                'name' => "Continuous Medical Education\n(eCME)",
                'code' => 'cme',
                'description' => 'Continuous Medical Education System (CME)',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>',
                'server_ip' => '10.1.25.135',
                'url' => 'http://10.1.25.135/cme/sso-login.php',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Integrated Pharmacy System\n(IPS)",
                'code' => 'ips',
                'description' => 'Integrated Pharmacy System',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                'server_ip' => '10.1.25.135',
                'url' => 'http://10.1.25.135:8080/ips/sso/callback',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Incident Reporting\n(eIR)",
                'code' => 'ir',
                'description' => 'Incident Reporting System',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
                'server_ip' => '10.1.25.135',
                'url' => 'http://10.1.25.135/ir/opd/ir2/sso-login.php',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // --- External Apps (Direct Links) ---
            [
                'name' => "Queue Management System\n(iQMS)",
                'code' => 'iqms',
                'description' => 'External queue management',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
                'server_ip' => null,
                'url' => 'https://jknselangor.moh.gov.my/qms/#!/facility/13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ePorter',
                'code' => 'eporter',
                'description' => 'External ePorter site',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>',
                'server_ip' => null,
                'url' => 'https://sites.google.com/moh.gov.my/hseleporter/home',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Clinical Practice Guidelines\n(CPG)",
                'code' => 'cpg',
                'description' => 'CPG External Link',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
                'server_ip' => null,
                'url' => 'https://linktr.ee/cpghsel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Drug Formulary',
                'code' => 'drug_formulary',
                'description' => 'Drug Formulary Web App',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>',
                'server_ip' => null,
                'url' => 'https://hseldrugformulary.wistify.app/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meeting Room Booking Management',
                'code' => 'meeting_room',
                'description' => 'Google Sites Meeting Booking',
                'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                'server_ip' => null,
                'url' => 'https://sites.google.com/moh.gov.my/itd/home',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}