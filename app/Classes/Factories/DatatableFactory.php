<?php

namespace App\Classes\Factories;


use Illuminate\Support\Facades\DB;

class  DatatableFactory
{
    public static function createQuery($datatableType)
    {
        return match ($datatableType) {
            'users' => self::filterUsers(),
            default => DB::table($datatableType)
        };
    }

    // ******************
    //  Private Methods
    // ******************
    private static function filterUsers()
    {
        if (auth()->user()->hasAnyRole('administrator', 'superadministrator')) {
            return DB::table('users');
        }

        if (auth()->user()->hasRole('salesmanager')) {
            dump("aqui si es");
            return DB::table('users')->where('admin_registry_id', auth()->user()->id);
        }

        return DB::table('users')->where('registry_id', '=', auth()->user()->id);
    }
}
