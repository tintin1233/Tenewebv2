<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoles;
use App\Models\User;
use App\Models\MasterList;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\PaymentAccount;
use App\Models\AnnouncementFeed;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index(){

        return view('user.admin.archive.index');
    }


    public function announcementsIndex(){

        $user = Auth::user();


        $tenement  = $user->adminProfile->tenement;

        $announcements = Announcement::where('is_archived' , true)
        ->where('tenement_id', $tenement->id)->latest()->paginate(10);


        return view('user.admin.archive.announcement.index', compact(['announcements']));
    }


    public function commentsIndex() {



        $user = Auth::user();


        $tenement  = $user->adminProfile->tenement;

        $comments = AnnouncementFeed::where('is_archived' , true)
        ->whereHas('announcement', function($q) use($tenement){
            $q->where('tenement_id', $tenement->id);
        })->latest()->paginate(10);

        return view('user.admin.archive.comment.index', compact(['comments']));
    }

    public function paymentAccountIndex() {

        $user = Auth::user();


        $tenement  = $user->adminProfile->tenement;

        $paymentAccounts = PaymentAccount::where('is_archived' , true)
        ->where('tenement_id', $tenement->id)->latest()->paginate(10);

        return view('user.admin.archive.payment-account.index', compact(['paymentAccounts']));
    }

    public function masterListIndex() {

        $user = Auth::user();


        $tenement  = $user->adminProfile->tenement;

        $masterLists = MasterList::where('is_archived' , true)
        ->where('tenement_id', $tenement->id)->latest()->paginate(10);

        return view('user.admin.archive.master-list.index', compact(['masterLists']));
    }

    public function tenantIndex(){

        $tenants = User::role(UserRoles::TENANT->value)->where(function($q){
            $q->whereHas('tenant', function($q){
                $q->whereNotNull('move_out_date');
            });
        })->latest()->paginate(10);

        return view('user.admin.archive.tenant.index', compact(['tenants']));
    }
}
