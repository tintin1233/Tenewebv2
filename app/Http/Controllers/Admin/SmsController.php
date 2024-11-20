<?php

namespace App\Http\Controllers\admin;

use App\Actions\SmsAction;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{
    public function create(){
        return view('user.admin.sms.create');
    }

    public function send(Request $request, SmsAction $smsAction){

        $user = Auth::user();
        $tenement = $user->adminProfile->tenement;
        if($request->send_type === 'all'){

            $tenants = Tenant::whereHas('room', function($q) use($tenement) {
                $q->where('tenement_id', $tenement->id);
            })->get();


            $response = [];
            collect($tenants)->map(function($tenant) use($smsAction, $request){
                $response[] = $smsAction->send($tenant->user->profile->contact_no, $request->message);
            });
            return back()->with([
                'message' => 'message  sent'
            ]);
        }


        $request->validate([
            'mobile_number' => 'required',
            'message' => 'required'
        ]);

        $response = $smsAction->send($request->mobile_number, $request->message);


        return back()->with([
            'message' => $response
        ]);
    }
}
