<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelLarderFoods;

class ControllerLarderFoods extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function foods()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelLarderFoods();
    $foods = $model->GetFoods();
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    return view('foods', [
      'foods' => $foods,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function NewFood(Request $request)
  {
    $name = (string)$request->data[0];
    $vendor = (string)$request->data[1];
    $url = (string)$request->data[2];

    $price = (float)$request->data[3];
    $weight = (float)$request->data[4];
    $servings = (float)$request->data[5];

    $expiry = (float)$request->data[6];
    $per = (float)$request->data[7];
    $calories = (float)$request->data[8];

    $carbohydrate = (float)$request->data[9];
    $sugar = (float)$request->data[10];
    $fat = (float)$request->data[11];

    $saturated = (float)$request->data[12];
    $protein = (float)$request->data[13];
    $fibre = (float)$request->data[14];

    $salt = (float)$request->data[15];
    $alcohol = (float)$request->data[16];

    $data = [
      "name" => $name,
      "vendor" => $vendor,
      "url" => $url,

      "price" => $price,
      "weight" => $weight,
      "servings" => $servings,

      "expiry" => $expiry,
      "per" => $per,
      "calories" => $calories,

      "carbohydrate" => $carbohydrate,
      "sugar" => $sugar,
      "fat" => $fat,

      "saturated" => $saturated,
      "protein" => $protein,
      "fibre" => $fibre,

      "salt" => $salt,
      "alcohol" => $alcohol,

      "fruit" => false,
      "vegetable" => false,
      "vegan" => false,
      "vegetarian" => false,
      "hiddenRow" => false,
    ];

    $model = new ModelLarderFoods();
    $debug = $model->AddFood($data);
    $foods = $model->GetFoods();
    return view('components.Foods.data', [
      'foods' => $foods,
    ]);
  }

  public function UpdateFood(Request $request)
  {
    $index = (int)$request->data[0];
    $name = (string)$request->data[1];
    $vendor = (string)$request->data[2];
    $url = (string)$request->data[3];

    $price = (float)$request->data[4];
    $weight = (float)$request->data[5];
    $servings = (float)$request->data[6];

    $expiry = (float)$request->data[7];
    $per = (float)$request->data[8];
    $calories = (float)$request->data[9];

    $carbohydrate = (float)$request->data[10];
    $sugar = (float)$request->data[11];
    $fat = (float)$request->data[12];

    $saturated = (float)$request->data[13];
    $protein = (float)$request->data[14];
    $fibre = (float)$request->data[15];

    $salt = (float)$request->data[16];
    $alcohol = (float)$request->data[17];

    $data = [
      "index" => $index,
      "name" => $name,
      "vendor" => $vendor,
      "url" => $url,

      "price" => $price,
      "weight" => $weight,
      "servings" => $servings,

      "expiry" => $expiry,
      "per" => $per,
      "calories" => $calories,

      "carbohydrate" => $carbohydrate,
      "sugar" => $sugar,
      "fat" => $fat,

      "saturated" => $saturated,
      "protein" => $protein,
      "fibre" => $fibre,

      "salt" => $salt,
      "alcohol" => $alcohol,

      "fruit" => false,
      "vegetable" => false,
      "vegan" => false,
      "vegetarian" => false,
      "hiddenRow" => false,
    ];

    $model = new ModelLarderFoods();
    $debug = $model->UpdateFood($data);
  }

  public function DeleteFood(Request $request)
  {
    $index = (int)$request->data[0];
    $model = new ModelLarderFoods();
    $model->DeleteFood($index);
    $foods = $model->GetFoods();
    return view('components.Foods.data', [
      'foods' => $foods,
    ]);
  }

  public function AddFoodLog(Request $request)
  {
    $id = (int)$request->data[0];
    $mode = (string)$request->data[1];
    $amount = (int)$request->data[2];

    if($mode === "S")
    {
      $model = new ModelLarderFoods();
      $food = $model->GetFood($id);
      $amount = ( $food->weight / $food->servings ) * $amount;
    }

    $data = [
      'id' => $id,
      'mode' => $mode,
      'amount' => $amount,
    ];

    $model = new ModelLarderFoods();
    $debug = $model->AddFoodLog($data);
    return $debug;
  }
}