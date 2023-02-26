<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerLog;
use App\Http\Controllers\ControllerFoods;
use App\Http\Controllers\ControllerRecipes;
use App\Http\Controllers\ControllerUser;

Route::get('/', function(){
  return redirect('/log');
});

Route::controller(ControllerLog::class)->group(function () {
  Route::get('/log', 'log')->middleware(['auth', 'verified'])->name('Log');

  Route::post('/log/DeleteLog', 'DeleteLog')->middleware(['auth', 'verified'])->name('DeleteLog');
  Route::post('/log/GetDay', 'GetDay')->middleware(['auth', 'verified'])->name('GetDay');
  Route::post('/log/ChangeTime', 'ChangeTime')->middleware(['auth', 'verified'])->name('ChangeTime');
  Route::post('/log/ChangeDate', 'ChangeDate')->middleware(['auth', 'verified'])->name('ChangeDate');
  Route::post('/log/ChangeAmount', 'ChangeAmount')->middleware(['auth', 'verified'])->name('ChangeAmount');
  Route::post('/log/ReLog', 'ReLog')->middleware(['auth', 'verified'])->name('ReLog');
  Route::post('/log/LastDay', 'LastDay')->middleware(['auth', 'verified'])->name('LastDay');
  Route::post('/log/NextDay', 'NextDay')->middleware(['auth', 'verified'])->name('NextDay');
});

Route::controller(ControllerFoods::class)->group(function () {
  Route::get('/foods', 'Food')->middleware(['auth', 'verified'])->name('Foods');

  Route::post('/foods/ChangeLetter', 'ChangeLetter')->middleware(['auth', 'verified'])->name('ChangeLetter');
  Route::post('/foods/NewFood', 'NewFood')->middleware(['auth', 'verified'])->name('NewFood');
  Route::post('/foods/UpdateFood', 'UpdateFood')->middleware(['auth', 'verified'])->name('UpdateFood');
  Route::post('/foods/DeleteFood', 'DeleteFood')->middleware(['auth', 'verified'])->name('DeleteFood');
  Route::post('/foods/AddFoodLog', 'AddFoodLog')->middleware(['auth', 'verified'])->name('AddFoodLog');

  Route::post('/foods/GetScrapeWaitrose', 'GetScrapeWAITROSE')->middleware(['auth', 'verified'])->name('GetScrapeWAITROSE');
  Route::post('/foods/GetScrapePret', 'GetScrapePRET')->middleware(['auth', 'verified'])->name('GetScrapePRET');
  Route::post('/foods/GetScrapeTesco', 'GetScrapeTESCO')->middleware(['auth', 'verified'])->name('GetScrapeTESCO');
  Route::post('/foods/GetScrapeSainsburys', 'GetScrapeSAINSBURYS')->middleware(['auth', 'verified'])->name('GetScrapeSAINSBURYS');
  Route::post('/foods/GetScrapeAsda', 'GetScrapeASDA')->middleware(['auth', 'verified'])->name('GetScrapeASDA');
});

Route::controller(ControllerRecipes::class)->group(function () {
  Route::get('/recipes', 'recipes')->middleware(['auth', 'verified'])->name('Recipes');

  Route::post('/recipes/AddNewRecipe', 'AddNewRecipe')->middleware(['auth', 'verified'])->name('AddNewRecipe');
  Route::post('/recipes/DeleteRecipe', 'DeleteRecipe')->middleware(['auth', 'verified'])->name('DeleteRecipe');
  Route::post('/recipes/UpdateRecipeName', 'UpdateName')->middleware(['auth', 'verified'])->name('UpdateName');
  Route::post('/recipes/EditExisting', 'EditExisting')->middleware(['auth', 'verified'])->name('EditExisting');
  Route::post('/recipes/AddLog', 'AddLog')->middleware(['auth', 'verified'])->name('AddLog');
  Route::post('/recipes/UpdateNewRecipeStats', 'UpdateNewRecipeStats')->middleware(['auth', 'verified'])->name('UpdateNewRecipeStats');
});

Route::controller(ControllerUser::class)->group(function () {
  Route::get('/user', 'User')->middleware(['auth', 'verified'])->name('User');

  Route::post('/user/SaveUser', 'SaveUser')->middleware(['auth', 'verified'])->name('SaveUser');
  Route::post('/user/SaveNutrient', 'SaveNutrient')->middleware(['auth', 'verified'])->name('SaveNutrient');
  Route::post('/user/SaveWeight', 'SaveWeight')->middleware(['auth', 'verified'])->name('SaveWeight');
  Route::post('/user/DeleteWeight', 'DeleteWeight')->middleware(['auth', 'verified'])->name('DeleteWeight');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
