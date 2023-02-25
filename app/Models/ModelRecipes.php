<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ModelRecipes extends Model
{
  use HasFactory;

  protected $table = "recipes";

  public function GetRecipes()
  {
    $id = Auth::user()->id;
    return $stacks = DB::table('recipes')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('name', 'asc')
    ->get();
  }

  public function GetFoods()
  {
    $id = Auth::user()->id;
    return $stacks = DB::table('foods')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('name', 'asc')
    ->get();
  }

  public function AddNewRecipe(string $name, float $servings, array $ingredients, array $instructions)
  {
    $id = Auth::user()->id;
    $json = json_encode($ingredients);
    $json2 = json_encode($instructions);
    $per = 0;
    foreach($ingredients as $ingredient)
    {
      $per += $ingredient['amount'];
    }
    DB::table('recipes')->insert([
      'userID' => $id,
      'name' => $name,
      'servings' => $servings,
      'ingredients' => $json,
      'instructions' => $json2,
      'per' => $per,
      'expiry' => 7,
      'hiddenRow' => 0
    ]);
  }

  public function DeleteRecipe(int $index)
  {
    $userID = Auth::id();
    DB::table('recipes')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'hiddenRow' => 1
    ]);
  }

  public function UpdateName(int $index, string $newName)
  {
    $userID = Auth::id();
    DB::table('recipes')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'name' => $newName
    ]);
  }

  public function EditExistingRecipe(string $name, float $servings, array $ingredients, array $instructions, int $index)
  {
    $userID = Auth::id();
    $json = json_encode($ingredients);
    $json2 = json_encode($instructions);
    $per = 0;
    foreach($ingredients as $ingredient)
    {
      $per += $ingredient['amount'];
    }
    DB::table('recipes')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'name' => $name,
      'servings' => $servings,
      'ingredients' => $json,
      'per' => $per,
      'instructions' => $json2,
    ]);
  }

  public function GetRecipe($index)
  {
    $id = Auth::user()->id;
    return $foods = DB::table('recipes')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->where('id', '=', $index)
    ->first();
  }

  public function AddLog($data)
  {
    $userID = Auth::id();
    $now = time();
    DB::table('larder_logs')->insert([
      'userID' => $userID,

      'itemType' => 1,
      'itemID' => $data['id'],
      'logTime' => $now,
      'amount' => $data['amount'],

      'hiddenRow' => 0
    ]);
  }
}