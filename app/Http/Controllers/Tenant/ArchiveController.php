<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index() {
        $room = Auth::user()->tenant->room;

        return  view('user.tenant.archive.index', compact(['room']));
    }
}
