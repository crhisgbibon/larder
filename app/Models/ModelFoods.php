<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ModelFoods extends Model
{
  use HasFactory;

  protected $table = "foods";

  public function GetFood($index)
  {
    $id = Auth::user()->id;
    return $foods = DB::table('foods')
    ->where('userID', '=', $id)
    ->where('id', '=', $index)
    ->where('hiddenRow', '=', 0)
    ->first();
  }

  public function GetFoods($filter)
  {
    $id = Auth::user()->id;
    if($filter === '0-9')
    {
      return $foods = DB::table('foods')
      ->where('userID', '=', $id)
      ->where('hiddenRow', '=', 0)
      ->whereRaw('name REGEXP "^[0-9]"')
      ->orderBy('name', 'asc')
      ->get();
    }
    else if($filter === 'All')
    {
      return $foods = DB::table('foods')
      ->where('userID', '=', $id)
      ->where('hiddenRow', '=', 0)
      ->orderBy('name', 'asc')
      ->get();
    }
    else
    {
      $wildcard = $filter . '%';
      return $foods = DB::table('foods')
      ->where('userID', '=', $id)
      ->where('hiddenRow', '=', 0)
      ->where('name', 'like', $wildcard)
      ->orderBy('name', 'asc')
      ->get();
    }
  }

  public function GetNutrientTargets()
  {
    $id = Auth::user()->id;
    return $profiles = DB::table('nutrient_goals')
    ->where('userID', '=', $id)
    ->first();
  }

  public function GetProfile()
  {
    $id = Auth::user()->id;
    return $profiles = DB::table('profiles')
    ->where('userID', '=', $id)
    ->first();
  }

  public function AddFood($data)
  {
    $userID = Auth::id();
    $now = time();
    DB::table('foods')->insert([
      'userID' => $userID,

      'name' => $data['name'],
      'vendor' => $data['vendor'],
      'url' => $data['url'],

      'price' => $data['price'],
      'weight' => $data['weight'],
      'servings' => $data['servings'],

      'expiry' => $data['expiry'],
      'per' => $data['per'],
      'calories' => $data['calories'],

      'carbohydrate' => $data['carbohydrate'],
      'sugar' => $data['sugar'],
      'fat' => $data['fat'],

      'saturated' => $data['saturated'],
      'protein' => $data['protein'],
      'fibre' => $data['fibre'],

      'salt' => $data['salt'],
      'alcohol' => $data['alcohol'],

      'fruit' => $data['fruit'],
      'vegetable' => $data['vegetable'],
      'vegan' => $data['vegan'],
      'vegetarian' => $data['vegetarian'],
      'hiddenRow' => $data['hiddenRow'],
    ]);
  }

  public function UpdateFood($data)
  {
    $userID = Auth::id();
    DB::table('foods')
    ->where('userID', "=", $userID)
    ->where('id', "=", $data['index'])
    ->update([
      'name' => $data['name'],
      'vendor' => $data['vendor'],
      'url' => $data['url'],

      'price' => $data['price'],
      'weight' => $data['weight'],
      'servings' => $data['servings'],

      'expiry' => $data['expiry'],
      'per' => $data['per'],
      'calories' => $data['calories'],

      'carbohydrate' => $data['carbohydrate'],
      'sugar' => $data['sugar'],
      'fat' => $data['fat'],

      'saturated' => $data['saturated'],
      'protein' => $data['protein'],
      'fibre' => $data['fibre'],

      'salt' => $data['salt'],
      'alcohol' => $data['alcohol'],
      
      'fruit' => $data['fruit'],
      'vegetable' => $data['vegetable'],
      'vegan' => $data['vegan'],
      'vegetarian' => $data['vegetarian'],
      'hiddenRow' => $data['hiddenRow'],
    ]);
  }

  public function DeleteFood(int $index)
  {
    $userID = Auth::id();
    DB::table('foods')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'hiddenRow' => 1
    ]);
  }

  public function AddFoodLog($data)
  {
    $userID = Auth::id();
    $now = time();
    DB::table('logs')->insert([
      'userID' => $userID,

      'itemType' => 0,
      'itemID' => $data['id'],
      'logTime' => $now,
      'amount' => $data['amount'],

      'hiddenRow' => 0
    ]);
  }

  public function GetVendors()
  {
    return $vendors = DB::table('foods')
      ->select('vendor')
      ->distinct()
      ->orderBy('vendor', 'asc')
      ->get();
  }
}