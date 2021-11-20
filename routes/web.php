<?php

use App\Contracts\Person\CreatePerson;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('requisition.index'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect(route('requisition.index'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get("/requisition", \App\View\Requisition\Index::class)->name("requisition.index");
});


