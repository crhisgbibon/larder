<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerLarderLog;
use App\Http\Controllers\ControllerLarderFoods;
use App\Http\Controllers\ControllerLarderRecipes;
use App\Http\Controllers\ControllerLarderProfile;

Route::get('/', function(){
  return redirect('/log');
});

Route::controller(ControllerLarderLog::class)->group(function () {
  Route::get('/log', 'log')->middleware(['auth', 'verified'])->name('larderlog');

  Route::post('/log/DeleteLog', 'DeleteLog')->middleware(['auth', 'verified'])->name('larderDeleteLog');
  Route::post('/log/GetDay', 'GetDay')->middleware(['auth', 'verified'])->name('larderGetDay');
  Route::post('/log/ChangeTime', 'ChangeTime')->middleware(['auth', 'verified'])->name('larderChangeTime');
  Route::post('/log/ChangeDate', 'ChangeDate')->middleware(['auth', 'verified'])->name('larderChangeDate');
  Route::post('/log/ChangeAmount', 'ChangeAmount')->middleware(['auth', 'verified'])->name('larderChangeAmount');
  Route::post('/log/ReLog', 'ReLog')->middleware(['auth', 'verified'])->name('larderReLog');
  Route::post('/log/LastDay', 'LastDay')->middleware(['auth', 'verified'])->name('larderLastDay');
  Route::post('/log/NextDay', 'NextDay')->middleware(['auth', 'verified'])->name('larderNextDay');
});

Route::controller(ControllerLarderFoods::class)->group(function () {
  Route::get('/foods', 'foods')->middleware(['auth', 'verified'])->name('larderfoods');

  Route::post('/foods/NewFood', 'NewFood')->middleware(['auth', 'verified'])->name('larderNewFood');
  Route::post('/foods/UpdateFood', 'UpdateFood')->middleware(['auth', 'verified'])->name('larderUpdateFood');
  Route::post('/foods/DeleteFood', 'DeleteFood')->middleware(['auth', 'verified'])->name('larderDeleteFood');
  Route::post('/foods/AddFoodLog', 'AddFoodLog')->middleware(['auth', 'verified'])->name('larderAddFoodLog');
});

Route::controller(ControllerLarderRecipes::class)->group(function () {
  Route::get('/recipes', 'recipes')->middleware(['auth', 'verified'])->name('larderrecipes');

  Route::post('/recipes/AddNewRecipe', 'AddNewRecipe')->middleware(['auth', 'verified'])->name('larderAddNewRecipe');
  Route::post('/recipes/DeleteRecipe', 'DeleteRecipe')->middleware(['auth', 'verified'])->name('larderDeleteRecipe');
  Route::post('/recipes/UpdateRecipeName', 'UpdateName')->middleware(['auth', 'verified'])->name('larderUpdateName');
  Route::post('/recipes/EditExisting', 'EditExisting')->middleware(['auth', 'verified'])->name('larderEditExisting');
  Route::post('/recipes/AddLog', 'AddLog')->middleware(['auth', 'verified'])->name('larderAddLog');
});

Route::controller(ControllerLarderProfile::class)->group(function () {
  Route::get('/user', 'profile')->middleware(['auth', 'verified'])->name('larderprofile');

  Route::post('/user/SaveProfile', 'SaveProfile')->middleware(['auth', 'verified'])->name('larderSaveProfile');
  Route::post('/user/SaveNutrient', 'SaveNutrient')->middleware(['auth', 'verified'])->name('larderSaveNutrient');
  Route::post('/user/SaveWeight', 'SaveWeight')->middleware(['auth', 'verified'])->name('larderSaveWeight');
  Route::post('/user/DeleteWeight', 'DeleteWeight')->middleware(['auth', 'verified'])->name('larderDeleteWeight');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
