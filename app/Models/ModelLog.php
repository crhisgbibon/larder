<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ModelLog extends Model
{
  use HasFactory;

  protected $table = "logs";

  public function GetLog($index)
  {
    $id = Auth::user()->id;
    return $log = DB::table('logs')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->where('id', '=', $index)
    ->first();
  }

  public function GetLogs()
  {
    $id = Auth::user()->id;
    return $logs = DB::table('logs')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('logTime', 'desc')
    ->get();
  }

  public function GetLogsWithData($date)
  {
    $startTime = strtotime(date("Y-m-d 00:00:00", $date));
    $endTime = strtotime(date("Y-m-d 23:59:59", $date));
    $id = Auth::user()->id;

    $foodLogs = DB::table('logs')
    ->join('foods', 'logs.itemID', '=', 'foods.id')
    ->select(
    'logs.id', 'logs.userID', 'logs.itemType', 'logs.itemID', 
    'logs.logTime', 'logs.amount',
    'foods.name', 'foods.price', 'foods.weight', 'foods.servings',
    'foods.expiry', 'foods.per', 'foods.calories', 'foods.carbohydrate',
    'foods.sugar', 'foods.fat', 'foods.saturated', 'foods.protein',
    'foods.fibre', 'foods.salt', 'foods.alcohol', 'foods.fruit',
    'foods.vegetable', 'foods.vegan', 'foods.vegetarian',
    )
    ->where('logs.userID', '=', $id)
    ->where('logs.itemType', '=', 0)
    ->where('logs.hiddenRow', '=', 0)
    ->orderBy('logs.logTime', 'desc')
    ->where('logs.logTime', '>=', $startTime)
    ->where('logs.logTime', '<=', $endTime)
    ->get();

    $recipeLogs = DB::table('logs')
    ->join('recipes', 'logs.itemID', '=', 'recipes.id')
    ->select(
    'logs.id', 'logs.userID', 'logs.itemType', 'logs.itemID',
    'logs.logTime', 'logs.amount',
    'recipes.name', 'recipes.servings', 'recipes.ingredients', 'recipes.instructions', 'recipes.per', 'recipes.expiry'
    )
    ->where('logs.userID', '=', $id)
    ->where('logs.itemType', '=', 1)
    ->where('logs.hiddenRow', '=', 0)
    ->orderBy('logs.logTime', 'desc')
    ->where('logs.logTime', '>=', $startTime)
    ->where('logs.logTime', '<=', $endTime)
    ->get();

    $newLogs = [];

    foreach($foodLogs as $log)
    {
      if((int)$log->weight === 0) $log->weight = 1;
      if((int)$log->per === 0) $log->per = 1;

      $newLog = new \stdClass;
      $newLog->id = (int)$log->id;
      $newLog->userID = (int)$log->userID;
      $newLog->itemType = (int)$log->itemType;
      $newLog->itemID = (int)$log->itemID;
      $newLog->logTime = (int)$log->logTime;
      $newLog->amount = (float)number_format($log->amount, 2);
      $newLog->name = (string)$log->name;

      $newLog->price = (float)number_format( ( ( $log->price / $log->weight ) * (float)$log->amount ), 2);
      $newLog->weight = (float)number_format($log->weight, 2);
      $newLog->servings = (float)number_format($log->servings, 2);
      $newLog->expiry = (int)$log->expiry;
      $newLog->per = (float)number_format($log->per, 2);
      $newLog->calories = (float)number_format( ( ( $log->calories / $log->per ) * (float)$log->amount ), 2);
      $newLog->carbohydrate = (float)number_format( ( ( $log->carbohydrate / $log->per ) * (float)$log->amount ), 2);
      $newLog->sugar = (float)number_format( ( ( $log->sugar / $log->per ) * (float)$log->amount ), 2);
      $newLog->fat = (float)number_format( ( ( $log->fat / $log->per ) * (float)$log->amount ), 2);
      $newLog->saturated = (float)number_format( ( ( $log->saturated / $log->per ) * (float)$log->amount ), 2);
      $newLog->protein = (float)number_format( ( ( $log->protein / $log->per ) * (float)$log->amount ), 2);
      $newLog->fibre = (float)number_format( ( ( $log->fibre / $log->per ) * (float)$log->amount ), 2);
      $newLog->salt = (float)number_format( ( ( $log->salt / $log->per ) * (float)$log->amount ), 2);
      $newLog->alcohol = (float)number_format( ( ( $log->alcohol / $log->per ) * (float)$log->amount ), 2);
      $newLog->fibre = (float)number_format( ( ( $log->fibre / $log->per ) * (float)$log->amount ), 2);

      $newLog->fruit = null;
      $newLog->vegetable = null;
      $newLog->vegetarian = null;
      $newLog->vegan = null;

      array_push($newLogs, $newLog);
    }

    if(count($recipeLogs) > 0)
    { 
      foreach($recipeLogs as $log)
      {
        $recipe = $this->GetRecipe($log->itemID);

        $weight = $recipe->per;
        $amount = $log->amount;
        
        $newLog = new \stdClass;
        $newLog->id = (int)$log->id;
        $newLog->userID = (int)$log->userID;
        $newLog->itemType = (int)$log->itemType;
        $newLog->itemID = (int)$log->itemID;
        $newLog->logTime = (int)$log->logTime;
        $newLog->amount = (float)number_format($log->amount, 2);
        $newLog->name = (string)$log->name;

        $newLog->weight = (float)number_format( (float)$log->per, 2);
        $newLog->servings = (float)number_format((float)$log->servings, 2);
        $newLog->expiry = (int)$log->expiry;
        $newLog->per = (float)number_format((float)$log->per, 2);

        $newLog->price = (float)number_format( (( (float)$recipe->info['price'] / $weight ) * $amount), 2);
        $newLog->calories = (float)number_format( (( (float)$recipe->info['calories'] / $weight ) * $amount), 2);
        $newLog->carbohydrate = (float)number_format( (( (float)$recipe->info['carbohydrate'] / $weight ) * $amount), 2);
        $newLog->sugar = (float)number_format( (( (float)$recipe->info['sugar'] / $weight ) * $amount), 2);
        $newLog->fat = (float)number_format( (( (float)$recipe->info['fat'] / $weight ) * $amount), 2);
        $newLog->saturated = (float)number_format( (( (float)$recipe->info['saturated'] / $weight ) * $amount), 2);
        $newLog->protein = (float)number_format( (( (float)$recipe->info['protein'] / $weight ) * $amount), 2);
        $newLog->fibre = (float)number_format( (( (float)$recipe->info['fibre'] / $weight ) * $amount), 2);
        $newLog->salt = (float)number_format( (( (float)$recipe->info['salt'] / $weight ) * $amount), 2);
        $newLog->alcohol = (float)number_format( (( (float)$recipe->info['alcohol'] / $weight ) * $amount), 2);
        $newLog->fibre = (float)number_format( (( (float)$recipe->info['fibre'] / $weight ) * $amount), 2);

        $newLog->fruit = null;
        $newLog->vegetable = null;
        $newLog->vegetarian = null;
        $newLog->vegan = null;

        array_push($newLogs, $newLog);
      }
    }

    usort($newLogs, function($a, $b) {
      if ($a->logTime == $b->logTime) return 0;
      return $a->logTime > $b->logTime ? 1 : -1;
    });

    return $newLogs;
  }

  public function GetRecipe($index)
  {
    $id = Auth::user()->id;
    $recipe = DB::table('recipes')
    ->where('userID', '=', $id)
    ->where('id', '=', $index)
    ->first();

    $stdClass = json_decode($recipe->ingredients);
    $array = json_decode(json_encode($stdClass));
    $recipe->info = $this->GetRecipeInfoTotals($array);

    return $recipe;
  }

  public function Totals($logs)
  {
    $calories = 0;
    $price = 0;
    $carbohydrate = 0;
    $sugar = 0;
    $fat = 0;
    $saturated = 0;
    $protein = 0;
    $fibre = 0;
    $salt = 0;
    $alcohol = 0;

    foreach($logs as $log)
    {
      $calories += $log->calories;
      $price += $log->price;
      $carbohydrate += $log->carbohydrate;
      $sugar += $log->sugar;
      $fat += $log->fat;
      $saturated += $log->saturated;
      $protein += $log->protein;
      $fibre += $log->fibre;
      $salt += $log->salt;
      $alcohol += $log->alcohol;
    }

    return [
      'calories' => (float)$calories,
      'price' => (float)$price,
      'carbohydrate' => (float)$carbohydrate,
      'sugar' => (float)$sugar,
      'fat' => (float)$fat,
      'saturated' => (float)$saturated,
      'protein' => (float)$protein,
      'fibre' => (float)$fibre,
      'salt' => (float)$salt,
      'alcohol' => (float)$alcohol,
    ];
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

  public function DeleteLog(int $index)
  {
    $userID = Auth::id();
    DB::table('logs')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'hiddenRow' => 1
    ]);
  }

  public function ChangeLogTime(int $index, int $newTime)
  {
    $userID = Auth::id();
    DB::table('logs')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'logTime' => $newTime
    ]);
  }

  public function ChangeLogAmount(int $index, int $amount)
  {
    $userID = Auth::id();
    DB::table('logs')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'amount' => $amount
    ]);
  }

  public function ReLog(int $index)
  {
    $userID = Auth::id();
    $log = $this->GetLog($index);
    $now = time();
    DB::table('logs')->insert([
      'userID' => $userID,

      'itemType' => 0,
      'itemID' => $log->itemID,
      'logTime' => $now,
      'amount' => $log->amount,

      'hiddenRow' => 0
    ]);
  }

  public function GetFoodTotals($date)
  {
    $id = Auth::user()->id;

    $startTime = strtotime(date("Y-m-d 00:00:00", $date));
    $endTime = strtotime(date("Y-m-d 23:59:59", $date));

    $array = DB::table('logs')
    ->join('foods', 'logs.itemID', '=', 'foods.id')
    ->select(
      DB::raw('(foods.calories / foods.per) * logs.amount as calories'),
      DB::raw('(foods.price / foods.weight) * logs.amount as price'),
      DB::raw('(foods.carbohydrate / foods.per) * logs.amount as carbohydrate'),
      DB::raw('(foods.sugar / foods.per) * logs.amount as sugar'),
      DB::raw('(foods.fat / foods.per) * logs.amount as fat'),
      DB::raw('(foods.saturated / foods.per) * logs.amount as saturated'),
      DB::raw('(foods.protein / foods.per) * logs.amount as protein'),
      DB::raw('(foods.fibre / foods.per) * logs.amount as fibre'),
      DB::raw('(foods.salt / foods.per) * logs.amount as salt'),
      DB::raw('(foods.alcohol / foods.per) * logs.amount as alcohol'),
    )
    ->where('logs.userID', '=', $id)
    ->where('logs.hiddenRow', '=', 0)
    ->where('logs.logTime', '>=', $startTime)
    ->where('logs.logTime', '<=', $endTime)
    ->get();
    $calories = 0;
    $price = 0;
    $carbohydrate = 0;
    $sugar = 0;
    $fat = 0;
    $saturated = 0;
    $protein = 0;
    $fibre = 0;
    $salt = 0;
    $alcohol = 0;
    $array = json_decode(json_encode($array), true);
    foreach($array as $subArray) {
      $calories += (float)$subArray['calories'];
      $price += (float)$subArray['price'];
      $carbohydrate += (float)$subArray['carbohydrate'];
      $sugar += (float)$subArray['sugar'];
      $fat += (float)$subArray['fat'];
      $saturated += (float)$subArray['saturated'];
      $protein += (float)$subArray['protein'];
      $fibre += (float)$subArray['fibre'];
      $salt += (float)$subArray['salt'];
      $alcohol += (float)$subArray['alcohol'];
    }

    return [
      'calories' => (float)$calories,
      'price' => (float)$price,
      'carbohydrate' => (float)$carbohydrate,
      'sugar' => (float)$sugar,
      'fat' => (float)$fat,
      'saturated' => (float)$saturated,
      'protein' => (float)$protein,
      'fibre' => (float)$fibre,
      'salt' => (float)$salt,
      'alcohol' => (float)$alcohol,
    ];
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

          'weight' => $array['amount'],

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

    $totalWeight = 0;
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
      $totalWeight += $output[$i]['weight'];
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

      'weight' => $totalWeight,
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

    return $log;
  }
}