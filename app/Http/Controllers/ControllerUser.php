<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelUser;

class ControllerUser extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function User()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelUser();
    $profile = $model->GetProfile();
    $weights = $model->GetWeights();
    $goal = $model->GetNutrientTargets();
    $lastWeight = $model->GetLastWeight();
    $bmr = $model->GetBMR($profile, $lastWeight);
    $chartdata = $model->GetChartData();
    return view('user', [
      'profile' => $profile,
      'weights' => $weights,
      'goal' => $goal,
      'lastweight' => $lastWeight,
      'bmr' => $bmr,
      'chartdata' => $chartdata,
    ]);
  }

  public function SaveUser(Request $request)
  {
    $gender = (int)$request->data[0];
    $height = (float)$request->data[1];
    $dob = strtotime((string)$request->data[2]);
    $weightTarget = (float)$request->data[3];
    $caloryBurn = (float)$request->data[4];
    $caloryGoal = (float)$request->data[5];

    $data = [
      'gender' => $gender,
      'height' => $height,
      'dob' => $dob,
      'weightTarget' => $weightTarget,
      'caloryBurn' => $caloryBurn,
      'caloryGoal' => $caloryGoal,
    ];

    $model = new ModelUser();
    $model->UpdateProfile($data);

    $profile = $model->GetProfile();
    $weights = $model->GetWeights();
    $goal = $model->GetNutrientTargets();
    $lastWeight = $model->GetLastWeight();
    $bmr = $model->GetBMR($profile, $lastWeight);

    return view('components.User.user', [
      'profile' => $profile,
      'weights' => $weights,
      'goal' => $goal,
      'lastWeight' => $lastWeight,
      'bmr' => $bmr,
    ]);
  }

  public function SaveNutrient(Request $request)
  {
    $carbohydrate = (float)$request->data[0];
    $sugar = (float)$request->data[1];
    $fat = (float)$request->data[2];
    $saturated = (float)$request->data[3];
    $protein = (float)$request->data[4];
    $fibre = (float)$request->data[5];
    $salt = (float)$request->data[6];
    $alcohol = (float)$request->data[7];

    $data = [
      'carbohydrate' => $carbohydrate,
      'sugar' => $sugar,
      'fat' => $fat,
      'saturated' => $saturated,
      'protein' => $protein,
      'fibre' => $fibre,
      'salt' => $salt,
      'alcohol' => $alcohol,
    ];

    $model = new ModelUser();
    $model->UpdateNutrient($data);
  }

  public function SaveWeight(Request $request)
  {
    $newWeight = (float)$request->data[0];
    $model = new ModelUser();
    $model->AddWeightLog($newWeight);
    $weights = $model->GetWeights();
    return view('components.User.weightLog', [
      'weights' => $weights,
    ]);
  }

  public function DeleteWeight(Request $request)
  {
    $index = (int)$request->data[0];
    $model = new ModelUser();
    $model->DeleteWeightLog($index);
    $weights = $model->GetWeights();
    return view('components.User.weightLog', [
      'weights' => $weights,
    ]);
  }
}