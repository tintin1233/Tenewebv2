<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\FamilyMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $familyMembers = FamilyMember::where('user_id', $user->id)->get();


        return view('user.tenant.family.index', compact(['familyMembers']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'date_of_birth' => 'required',
            'relationship_with_head' => 'required'
        ]);

        $userFamily = User::where('id', Auth::user()->id)->first()->familyMembers()->count();


        if($userFamily >= 10){
            return back()->with(['error' => 'You reach the family members maximum limit 10']);
        }


        FamilyMember::create([
            'name' => $request->name,
            'status' => $request->status,
            'birthdate' => $request->date_of_birth,
            'relationship' => $request->relationship_with_head,
            'user_id' => Auth::user()->id
        ]);



        return back()->with([
            'message' => 'Family Member Added!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $familyMember = FamilyMember::find($id);

        $familyMember->update([
            'name' => $request->name,
            'status' => $request->status,
            'birthdate' => $request->date_of_birth,
            'relationship' => $request->relationship_with_head,
        ]);


        return back()->with([
            'message' => 'date Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $familyMember = FamilyMember::find($id);

        $familyMember->delete();


        return back()->with(
            [
                'message' => 'Family Member Deleted!'
            ]
        );
    }
}
