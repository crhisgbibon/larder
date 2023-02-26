<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelRecipes;

class ControllerRecipes extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function recipes()
  {
    $model = new ModelRecipes();
    $recipes = $model->GetRecipes();
    // return $recipes;
    $foods = $model->GetFoods();
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    return view('recipes', [
      'recipes' => $recipes,
      'foods' => $foods,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function GetRecipesDataView()
  {
    $model = new ModelRecipes();
    $recipes = $model->GetRecipes();
    $foods = $model->GetFoods();
    return view('components.Recipes.data', [
      'recipes' => $recipes,
      'foods' => $foods,
    ]);
  }

  public function AddNewRecipe(Request $request)
  {
    $name = (string)$request->data[0];
    $servings = (float)$request->data[1];
    if(isset($request->data[2])) $ingredients = (array)$request->data[2];
    else $ingredients = [];
    if(isset($request->data[3])) $instructions = (array)$request->data[3];
    else $instructions = [];
    $model = new ModelRecipes();
    $model->AddNewRecipe($name, $servings, $ingredients, $instructions);
    return $this->GetRecipesDataView();
  }

  public function DeleteRecipe(Request $request)
  {
    $index = (int)$request->data[0];
    $model = new ModelRecipes();
    $model->DeleteRecipe($index);
    return $this->GetRecipesDataView();
  }

  public function UpdateName(Request $request)
  {
    $index = (int)$request->data[0];
    $newName = (string)$request->data[1];
    $model = new ModelRecipes();
    $model->UpdateName($index, $newName);
  }

  public function EditExisting(Request $request)
  {
    $name = (string)$request->data[0];
    $servings = (float)$request->data[1];
    $ingredients = (array)$request->data[2];
    $instructions = (array)$request->data[3];
    $index = (int)$request->data[4];
    $model = new ModelRecipes();
    $model->EditExistingRecipe($name, $servings, $ingredients, $instructions, $index);
  }

  public function AddLog(Request $request)
  {
    $id = (int)$request->data[0];
    $mode = (string)$request->data[1];
    $amount = (int)$request->data[2];

    $model = new ModelRecipes();

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

  function UpdateNewRecipeStats(Request $request)
  {
    $ingredients = $request->data;
    $model = new ModelRecipes();
    $nutrients = $model->GetRecipeInfo($ingredients);
    return $nutrients;
  }
}