<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request){
        $tenant = $request->user();


        return view('user.tenant.profile.show', compact(['tenant']));
    }
}
