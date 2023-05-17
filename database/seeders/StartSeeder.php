<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');

        DB::table('oauth_clients')->where('id', 2)->update([
            'secret' => '10XwHjzlOKJpDEmodZEjOjAB2MyNvZ7zFxyzz2bY'
        ]);

        Role::create([
            'name' => 'superadministrator',
            'guard_name' => 'api'
        ]);

        $company = Company::create([
            'country_id' => 1,
            'name' => "prodooh",
        ]);

        $company->images()->create([
            "url" => 'prodooh.jph',
            "image_type" => 'principal'
        ]);

        $users = collect([
            [
                'country_id' => 1,
                'company_id' => 1,
                'name' => 'Fernando',
                'surnames' => 'Bautista',
                'email' => 'fernandobautista@prodooh.com',
                'payload' => [
                    "lang" => 'es'
                ]
            ],
            [
                'country_id' => 1,
                'company_id' => 1,
                'name' => 'Cristofer',
                'surnames' => 'Gonzalez',
                'email' => 'cristoferg@prodooh.com',
                'payload' => [
                    "lang" => 'es'
                ]
            ],
        ]);

        $users->map(function ($user) {
            $u = User::create($user);
            $u->syncRoles('superadministrator');
            $u->image()->create([
                "url" => 'user.png'
            ]);
        });
    }
}
