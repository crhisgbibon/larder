<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelLarderRecipes;

class ControllerLarderRecipes extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function recipes()
  {
    $model = new ModelLarderRecipes();
    $recipes = $model->GetRecipes();
    $foods = $model->GetFoods();
    return view('recipes', [
      'recipes' => $recipes,
      'foods' => $foods,
    ]);
  }

  public function GetRecipesDataView()
  {
    $model = new ModelLarderRecipes();
    $recipes = $model->GetRecipes();
    return view('components.Recipes.data', [
      'recipes' => $recipes,
    ]);
  }

  public function AddNewRecipe(Request $request)
  {
    $name = (string)$request->data[0];
    $servings = (float)$request->data[1];
    $ingredients = (array)$request->data[2];
    $instructions = (array)$request->data[3];
    $model = new ModelLarderRecipes();
    $model->AddNewRecipe($name, $servings, $ingredients, $instructions);
    return $this->GetRecipesDataView();
  }

  public function DeleteRecipe(Request $request)
  {
    $index = (int)$request->data[0];
    $model = new ModelLarderRecipes();
    $model->DeleteRecipe($index);
    return $this->GetRecipesDataView();
  }

  public function UpdateName(Request $request)
  {
    $index = (int)$request->data[0];
    $newName = (string)$request->data[1];
    $model = new ModelLarderRecipes();
    $model->UpdateName($index, $newName);
  }

  public function EditExisting(Request $request)
  {
    $name = (string)$request->data[0];
    $servings = (float)$request->data[1];
    $ingredients = (array)$request->data[2];
    $instructions = (array)$request->data[3];
    $index = (int)$request->data[4];
    $model = new ModelLarderRecipes();
    $model->EditExistingRecipe($name, $servings, $ingredients, $instructions, $index);
  }

  public function AddLog(Request $request)
  {
    $id = (int)$request->data[0];
    $mode = (string)$request->data[1];
    $amount = (int)$request->data[2];

    $model = new ModelLarderRecipes();

    if($mode === "S")
    {
      $recipe = $model->GetRecipe($id);
      $ingredients = json_decode($recipe->ingredients);
      $weight = 0;
      foreach($ingredients as $ingredient)
      {
        $weight += $ingredient->amount;
      }
      $amount = ( $weight / $recipe->servings ) * $amount;
    }

    $data = [
      'id' => $id,
      'mode' => $mode,
      'amount' => $amount,
    ];

    $debug = $model->AddLog($data);
    return $debug;
  }
}