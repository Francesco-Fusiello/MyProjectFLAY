<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function index(){
        $announcement_to_check = Announcement::where('is_accepted', null)->get();
        return view('revisor.index',compact('announcement_to_check')); 
    }

    public function acceptAnnouncement(Announcement $announcement)
    {
        $announcement->setAccepted(true);
        $ui= __('ui.mess1');
        return redirect()->back()->with('message', $ui);

    }

    public function rejectAnnouncement(Announcement $announcement)
    {
        $announcement->setAccepted(false);
        $ui= __('ui.mess2');
        return redirect()->back()->with('message', $ui);
    }
    public function becomeRevisor(){
        Mail::to('admin@FLAY.it')->send(new BecomeRevisor(Auth::user()));
        $ui= __('ui.mess3');
        
        // Imposta una variabile di sessione per indicare che il pulsante deve essere nascosto
        session()->put('hide_revisor_button', true);
    
        return redirect()->back()->with('message', $ui);
    }

    public function makeRevisor(User $user)
    {
    Artisan::call('presto:makeUserRevisor',['email'=> $user->email]);
        $ui= __('ui.mess4');
      return redirect('/')->with('message',"{$user->name} ,$ui" );
    }

    public function resetLastAcceptedAnnouncement()
    {
        // Trova l'ultimo annuncio revisionato
        $announcement = Announcement::whereNotNull('is_accepted')->orderBy('updated_at', 'desc')->first(); 
        // Se è stato trovato un annuncio, resetta il campo 'is_accepted' a null
        $announcement->is_accepted=null;          
        $announcement->save();
        $ui= __('ui.mess5');
        return redirect()->back()->with('message',$ui );
            
            
            
        }
        
}




