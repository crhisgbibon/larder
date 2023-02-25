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
    'recipes.name', 'recipes.servings', 'recipes.ingredients', 'recipes.instructions',
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
      $foods = DB::table('foods')
      ->where('userID', '=', $id)
      ->where('hiddenRow', '=', 0)
      ->orderBy('name', 'asc')
      ->get();
  
      $recipes = DB::table('recipes')
      ->where('userID', '=', $id)
      ->where('hiddenRow', '=', 0)
      ->orderBy('name', 'asc')
      ->get();
  
      foreach($recipeLogs as $log)
      {
        $amount = $log->amount;
        $ingredients = json_decode($log->ingredients);

        $weight = 0;

        $price = 0;
        $calories = 0;
        $carbohydrate = 0;

        $sugar = 0;
        $fat = 0;
        $saturated = 0;

        $protein = 0;
        $fibre = 0;
        $salt = 0;

        $alcohol = 0;

        $expiry = 0;
        $per = 0;
        $servings = 0;

        foreach($recipes as $recipe)
        {
          if((int)$recipe->id === (int)$log->itemID)
          {
            $expiry = $recipe->expiry;
            $per = $recipe->per;
            $servings = $recipe->servings;
            break;
          }
        }
  
        foreach($ingredients as $ingredient)
        {
          $ingredient = json_decode(json_encode($ingredient), true);
          $weight += $ingredient['amount'];
  
          if((string)$ingredient['type'] === "F")
          {
            foreach($foods as $food)
            {
              if((int)$food->id === (int)$ingredient['index'])
              {
                if((int)$food->weight === 0) $food->weight = 1;
                if((int)$food->per === 0) $food->per = 1;
                if((int)$ingredient['amount'] === 0) $ingredient['amount'] = 1;
                $price += ( $food->price / $food->weight ) * (float)$ingredient['amount'];
                $calories += ( $food->calories / $food->per ) * (float)$ingredient['amount'];
                $carbohydrate += ( $food->carbohydrate / $food->per ) * (float)$ingredient['amount'];
  
                $sugar += ( $food->sugar / $food->per ) * (float)$ingredient['amount'];
                $fat += ( $food->fat / $food->per ) * (float)$ingredient['amount'];
                $saturated += ( $food->saturated / $food->per ) * (float)$ingredient['amount'];
  
                $protein += ( $food->protein / $food->per ) * (float)$ingredient['amount'];
                $fibre += ( $food->fibre / $food->per ) * (float)$ingredient['amount'];
                $salt += ( $food->salt / $food->per ) * (float)$ingredient['amount'];
  
                $alcohol += ( $food->alcohol / $food->per ) * (float)$ingredient['amount'];
                break;
              }
            }
          }
          else if($ingredient['type'] === "R")
          {
            // TO BE IMPLEMENTED
          }
        }

        $newLog = new \stdClass;
        $newLog->id = (int)$log->id;
        $newLog->userID = (int)$log->userID;
        $newLog->itemType = (int)$log->itemType;
        $newLog->itemID = (int)$log->itemID;
        $newLog->logTime = (int)$log->logTime;
        $newLog->amount = (float)number_format($log->amount, 2);
        $newLog->name = (string)$log->name;

        $newLog->price = (float)number_format( ($price / $per ) * $amount, 2);
        $newLog->weight = (float)number_format( ($weight / $per ) * $amount, 2);
        $newLog->servings = (float)number_format($servings, 2);
        $newLog->expiry = (int)$expiry;
        $newLog->per = (float)number_format($per, 2);
        $newLog->calories = (float)number_format( ($calories / $per ) * $amount, 2);
        $newLog->carbohydrate = (float)number_format( ($carbohydrate / $per ) * $amount, 2);
        $newLog->sugar = (float)number_format( ($sugar / $per ) * $amount, 2);
        $newLog->fat = (float)number_format( ($fat / $per ) * $amount, 2);
        $newLog->saturated = (float)number_format( ($saturated / $per ) * $amount, 2);
        $newLog->protein = (float)number_format( ($protein / $per ) * $amount, 2);
        $newLog->fibre = (float)number_format( ($fibre / $per ) * $amount, 2);
        $newLog->salt = (float)number_format( ($salt / $per ) * $amount, 2);
        $newLog->alcohol = (float)number_format( ($alcohol / $per ) * $amount, 2);
        $newLog->fibre = (float)number_format( ($fibre / $per ) * $amount, 2);

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
}