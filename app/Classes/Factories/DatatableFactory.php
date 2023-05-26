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
            return DB::table('users')->join('countries', 'country_id', '=', 'countries.id')
                ->join('companies', 'company_id', '=', 'companies.id')
                ->select('users.id as id', 'users.name as name', 'surnames', 'email', 'countries.name as country', 'companies.name as company');
        }

        if (auth()->user()->hasRole('salesmanager')) {
            return DB::table('users')->join('countries', 'country_id', '=', 'countries.id')
                ->join('companies', 'company_id', '=', 'companies.id')
                ->select('users.id as id', 'users.name as name', 'surnames', 'email', 'countries.name as country', 'companies.name as company')
                ->where('admin_registry_id', auth()->user()->id);
        }

        return DB::table('users')->join('countries', 'country_id', '=', 'countries.id')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('users.id as id', 'users.name as name', 'surnames', 'email', 'countries.name as country', 'companies.name as company')
            ->where('registry_id', '=', auth()->user()->id);
    }
}
