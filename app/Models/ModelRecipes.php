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
    $recipes = DB::table('recipes')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('name', 'asc')
    ->get();

    $len = count($recipes);

    for($i = 0; $i < $len; $i++)
    {
      $stdClass = json_decode($recipes[$i]->ingredients);
      $array = json_decode(json_encode($stdClass));
      $info = $this->GetRecipeInfo($array);
      // return $info;
      $recipes[$i]->info = $info[0];
    }

    return $recipes;
  }

  public function GetFoods()
  {
    $id = Auth::user()->id;
    return $foods = DB::table('foods')
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

  public function AddLog($data)
  {
    $userID = Auth::id();
    $now = time();
    DB::table('logs')->insert([
      'userID' => $userID,

      'itemType' => 1,
      'itemID' => $data['id'],
      'logTime' => $now,
      'amount' => $data['amount'],

      'hiddenRow' => 0
    ]);
  }

  public function GetRecipeInfoTotals($ingredients)
  {
    $userID = Auth::id();
    $len = count($ingredients);

    $output = [];

    for($i = 0; $i < $len; $i++)
    {
      $array = json_decode(json_encode($ingredients[$i]), true);
      if($array['type'] === 'F')
      {

        $food = DB::table('foods')
        ->where('userID', '=', $userID)
        ->where('id', '=', $array['index'])
        ->where('hiddenRow', '=', 0)
        ->first();

        $log = [

          'type' => 'food',

          'price' => ( ( $food->price / $food->weight ) * $array['amount'] ),

          'calories' => ( ( $food->calories / $food->per ) * $array['amount'] ),
          'carbohydrate' => ( ( $food->carbohydrate / $food->per ) * $array['amount'] ),
          'sugar' => ( ( $food->sugar / $food->per ) * $array['amount'] ),

          'fat' => ( ( $food->fat / $food->per ) * $array['amount'] ),
          'saturated' => ( ( $food->saturated / $food->per ) * $array['amount'] ),
          'protein' => ( ( $food->protein / $food->per ) * $array['amount'] ),

          'fibre' => ( ( $food->fibre / $food->per ) * $array['amount'] ),
          'salt' => ( ( $food->salt / $food->per ) * $array['amount'] ),
          'alcohol' => ( ( $food->alcohol / $food->per ) * $array['amount'] ),

        ];

        array_push($output, $log);

      }

    }

    $oLen = count($output);

    $totalPrice = 0;

    $totalCalories = 0;
    $totalCarbohydrates = 0;
    $totalSugars = 0;

    $totalFats = 0;
    $totalSaturates = 0;
    $totalProteins = 0;

    $totalFibres = 0;
    $totalSalts = 0;
    $totalAlcohols = 0;

    for($i = 0; $i < $oLen; $i++)
    {
      $totalPrice += $output[$i]['price'];

      $totalCalories += $output[$i]['calories'];
      $totalCarbohydrates += $output[$i]['carbohydrate'];
      $totalSugars += $output[$i]['sugar'];

      $totalFats += $output[$i]['fat'];
      $totalSaturates += $output[$i]['saturated'];
      $totalProteins += $output[$i]['protein'];

      $totalFibres += $output[$i]['fibre'];
      $totalSalts += $output[$i]['salt'];
      $totalAlcohols += $output[$i]['alcohol'];
    }

    $log = [

      'price' => number_format($totalPrice, 2),

      'calories' => number_format($totalCalories, 2),
      'carbohydrate' => number_format($totalCarbohydrates, 2),
      'sugar' => number_format($totalSugars, 2),

      'fat' => number_format($totalFats, 2),
      'saturated' => number_format($totalSaturates, 2),
      'protein' => number_format($totalProteins, 2),

      'fibre' => number_format($totalFibres, 2),
      'salt' => number_format($totalSalts, 2),
      'alcohol' => number_format($totalAlcohols, 2),

    ];

    return $log;
  }

  public function GetRecipeInfo($ingredients)
  {
    $userID = Auth::id();
    $len = count($ingredients);

    $output = [];

    $totalPrice = 0;

    $totalCalories = 0;
    $totalCarbohydrates = 0;
    $totalSugars = 0;

    $totalFats = 0;
    $totalSaturates = 0;
    $totalProteins = 0;

    $totalFibres = 0;
    $totalSalts = 0;
    $totalAlcohols = 0;

    for($i = 0; $i < $len; $i++)
    {
      $array = json_decode(json_encode($ingredients[$i]), true);
      if($array['type'] === 'F')
      {
        $food = DB::table('foods')
        ->where('userID', '=', $userID)
        ->where('id', '=', $array['index'])
        ->where('hiddenRow', '=', 0)
        ->first();

        $totalPrice += ( ( (float)$food->price / (float)$food->weight ) * (float)$array['amount'] );

        $totalCalories += ( ( (float)$food->calories / (float)$food->per ) * (float)$array['amount'] );
        $totalCarbohydrates += ( ( (float)$food->carbohydrate / (float)$food->per ) * (float)$array['amount'] );
        $totalSugars += ( ( (float)$food->sugar / (float)$food->per ) * (float)$array['amount'] );
    
        $totalFats += ( ( (float)$food->fat / (float)$food->per ) * (float)$array['amount'] );
        $totalSaturates += ( ( (float)$food->saturated / (float)$food->per ) * (float)$array['amount'] );
        $totalProteins += ( ( (float)$food->protein / (float)$food->per ) * (float)$array['amount'] );
    
        $totalFibres += ( ( (float)$food->fibre / (float)$food->per ) * (float)$array['amount'] );
        $totalSalts += ( ( (float)$food->salt / (float)$food->per ) * (float)$array['amount'] );
        $totalAlcohols += ( ( (float)$food->alcohol / (float)$food->per ) * (float)$array['amount'] );

      }
    }

    $log = [
      'type' => 'total',

      'price' => $totalPrice,

      'calories' => $totalCalories,
      'carbohydrate' => $totalCarbohydrates,
      'sugar' => $totalSugars,

      'fat' => $totalFats,
      'saturated' => $totalSaturates,
      'protein' => $totalProteins,

      'fibre' => $totalFibres,
      'salt' => $totalSalts,
      'alcohol' => $totalAlcohols,
    ];

    array_push($output, $log);

    return $output;
  }
}