<?php

use App\Http\Livewire\Expense\ExpenseCreate;
use App\Http\Livewire\Expense\ExpenseEdit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        return view('dashboard');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::prefix('expenses')->name('expenses.')->group(function(){
        Route::get('/create', ExpenseCreate::class)->name('create');
        Route::get('/edit/{expense}', ExpenseEdit::class)->name('edit');

        Route::get('/{expense}/photo', function($expenseId){

            $expense = auth()->user()->expenses()->findOrFail($expenseId);

            if(!Storage::disk('public')->exists($expense->photo))
                return abort(404, 'Image not found!');

            //get imagem
            $image = Storage::disk('public')->get($expense->photo);
            //get format
            $mimeType = File::mimeType(storage_path('app/public/' . $expense->photo));
            
            return response($image)->header('Content-Type', $mimeType);

        })->name('photo');
    });
});