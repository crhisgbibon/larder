<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelFoods;

require_once __DIR__ . '/simple_dom/simple_html_dom.php';

class ControllerFoods extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function Food()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelFoods();
    $foods = $model->GetFoods('A');
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    $vendors = $model->GetVendors();
    return view('foods', [
      'foods' => $foods,
      'targets' => $targets,
      'profile' => $profile,
      'vendors' => $vendors,
    ]);
  }

  public function ChangeLetter(Request $request)
  {
    $filter = (string)$request->data[0];
    // return $filter;
    date_default_timezone_set("Europe/London");
    $model = new ModelFoods();
    $foods = $model->GetFoods($filter);
    $vendors = $model->GetVendors();
    return view('components.Foods.data', [
      'foods' => $foods,
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

    $filter = (string)$request->data[17];

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

    $model = new ModelFoods();
    $debug = $model->AddFood($data);
    $foods = $model->GetFoods($filter);
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

    $model = new ModelFoods();
    $debug = $model->UpdateFood($data);
  }

  public function DeleteFood(Request $request)
  {
    $index = (int)$request->data[0];
    $filter = (string)$request->data[1];

    $model = new ModelFoods();
    $model->DeleteFood($index);
    $foods = $model->GetFoods($filter);
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
      $model = new ModelFoods();
      $food = $model->GetFood($id);
      $amount = ( $food->weight / $food->servings ) * $amount;
    }

    $data = [
      'id' => $id,
      'mode' => $mode,
      'amount' => $amount,
    ];

    $model = new ModelFoods();
    $debug = $model->AddFoodLog($data);
    return $debug;
  }

  public function GetScrapeWAITROSE(Request $request)
  {
    // return $request->url;

    $url = $request->url;

    $dom = file_get_html($url, false);

    //collect all user’s reviews into an array
    $answer = new \stdClass();
    if(!empty($dom))
    {
      $divClass = $title = '';

      $names = $dom->find("*[data-testid=product-name]");
      foreach($names as $name)
      {
        $answer->name = $name->innertext;
      }

      $answer->vendor = "Waitrose";

      $weights = $dom->find("*[data-testid=product-size]");
      foreach($weights as $weight)
      {
        $answer->weight = $weight->innertext;
        if(str_contains($answer->weight, "x"))
        {
          $iof = strpos($answer->weight, "x");
          $one = substr($answer->weight, 0, $iof);
          $two = substr($answer->weight, $iof + 1);
          $newWeight = (float)$one * (float)$two;
          $answer->weight = $newWeight;
        }
      }

      $prices = $dom->find("[data-test=product-pod-price]");
      foreach($prices as $price)
      {
        $answer->price = $price->children(0)->innertext;
        if(str_contains($answer->price, "p")) $answer->price = "0." . $answer->price;
      }

      $answer->per = 100;

      $rows = $dom->find("tr");
      $value = 1;
      foreach($rows as $row)
      {
        if($row->childNodes(0)->innertext === "Energy") if(str_contains($row->childNodes($value)->innertext, "cal")) $answer->calories = $row->childNodes($value)->innertext;
        if($row->childNodes(0)->innertext === "Fat") $answer->fat = $row->childNodes($value)->innertext;
        if($row->childNodes(0)->innertext === "Of which Saturates") $answer->saturated = $row->childNodes($value)->innertext;

        if($row->childNodes(0)->innertext === "Carbohydrate") $answer->carbohydrate = $row->childNodes($value)->innertext;
        if($row->childNodes(0)->innertext === "Of which Sugars") $answer->sugar = $row->childNodes($value)->innertext;
        if($row->childNodes(0)->innertext === "Fibre") $answer->fibre = $row->childNodes($value)->innertext;

        if($row->childNodes(0)->innertext === "Protein") $answer->protein = $row->childNodes($value)->innertext;
        if($row->childNodes(0)->innertext === "Salt") $answer->salt = $row->childNodes($value)->innertext;
      }
    }

    if(!isset($answer->weight)) $answer->weight = 0;
    if(!isset($answer->price)) $answer->price = 0;

    if(!isset($answer->calories)) $answer->calories = 0;
    if(!isset($answer->fat)) $answer->fat = 0;
    if(!isset($answer->saturated)) $answer->saturated = 0;

    if(!isset($answer->carbohydrate)) $answer->carbohydrate = 0;
    if(!isset($answer->sugar)) $answer->sugar = 0;
    if(!isset($answer->fibre)) $answer->fibre = 0;

    if(!isset($answer->protein)) $answer->protein = 0;
    if(!isset($answer->salt)) $answer->salt = 0;

    $regEx = ",";

    $answer->weight = str_replace($regEx, '.', (string)$answer->weight);
    $answer->price = str_replace($regEx, '.', (string)$answer->price);

    $answer->calories = str_replace($regEx, '.', (string)$answer->calories);
    $answer->fat = str_replace($regEx, '.', (string)$answer->fat);
    $answer->saturated = str_replace($regEx, '.', (string)$answer->saturated);

    $answer->carbohydrate = str_replace($regEx, '.', (string)$answer->carbohydrate);
    $answer->sugar = str_replace($regEx, '.', (string)$answer->sugar);
    $answer->fibre = str_replace($regEx, '.', (string)$answer->fibre);

    $answer->protein = str_replace($regEx, '.', (string)$answer->protein);
    $answer->salt = str_replace($regEx, '.', (string)$answer->salt);

    $regEx = "/[a-zA-Z£]/";

    $answer->weight = (float)preg_replace($regEx, '', $answer->weight);
    $answer->price = (float)preg_replace($regEx, '', $answer->price);

    $answer->calories = (float)preg_replace($regEx, '', $answer->calories);
    $answer->fat = (float)preg_replace($regEx, '', $answer->fat);
    $answer->saturated = (float)preg_replace($regEx, '', $answer->saturated);

    $answer->carbohydrate = (float)preg_replace($regEx, '', $answer->carbohydrate);
    $answer->sugar = (float)preg_replace($regEx, '', $answer->sugar);
    $answer->fibre = (float)preg_replace($regEx, '', $answer->fibre);

    $answer->protein = (float)preg_replace($regEx, '', $answer->protein);
    $answer->salt = (float)preg_replace($regEx, '', $answer->salt);

    $answer->alcohol = 0;
    $answer->servings = 1;
    $answer->expiry = 30;

    // return $answer;

    return response()->json([
      'answer' => $answer,
    ]);
  }

  public function GetScrapePRET(Request $request)
  {
    // return $request->url;

    $url = $request->url;

    $dom = file_get_html($url, false);

    // return gettype($dom);

    //collect all user’s reviews into an array
    $answer = new \stdClass();
    if(!empty($dom))
    {
      $divClass = $title = '';

      $names = $dom->find("*[class=ez38nvu6 css-stupdb e18f67ik6]");
      foreach($names as $name)
      {
        $answer->name = $name->innertext;
      }

      $answer->price = 0;

      $answer->vendor = "PRET";

      $answer->per = 100;

      $rows = $dom->find("tr");
      $value = 1;
      foreach($rows as $row)
      {
        if($row->hasClass("row-B"))
        {
          $one = $row->childNodes(1)->innertext;
          $two = $row->childNodes(2)->innertext;
          $answer->weight = (float)number_format(((100 / (float)$one) * (float)$two), 2);
          $answer->calories = $one;
          $answer->one = $one;
          $answer->two = $two;
        }
        if($row->hasClass("row-C"))
        {
          $answer->fat = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-D"))
        {
          $answer->saturated = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-E"))
        {
          $answer->carbohydrate = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-F"))
        {
          $answer->sugar = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-G"))
        {
          $answer->fibre = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-H"))
        {
          $answer->protein = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-I"))
        {
          $answer->salt = $row->childNodes($value)->innertext;
        }
      }
    }

    if(!isset($answer->weight)) $answer->weight = 0;
    if(!isset($answer->price)) $answer->price = 0;

    if(!isset($answer->calories)) $answer->calories = 0;
    if(!isset($answer->fat)) $answer->fat = 0;
    if(!isset($answer->saturated)) $answer->saturated = 0;

    if(!isset($answer->carbohydrate)) $answer->carbohydrate = 0;
    if(!isset($answer->sugar)) $answer->sugar = 0;
    if(!isset($answer->fibre)) $answer->fibre = 0;

    if(!isset($answer->protein)) $answer->protein = 0;
    if(!isset($answer->salt)) $answer->salt = 0;

    $regEx = ",";

    $answer->weight = str_replace($regEx, '.', (string)$answer->weight);
    $answer->price = str_replace($regEx, '.', (string)$answer->price);

    $answer->calories = str_replace($regEx, '.', (string)$answer->calories);
    $answer->fat = str_replace($regEx, '.', (string)$answer->fat);
    $answer->saturated = str_replace($regEx, '.', (string)$answer->saturated);

    $answer->carbohydrate = str_replace($regEx, '.', (string)$answer->carbohydrate);
    $answer->sugar = str_replace($regEx, '.', (string)$answer->sugar);
    $answer->fibre = str_replace($regEx, '.', (string)$answer->fibre);

    $answer->protein = str_replace($regEx, '.', (string)$answer->protein);
    $answer->salt = str_replace($regEx, '.', (string)$answer->salt);

    $regEx = "/[a-zA-Z£]/";

    $answer->weight = (float)preg_replace($regEx, '', $answer->weight);
    $answer->price = (float)preg_replace($regEx, '', $answer->price);

    $answer->calories = (float)preg_replace($regEx, '', $answer->calories);
    $answer->fat = (float)preg_replace($regEx, '', $answer->fat);
    $answer->saturated = (float)preg_replace($regEx, '', $answer->saturated);

    $answer->carbohydrate = (float)preg_replace($regEx, '', $answer->carbohydrate);
    $answer->sugar = (float)preg_replace($regEx, '', $answer->sugar);
    $answer->fibre = (float)preg_replace($regEx, '', $answer->fibre);

    $answer->protein = (float)preg_replace($regEx, '', $answer->protein);
    $answer->salt = (float)preg_replace($regEx, '', $answer->salt);

    $answer->alcohol = 0;
    $answer->servings = 1;
    $answer->expiry = 30;

    return response()->json([
      'answer' => $answer,
    ]);
  }

  public function GetScrapeTESCO(Request $request)
  {
    // return $request->url;

    $url = $request->url;

    $dom = file_get_html($url, false);

    // return gettype($dom);

    //collect all user’s reviews into an array
    $answer = new \stdClass();
    if(!empty($dom))
    {
      $divClass = $title = '';

      $names = $dom->find("*[class=ez38nvu6 css-stupdb e18f67ik6]");
      foreach($names as $name)
      {
        $answer->name = $name->innertext;
      }

      $answer->price = 0;

      $answer->vendor = "PRET";

      $answer->per = 100;

      $rows = $dom->find("tr");
      $value = 1;
      foreach($rows as $row)
      {
        if($row->hasClass("row-B"))
        {
          $one = $row->childNodes(1)->innertext;
          $two = $row->childNodes(2)->innertext;
          $answer->weight = (float)number_format(((100 / (float)$one) * (float)$two), 2);
          $answer->calories = $one;
          $answer->one = $one;
          $answer->two = $two;
        }
        if($row->hasClass("row-C"))
        {
          $answer->fat = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-D"))
        {
          $answer->saturated = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-E"))
        {
          $answer->carbohydrate = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-F"))
        {
          $answer->sugar = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-G"))
        {
          $answer->fibre = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-H"))
        {
          $answer->protein = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-I"))
        {
          $answer->salt = $row->childNodes($value)->innertext;
        }
      }
    }

    if(!isset($answer->weight)) $answer->weight = 0;
    if(!isset($answer->price)) $answer->price = 0;

    if(!isset($answer->calories)) $answer->calories = 0;
    if(!isset($answer->fat)) $answer->fat = 0;
    if(!isset($answer->saturated)) $answer->saturated = 0;

    if(!isset($answer->carbohydrate)) $answer->carbohydrate = 0;
    if(!isset($answer->sugar)) $answer->sugar = 0;
    if(!isset($answer->fibre)) $answer->fibre = 0;

    if(!isset($answer->protein)) $answer->protein = 0;
    if(!isset($answer->salt)) $answer->salt = 0;

    $regEx = ",";

    $answer->weight = str_replace($regEx, '.', (string)$answer->weight);
    $answer->price = str_replace($regEx, '.', (string)$answer->price);

    $answer->calories = str_replace($regEx, '.', (string)$answer->calories);
    $answer->fat = str_replace($regEx, '.', (string)$answer->fat);
    $answer->saturated = str_replace($regEx, '.', (string)$answer->saturated);

    $answer->carbohydrate = str_replace($regEx, '.', (string)$answer->carbohydrate);
    $answer->sugar = str_replace($regEx, '.', (string)$answer->sugar);
    $answer->fibre = str_replace($regEx, '.', (string)$answer->fibre);

    $answer->protein = str_replace($regEx, '.', (string)$answer->protein);
    $answer->salt = str_replace($regEx, '.', (string)$answer->salt);

    $regEx = "/[a-zA-Z£]/";

    $answer->weight = (float)preg_replace($regEx, '', $answer->weight);
    $answer->price = (float)preg_replace($regEx, '', $answer->price);

    $answer->calories = (float)preg_replace($regEx, '', $answer->calories);
    $answer->fat = (float)preg_replace($regEx, '', $answer->fat);
    $answer->saturated = (float)preg_replace($regEx, '', $answer->saturated);

    $answer->carbohydrate = (float)preg_replace($regEx, '', $answer->carbohydrate);
    $answer->sugar = (float)preg_replace($regEx, '', $answer->sugar);
    $answer->fibre = (float)preg_replace($regEx, '', $answer->fibre);

    $answer->protein = (float)preg_replace($regEx, '', $answer->protein);
    $answer->salt = (float)preg_replace($regEx, '', $answer->salt);

    $answer->alcohol = 0;
    $answer->servings = 1;
    $answer->expiry = 30;

    return response()->json([
      'answer' => $answer,
    ]);
  }

  public function GetScrapeSAINSBURYS(Request $request)
  {
    // return $request->url;

    $url = $request->url;

    $dom = file_get_html($url, false);

    // return gettype($dom);

    //collect all user’s reviews into an array
    $answer = new \stdClass();
    if(!empty($dom))
    {
      $divClass = $title = '';

      $names = $dom->find("*[class=ez38nvu6 css-stupdb e18f67ik6]");
      foreach($names as $name)
      {
        $answer->name = $name->innertext;
      }

      $answer->price = 0;

      $answer->vendor = "PRET";

      $answer->per = 100;

      $rows = $dom->find("tr");
      $value = 1;
      foreach($rows as $row)
      {

        if($row->hasClass("row-B"))
        {
          $one = $row->childNodes(1)->innertext;
          $two = $row->childNodes(2)->innertext;
          $answer->weight = (float)number_format(((100 / (float)$one) * (float)$two), 2);
          $answer->calories = $one;
          $answer->one = $one;
          $answer->two = $two;
        }
        if($row->hasClass("row-C"))
        {
          $answer->fat = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-D"))
        {
          $answer->saturated = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-E"))
        {
          $answer->carbohydrate = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-F"))
        {
          $answer->sugar = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-G"))
        {
          $answer->fibre = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-H"))
        {
          $answer->protein = $row->childNodes($value)->innertext;
        }
        if($row->hasClass("row-I"))
        {
          $answer->salt = $row->childNodes($value)->innertext;
        }
      }
    }

    if(!isset($answer->weight)) $answer->weight = 0;
    if(!isset($answer->price)) $answer->price = 0;

    if(!isset($answer->calories)) $answer->calories = 0;
    if(!isset($answer->fat)) $answer->fat = 0;
    if(!isset($answer->saturated)) $answer->saturated = 0;

    if(!isset($answer->carbohydrate)) $answer->carbohydrate = 0;
    if(!isset($answer->sugar)) $answer->sugar = 0;
    if(!isset($answer->fibre)) $answer->fibre = 0;

    if(!isset($answer->protein)) $answer->protein = 0;
    if(!isset($answer->salt)) $answer->salt = 0;

    $regEx = ",";

    $answer->weight = str_replace($regEx, '.', (string)$answer->weight);
    $answer->price = str_replace($regEx, '.', (string)$answer->price);

    $answer->calories = str_replace($regEx, '.', (string)$answer->calories);
    $answer->fat = str_replace($regEx, '.', (string)$answer->fat);
    $answer->saturated = str_replace($regEx, '.', (string)$answer->saturated);

    $answer->carbohydrate = str_replace($regEx, '.', (string)$answer->carbohydrate);
    $answer->sugar = str_replace($regEx, '.', (string)$answer->sugar);
    $answer->fibre = str_replace($regEx, '.', (string)$answer->fibre);

    $answer->protein = str_replace($regEx, '.', (string)$answer->protein);
    $answer->salt = str_replace($regEx, '.', (string)$answer->salt);

    $regEx = "/[a-zA-Z£]/";

    $answer->weight = (float)preg_replace($regEx, '', $answer->weight);
    $answer->price = (float)preg_replace($regEx, '', $answer->price);

    $answer->calories = (float)preg_replace($regEx, '', $answer->calories);
    $answer->fat = (float)preg_replace($regEx, '', $answer->fat);
    $answer->saturated = (float)preg_replace($regEx, '', $answer->saturated);

    $answer->carbohydrate = (float)preg_replace($regEx, '', $answer->carbohydrate);
    $answer->sugar = (float)preg_replace($regEx, '', $answer->sugar);
    $answer->fibre = (float)preg_replace($regEx, '', $answer->fibre);

    $answer->protein = (float)preg_replace($regEx, '', $answer->protein);
    $answer->salt = (float)preg_replace($regEx, '', $answer->salt);

    $answer->alcohol = 0;
    $answer->servings = 1;
    $answer->expiry = 30;

    return response()->json([
      'answer' => $answer,
    ]);
  }

  public function GetScrapeASDA(Request $request)
  {
    // return $request->url;

    $url = $request->url;

    $dom = file_get_html($url, false);

    // return gettype($dom);
    return $dom;

    //collect all user’s reviews into an array
    $answer = new \stdClass();
    if(!empty($dom))
    {
      $names = $dom->find("*[data-auto-id=titleRating]");
      foreach($names as $name)
      {
        // $answer->name = $name->innertext;
        $answer->name = $name->children(0)->innertext;
      }

      $prices = $dom->find("*[class=co-product__price pdp-main-details__price]");
      foreach($prices as $price)
      {
        $answer->price = $price->children(0)->innertext;
        if(str_contains($answer->price, "p")) $answer->price = "0." . $answer->price;
      }

      $answer->vendor = "ASDA";

      $answer->per = 100;

      $rows = $dom->find("*[class=pdp-description-reviews__nutrition-row pdp-description-reviews__nutrition-row--details]");
      $len = count($rows);
      $value = 1;
      for($i = 0; $i < $len; $i++)
      {
        if($row[$i]->childNodes(0)->innertext === "Energy")
        {
          $next = $i + 1;
          $one = (float)$row[$next]->childNodes(1)->innertext;
          $two = (float)$row[$next]->childNodes(2)->innertext;
          $answer->weight = (float)number_format(((100 / $one) * $two), 2);
          $answer->calories = $one;
          $answer->one = $one;
          $answer->two = $two;
        }

        if($row[$i]->childNodes(0)->innertext === "Fat ") $answer->fat = $row[$i]->childNodes($value)->innertext;
        if($row[$i]->childNodes(0)->innertext === " of which saturates ") $answer->saturated = $row[$i]->childNodes($value)->innertext;

        if($row[$i]->childNodes(0)->innertext === "Carbohydrate ") $answer->carbohydrate = $row[$i]->childNodes($value)->innertext;
        if($row[$i]->childNodes(0)->innertext === " of which sugars ") $answer->sugar = $row[$i]->childNodes($value)->innertext;
        if($row[$i]->childNodes(0)->innertext === "Fibre") $answer->fibre = $row[$i]->childNodes($value)->innertext;

        if($row[$i]->childNodes(0)->innertext === "Protein ") $answer->protein = $row[$i]->childNodes($value)->innertext;
        if($row[$i]->childNodes(0)->innertext === "Salt ") $answer->salt = $row[$i]->childNodes($value)->innertext;
      }
    }

    if(!isset($answer->weight)) $answer->weight = 0;
    if(!isset($answer->price)) $answer->price = 0;

    if(!isset($answer->calories)) $answer->calories = 0;
    if(!isset($answer->fat)) $answer->fat = 0;
    if(!isset($answer->saturated)) $answer->saturated = 0;

    if(!isset($answer->carbohydrate)) $answer->carbohydrate = 0;
    if(!isset($answer->sugar)) $answer->sugar = 0;
    if(!isset($answer->fibre)) $answer->fibre = 0;

    if(!isset($answer->protein)) $answer->protein = 0;
    if(!isset($answer->salt)) $answer->salt = 0;

    $regEx = ",";

    $answer->weight = str_replace($regEx, '.', (string)$answer->weight);
    $answer->price = str_replace($regEx, '.', (string)$answer->price);

    $answer->calories = str_replace($regEx, '.', (string)$answer->calories);
    $answer->fat = str_replace($regEx, '.', (string)$answer->fat);
    $answer->saturated = str_replace($regEx, '.', (string)$answer->saturated);

    $answer->carbohydrate = str_replace($regEx, '.', (string)$answer->carbohydrate);
    $answer->sugar = str_replace($regEx, '.', (string)$answer->sugar);
    $answer->fibre = str_replace($regEx, '.', (string)$answer->fibre);

    $answer->protein = str_replace($regEx, '.', (string)$answer->protein);
    $answer->salt = str_replace($regEx, '.', (string)$answer->salt);

    $regEx = "/[a-zA-Z£]/";

    $answer->weight = (float)preg_replace($regEx, '', $answer->weight);
    $answer->price = (float)preg_replace($regEx, '', $answer->price);

    $answer->calories = (float)preg_replace($regEx, '', $answer->calories);
    $answer->fat = (float)preg_replace($regEx, '', $answer->fat);
    $answer->saturated = (float)preg_replace($regEx, '', $answer->saturated);

    $answer->carbohydrate = (float)preg_replace($regEx, '', $answer->carbohydrate);
    $answer->sugar = (float)preg_replace($regEx, '', $answer->sugar);
    $answer->fibre = (float)preg_replace($regEx, '', $answer->fibre);

    $answer->protein = (float)preg_replace($regEx, '', $answer->protein);
    $answer->salt = (float)preg_replace($regEx, '', $answer->salt);

    $answer->alcohol = 0;
    $answer->servings = 1;
    $answer->expiry = 30;

    return response()->json([
      'answer' => $answer,
    ]);
  }
}