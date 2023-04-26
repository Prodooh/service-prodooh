<?php

namespace Database\Seeders;

use \Spatie\Permission\Models\Role;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['administrator','salesmanager','administratorprovider','sellercosts','seller','customercosts','customer','suspended'];

        foreach ($roles as $index => $role) {
            $rol = [
                'name' => $role,
                'guard_name' => 'api'
            ];
            Role::create($rol);
        }
    }
}
