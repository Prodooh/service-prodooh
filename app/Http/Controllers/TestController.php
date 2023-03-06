<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
    public function test()
    {
        return __('messages.prueba');
    }

}
