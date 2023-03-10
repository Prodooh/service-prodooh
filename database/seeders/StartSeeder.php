<?php

namespace Database\Seeders;

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

        $users = collect([
            [
                'name' => 'Fernando',
                'surnames' => 'Bautista',
                'email' => 'fernandobautista@prodooh.com',
                'payload' => [
                    "language" => 'es'
                ]
            ],
            [
                'name' => 'Cristofer',
                'surnames' => 'Gonzalez',
                'email' => 'cristoferg@prodooh.com',
                'payload' => [
                    "language" => 'es'
                ]
            ],
        ]);

        $users->map(function ($user) {
            $u = User::create($user);
            $u->syncRoles('superadministrator');
        });
    }
}
