<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        return view('user.tenant.document.index');
    }

    public function agreement(){
        return view('user.tenant.document.agreement.index');
    }
    public function penalty(){
        return view('user.tenant.document.penalties.index');
    }
    public function requirement(){
        return view('user.tenant.document.requirements.index');
    }
}
