<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $userRole = Auth::user()->roles()->first();


        switch($userRole->name){
            case UserRoles::SUPERADMIN->value:
                return to_route('super-admin.dashboard');
                break;
            case UserRoles::TENANT->value:
                return to_route('tenant.dashboard');
                break;
            case UserRoles::ADMIN->value:
                return to_route('admin.dashboard');
                break;
            // default :
            //     Auth::logout();
            //     return to_route('home')->with(['warning' => 'Don\'`t Permission to access this section']);
            //     break;
        }
    }
}
