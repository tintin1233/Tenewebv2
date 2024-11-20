<?php

namespace App\Http\Controllers\Admin;

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
        $comments = AnnouncementFeed::where('is_archived', false)->where('is_approved', false)->latest()->paginate(10);

        return view('user.admin.comments.index', compact('comments'));
    }

    public function approved(string $id)
    {
        $comment = AnnouncementFeed::find($id);

        $comment->update([
            'is_approved' => true
        ]);


        return back()->with(['message' => 'Comment Approved']);
    }

    public function show(string $id)
    {
        $comment = AnnouncementFeed::find($id);




        return view('user.admin.comments.show', compact('comment'));
    }

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
    }

    public function destroy(string $id)
    {
        $comment = AnnouncementFeed::find($id);


        $comment->update(['is_archived' => true]);


        return back()->with(['message' => 'Comment Deleted']);
    }
    public function restore(string $id)
    {
        $comment = AnnouncementFeed::find($id);

        $comment->update(['is_archived' => false]);


        return back()->with(['message' => 'Comment Restored']);
    }
    public function delete(string $id)
    {
        $comment = AnnouncementFeed::find($id);

        $comment->delete();


        return back()->with(['message' => 'Comment Deleted']);
    }
}
