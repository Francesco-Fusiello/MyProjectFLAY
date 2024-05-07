<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function createAnnouncement(){
        return view ('announcements.create');
    }

    public function showAnnouncement(Announcement $announcement){
        return view ('announcements.show', compact('announcement'));
    }
    
    public function indexAnnouncement(){
        $announcements = Announcement::where('is_accepted', true)->orderBy('created_at','desc')->paginate(12);
        return view ('announcements.index', compact('announcements'));
    }

    public function deleteAnnouncement(Announcement $announcement){
        $user=Auth::user();
        if ($user->id !=$announcement->user->id){
            abort(403);
        };
    
        // $announcement->categories()->detach();
        $announcement->delete();
        // Storage delete($announcement->images()->'path');
        return redirect()->route('announcements.index')->with(['success'=>'Articolo cancellato con successo']);
    }

}
