<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categoria/{category}', [PageController::class, 'categoryShow'])->name('categoryShow');

Route::get('/nuovo/annuncio', [AnnouncementController::class, 'createAnnouncement'])->middleware('auth')->name('announcements.create');

Route::get('/dettaglio/annuncio/{announcement}', [AnnouncementController::class, 'showAnnouncement'])->name('announcements.show');

Route::get('/tutti/annunci', [AnnouncementController::class, 'indexAnnouncement'])->name('announcements.index');

Route::delete('/annuncio/{announcement}/delete',[AnnouncementController::class,'deleteAnnouncement'])->middleware('auth')->name('announcements.destroy');


Route::get('/revisor/home',[RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');

Route::patch('/accetta/annuncio/{announcement}',[RevisorController::class, 'acceptAnnouncement'])->name('revisor.accept_announcement');

Route::patch('/rifiuta/annuncio/{announcement}',[RevisorController::class, 'rejectAnnouncement'])->name('revisor.reject_announcement');


// Richiedi di diventare revisore
Route::get('/richiesta/revisore',[RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
//Rendi utente Revisore
Route::get('/rendi/revisore/{user}',[RevisorController::class, 'makeRevisor'])->name('make.revisor');

//Annullare l'ultima operazione(accettazione/rifiuto annuncio))
Route::get('/announcements/reset-last-accepted', [RevisorController::class, 'resetLastAcceptedAnnouncement'])->name('announcements.reset-last-accepted');
//Ricerca annuncio
Route::get('/ricerca/annuncio', [PageController::class, 'searchAnnouncements'])->name('announcement.search');


//Lingua
Route::post('/lingua/{lang}', [PageController::class, 'setLanguage'])->name('set_language_locale');
//Chi siamo
Route::get('/chi/siamo', [PageController::class, 'chiSiamo'])->name('chiSiamo');
//Ringraziamenti
Route::get('/grazie', [PageController::class, 'grazie'])->name('grazie');