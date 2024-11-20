<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementFeed;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnnouncementFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'descriptions' => 'required'
        ]);


        if ($request->commentType === 'reply') {


            $comment = AnnouncementFeed::find($request->parentId);

            AnnouncementFeed::create([
                'content' => $request->descriptions,
                'announcement_id' => $request->announcement,
                'reply_id' => $comment->id,
                'user_id' => Auth::user()->id
            ]);


            return back()->with(['message' => 'Replied Success']);
        }


        AnnouncementFeed::create([
            'content' => $request->descriptions,
            'announcement_id' => $request->announcement,
            'user_id' => Auth::user()->id
        ]);



        return back()->with(['message' => 'Comment Added']);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = AnnouncementFeed::find($id);

        $comment->update([
            'is_archived' => true
        ]);

        return back()->with(['message', 'Question Deleted Success']);
    }
}
