<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;


        $announcements = Announcement::where('announcements.is_archived', false)
        ->where('tenement_id', $tenement->id)
        ->orWhereNull('tenement_id')
        ->withCount(['announcementFeeds as unapproved_count' => function ($q) {
            $q->where('is_approved', false);
        }])
        ->orderBy('unapproved_count', 'desc') // Order by the unapproved count, if needed
        ->paginate(10);


        return view('user.admin.announcement.index', compact(['announcements']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.admin.announcement.create');
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

        $tenement = Auth::user()->adminProfile->tenement;




        $announcement = Announcement::create([
            'title' => $request->title,
            'description' => $request->descriptions,
            'tenement_id' => $tenement->id,
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
        $questions = $announcement->announcementFeeds()->where(function ($q) {
            $q->where('is_approved', false);
        })->get();

        if (count($questions) !== 0) {
            collect($questions)->map(function ($question) {
                $question->update([
                    'is_approved' => true
                ]);
            });
        }

        return view('user.admin.announcement.show', compact(['announcement']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announcement = Announcement::find($id);

        return view('user.admin.announcement.edit', compact(['announcement']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $announcement = Announcement::find($id);



        $announcement->update([
            'title' => $request->title ?? $announcement->title,
            'description' => $request->descriptions ?? $announcement->descriptions
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
        $announcement = Announcement::find($id);


        $announcement->update(['is_archived' => true]);


        return back()->with(['message' => 'Announcement Delete']);
    }

    public function restore(string $id)
    {
        $announcement = Announcement::find($id);

        $announcement->update(['is_archived' => false]);

        return back()->with(['message' => 'Announcement Restored']);
    }


    public function delete(string $id)
    {
        $announcement = Announcement::find($id);

        $announcement->delete();

        return back()->with(['message' => 'Announcement Deleted Success']);
    }
}
