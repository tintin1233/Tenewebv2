<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);


        return view('user.super-admin.announcement.index', compact(['announcements']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.super-admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'descriptions' => 'required',
        ]);




        $announcement = Announcement::create([
            'title' => $request->title,
            'description' => $request->descriptions,
            'user_id' => Auth::user()->id
        ]);


        if ($request->hasFile('media')) {

            $imageName = 'ANMNT-' . uniqid() . '.' . $request->media->extension();
            $dir = $request->media->storeAs('/announcements', $imageName, 'public');

            $announcement->update([
                'image' => asset('/storage/' . $dir),
            ]);
        }


        return back()->with([
            'message' => 'Announcement Posted Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announcement = Announcement::find($id);


        return view('user.super-admin.announcement.show', compact(['announcement']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $announcement = Announcement::find($id);

        return view('user.super-admin.announcement.edit', compact(['announcement']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $announcement = Announcement::find($id);



        $announcement->update([
            'title' => $request->title ?? $announcement->title,
            'description' => $request->descriptions
        ]);


        if ($request->hasFile('image')) {

            $imageName = 'ANMNT-' . uniqid() . '.' . $request->image->extension();
            $dir = $request->image->storeAs('/announcements', $imageName, 'public');

            $announcement->update([
                'image' => asset('/storage/' . $dir),
            ]);
        }



        return back()->with([
            'message' => 'Announcement Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
