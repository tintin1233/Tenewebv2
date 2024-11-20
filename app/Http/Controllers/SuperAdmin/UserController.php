<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){

        $userCounts = $this->getUserCountsByRole();

        return view('user.super-admin.users.index', compact(['userCounts']));
    }

    function getUserCountsByRole() {
        $roles = Role::where('name', '!=', 'super-admin')->withCount('users')->get();

        $roleCounts = [];

        foreach ($roles as $role) {
            $roleCounts[$role->name] = [
                'total' => $role->users_count,
                'name' => $role->name
            ];
        }

        return $roleCounts;
    }
}
