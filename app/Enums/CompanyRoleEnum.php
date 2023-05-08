<?php
namespace App\Enums;

enum CompanyRoleEnum: string {
    case Administrator = 'administrator';
    case Provider = 'provider';
    case Seller = 'seller';
    case Client = 'client';
}
