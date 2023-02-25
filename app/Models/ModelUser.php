<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ModelUser extends Model
{
  use HasFactory;

  protected $table = "logs";

  public function GetProfile()
  {
    $id = Auth::user()->id;
    return $profile = DB::table('profiles')
    ->where('userID', '=', $id)
    ->first();
  }

  public function GetWeights()
  {
    $id = Auth::user()->id;
    return $profile = DB::table('weights')
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('logTime', 'desc')
    ->get();
  }

  public function GetNutrientTargets()
  {
    $id = Auth::user()->id;
    return $profiles = DB::table('nutrient_goals')
    ->where('userID', '=', $id)
    ->first();
  }

  public function GetLastWeight()
  {
    $userID = Auth::id();
    return $lastWeight = DB::table('weights')
    ->where('userID', '=', $userID)
    ->where('hiddenRow', '=', 0)
    ->orderBy('logTime', 'desc')
    ->first();
  }

  public function GetBMR($profile, $lastWeight)
  {
    if(isset($profile) && isset($lastWeight))
    {
      $age = floor((time() - $profile->dateofbirth) / 31556926);
      if($profile->gender === 1) // Male
      {
        $BMR = (66.47 + (13.75 * $lastWeight->weight) + (5.003 * $profile->height) - (6.755 * $age));
      }
      else // Female
      {
        $BMR = (655.1 + (9.563 * $lastWeight->weight) + (1.85 * $profile->height) - (4.676 * $age));
      }
    }
    else
    {
      $BMR = 2000;
    }

    $noExercise = number_format($BMR * 1.2, 0);
    $lightExercise = number_format($BMR * 1.375, 0);
    $moderateExercise = number_format($BMR * 1.55, 0);
    $veryActive = number_format($BMR * 1.725, 0);
    $extraActive = number_format($BMR * 1.9, 0);
    $BMR = number_format($BMR, 0);

    return [
      'BMR' => $BMR,
      'noExercise' => $noExercise,
      'lightExercise' => $lightExercise,
      'moderateExercise' => $moderateExercise,
      'veryActive' => $veryActive,
      'extraActive' => $extraActive
    ];
  }

  public function UpdateProfile(array $data)
  {
    $id = Auth::user()->id;
    DB::table('profiles')->upsert(
      [
        [ 'userID' => $id,

          'gender' => $data['gender'],
          'height' => $data['height'],
          'dateofbirth' => $data['dob'],

          'weightTarget' => $data['weightTarget'],
          'caloryBurn' => $data['caloryBurn'],
          'caloryGoal' => $data['caloryGoal'],
        ]
      ],
      [ 'userID' ],
      [ 'gender', 'height', 'dateofbirth', 'weightTarget', 'caloryBurn', 'caloryGoal' ]
    );
  }

  public function UpdateNutrient(array $data)
  {
    $id = Auth::user()->id;
    DB::table('nutrient_goals')->upsert(
      [
        [ 'userID' => $id,

          'carbohydrate' => $data['carbohydrate'],
          'sugar' => $data['sugar'],
          'fat' => $data['fat'],

          'saturated' => $data['saturated'],
          'protein' => $data['protein'],
          'fibre' => $data['fibre'],

          'salt' => $data['salt'],
          'alcohol' => $data['alcohol'],
        ]
      ],
      [ 'userID' ],
      [ 'carbohydrate', 'sugar', 'fat', 'saturated', 'protein', 'fibre', 'salt' , 'alcohol' ]
    );
  }

  public function AddWeightLog($weight)
  {
    $userID = Auth::id();
    $now = time();
    DB::table('weights')->insert([
      'userID' => $userID,
      'logTime' => $now,
      'weight' => $weight,
      'hiddenRow' => 0
    ]);
  }

  public function DeleteWeightLog($index)
  {
    $userID = Auth::id();
    DB::table('weights')
    ->where('userID', "=", $userID)
    ->where('id', "=", $index)
    ->update([
      'hiddenRow' => 1
    ]);
  }

  public function GetChartData()
  {
    $weights = $this->GetFormattedWeights();
    $calories = $this->GetFormattedCalories();
    $bmi = $this->GetBMI();
    $price = $this->GetFormattedPrices();
    $nutrients = $this->GetChartNutrients();
    return [
      'weights' => $weights,
      'calories' => $calories,
      'bmi' => $bmi,
      'price' => $price,
      'nutrients' => $nutrients,
    ];
  }

  public function GetFormattedWeights()
  {
    $id = Auth::user()->id;

    $week = strtotime("-7 days");
    $month = strtotime("-30 days");
    $quarter = strtotime("-90 days");
    $year = strtotime("-365 days");
    $decade = strtotime("-10 years");

    $weights = DB::table('weights')
    ->select(
      'id',
      'logTime',
      'weight',
    )
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('logTime', 'asc')
    ->get();

    $weights2 = [];
    foreach($weights as $weight)
    {
      $newWeight = [
        'logTime' => date("y-m-d", $weight->logTime),
        'weight' => $weight->weight,
        'period' => ""
      ];
      // week = 604800, month = 2592000, quarter = 7776000, year = 31536000, decade = 315569520
      $newWeight['period'] = "FOREVER";
      if( $decade < $weight->logTime ) $newWeight['period'] = "DECADE";
      if( $year < $weight->logTime ) $newWeight['period'] = "YEAR";
      if( $quarter < $weight->logTime ) $newWeight['period'] = "QUARTER";
      if( $month < $weight->logTime ) $newWeight['period'] = "MONTH";
      if( $week < $weight->logTime ) $newWeight['period'] = "WEEK";
      array_push($weights2, $newWeight);
    }
    return $weights2;
  }

  public function GetFormattedCalories()
  {
    $id = Auth::user()->id;

    $week = strtotime("-7 days");
    $month = strtotime("-30 days");
    $quarter = strtotime("-90 days");
    $year = strtotime("-365 days");
    $decade = strtotime("-10 years");

    $logTimes = DB::table('logs')
    ->join('foods', 'logs.itemID', '=', 'foods.id')
    ->select(
      'logs.logTime',
      'foods.calories',
    )
    ->where('logs.userID', '=', $id)
    ->where('logs.hiddenRow', '=', 0)
    ->orderBy('logs.logTime', 'asc')
    ->get();

    $days = [];
    foreach($logTimes as $log)
    {
      $day = date("y-m-d", $log->logTime);
      if(array_key_exists($day, $days))
      {
        $days[$day]['calories'] += $log->calories;
      }
      else
      {
        $days[$day]['calories'] = 0;

        $days[$day]['period'] = "FOREVER";
        if( $decade < $log->logTime ) $days[$day]['period'] = "DECADE";
        if( $year < $log->logTime ) $days[$day]['period'] = "YEAR";
        if( $quarter < $log->logTime ) $days[$day]['period'] = "QUARTER";
        if( $month < $log->logTime ) $days[$day]['period'] = "MONTH";
        if( $week < $log->logTime ) $days[$day]['period'] = "WEEK";

        $days[$day]['day'] = date("y-m-d", $log->logTime);
        $days[$day]['calories'] += $log->calories;
      }
    }
    $days = json_decode(json_encode($days), true);
    $newDays = [];
    foreach($days as $day)
    {
      $d = [
        'logTime' => $day['day'],
        'calories' => $day['calories'],
        'period' => $day['period'],
      ];
      array_push($newDays, $d);
    }
    return $newDays;
  }

  public function GetBMI()
  {
    $id = Auth::user()->id;

    $week = strtotime("-7 days");
    $month = strtotime("-30 days");
    $quarter = strtotime("-90 days");
    $year = strtotime("-365 days");
    $decade = strtotime("-10 years");

    $weights = DB::table('weights')
    ->select(
      'id',
      'logTime',
      'weight',
    )
    ->where('userID', '=', $id)
    ->where('hiddenRow', '=', 0)
    ->orderBy('logTime', 'asc')
    ->get();

    $profile = $this->GetProfile();
    if($profile === null) return;
    $height = $profile->height / 100;
    $output = [];
    foreach($weights as $weight)
    {
      $bmi = number_format( ($weight->weight / ($height * $height)), 2);

      $period = "FOREVER";
      if( $decade < $weight->logTime ) $period = "DECADE";
      if( $year < $weight->logTime ) $period = "YEAR";
      if( $quarter < $weight->logTime ) $period = "QUARTER";
      if( $month < $weight->logTime ) $period = "MONTH";
      if( $week < $weight->logTime ) $period = "WEEK";

      $o = [
        'bmi' => $bmi,
        'logTime' => date("y-m-d", $weight->logTime),
        'period' => $period,
      ];
      array_push($output, $o);
    }
    return $output;
  }

  public function GetFormattedPrices()
  {
    $id = Auth::user()->id;

    $week = strtotime("-7 days");
    $month = strtotime("-30 days");
    $quarter = strtotime("-90 days");
    $year = strtotime("-365 days");
    $decade = strtotime("-10 years");

    $logTimes = DB::table('logs')
    ->join('foods', 'logs.itemID', '=', 'foods.id')
    ->select(
      'logTime',
      'foods.price',
    )
    ->where('logs.userID', '=', $id)
    ->where('logs.hiddenRow', '=', 0)
    ->orderBy('logTime', 'asc')
    ->get();

    $days = [];
    foreach($logTimes as $log)
    {
      $day = date("y-m-d", $log->logTime);
      if(array_key_exists($day, $days))
      {
        $days[$day]['price'] += $log->price;
      }
      else
      {
        $days[$day]['price'] = 0;
        $days[$day]['day'] = $day;
        $days[$day]['price'] += $log->price;

        $days[$day]['period'] = "FOREVER";
        if( $decade < $log->logTime ) $days[$day]['period'] = "DECADE";
        if( $year < $log->logTime ) $days[$day]['period'] = "YEAR";
        if( $quarter < $log->logTime ) $days[$day]['period'] = "QUARTER";
        if( $month < $log->logTime ) $days[$day]['period'] = "MONTH";
        if( $week < $log->logTime ) $days[$day]['period'] = "WEEK";
      }
    }
    $days = json_decode(json_encode($days), true);
    $newDays = [];
    foreach($days as $day)
    {
      $d = [
        'logTime' => $day['day'], 
        'price' => $day['price'],
        'period' => $day['period'],
      ];
      array_push($newDays, $d);
    }
    return $newDays;
  }

  public function GetChartNutrients()
  {
    $targets = $this->GetNutrientTargets();
    if($targets === null) return;

    $week = strtotime("-7 days");
    $month = strtotime("-30 days");
    $quarter = strtotime("-90 days");
    $year = strtotime("-365 days");
    $decade = strtotime("-10 years");
    
    $newTargets = [];
    foreach($targets as $key => $value)
    {
      if($key === 'id' || $key === 'userID') continue;
      $newTarget = [
        'name' => $key,
        'total' => $value,
      ];
      array_push($newTargets, $newTarget);
    }

    $id = Auth::user()->id;
    $logTimes = DB::table('logs')
    ->join('foods', 'logs.itemID', '=', 'foods.id')
    ->select(
      'logTime',
      'foods.carbohydrate',
      'foods.sugar',
      'foods.fat',
      'foods.saturated',
      'foods.protein',
      'foods.fibre',
      'foods.salt',
      'foods.alcohol',
    )
    ->where('logs.userID', '=', $id)
    ->where('logs.hiddenRow', '=', 0)
    ->orderBy('logTime', 'asc')
    ->get();

    $days = [];
    foreach($logTimes as $log)
    {
      $day = date("y-m-d", $log->logTime);
      if(array_key_exists($day, $days))
      {
        $days[$day]['carbohydrate'] += $log->carbohydrate;
        $days[$day]['sugar'] += $log->sugar;
        $days[$day]['fat'] += $log->fat;
        $days[$day]['saturated'] += $log->saturated;
        $days[$day]['protein'] += $log->protein;
        $days[$day]['fibre'] += $log->fibre;
        $days[$day]['salt'] += $log->salt;
        $days[$day]['alcohol'] += $log->alcohol;
      }
      else
      {
        $days[$day]['carbohydrate'] = 0;
        $days[$day]['sugar'] = 0;
        $days[$day]['fat'] = 0;
        $days[$day]['saturated'] = 0;
        $days[$day]['protein'] = 0;
        $days[$day]['fibre'] = 0;
        $days[$day]['salt'] = 0;
        $days[$day]['alcohol'] = 0;

        $days[$day]['day'] = $day;

        $days[$day]['carbohydrate'] += $log->carbohydrate;
        $days[$day]['sugar'] += $log->sugar;
        $days[$day]['fat'] += $log->fat;
        $days[$day]['saturated'] += $log->saturated;
        $days[$day]['protein'] += $log->protein;
        $days[$day]['fibre'] += $log->fibre;
        $days[$day]['salt'] += $log->salt;
        $days[$day]['alcohol'] += $log->alcohol;

        $days[$day]['period'] = "FOREVER";
        if( $decade < $log->logTime ) $days[$day]['period'] = "DECADE";
        if( $year < $log->logTime ) $days[$day]['period'] = "YEAR";
        if( $quarter < $log->logTime ) $days[$day]['period'] = "QUARTER";
        if( $month < $log->logTime ) $days[$day]['period'] = "MONTH";
        if( $week < $log->logTime ) $days[$day]['period'] = "WEEK";
      }
    }
    $days = json_decode(json_encode($days), true);
    $newDays = [];
    foreach($days as $day)
    {
      $d = [
        'logTime' => $day['day'], 
        'carbohydrate' => $day['carbohydrate'],
        'sugar' => $day['sugar'],
        'fat' => $day['fat'],
        'saturated' => $day['saturated'],
        'protein' => $day['protein'],
        'fibre' => $day['fibre'],
        'salt' => $day['salt'],
        'alcohol' => $day['alcohol'],
        'period' => $day['period'],
      ];
      array_push($newDays, $d);
    }
    return [ 
      'days' => $newDays,
      'targets' => $newTargets,
    ];
  }
}