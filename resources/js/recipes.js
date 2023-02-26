"use strict";

// Message box
const messageBox = document.getElementById("messageBox");
// Controls
const Find = document.getElementById("Find");
const New = document.getElementById("New");
// Display
const Display = document.getElementById("Display");
// New Stack Display
const NewEntry = document.getElementById("NewEntry");
// New Stack Data
const NewEntryName = document.getElementById("NewEntryName");
const NewEntryServings = document.getElementById("NewEntryServings");
// Buttons
const AddNew = document.getElementById("AddNew");
const CloseNewEntry = document.getElementById("CloseNewEntry");
// Buttons
const SubmitEdit = document.getElementById("SubmitEdit");
const CloseEdit = document.getElementById("CloseEdit");
// New Recipe
const ToggleData = document.getElementById("ToggleData");
const ToggleIngredients = document.getElementById("ToggleIngredients");
const ToggleInstructions = document.getElementById("ToggleInstructions");
const AddInstructionButton = document.getElementById("AddInstructionButton");
const RemoveInstructionButton = document.getElementById("RemoveInstructionButton");
const InstructionList = document.getElementById("InstructionList");
const DataList = document.getElementById("DataList");
const IngredientList = document.getElementById("IngredientList");
const InstructionBox = document.getElementById("InstructionBox");
const NewViews = [DataList, IngredientList, InstructionList];

const ToggleFoods = document.getElementById("ToggleFoods");
const ToggleRecipes = document.getElementById("ToggleRecipes");
const FoodList = document.getElementById("FoodList");
const RecipeList = document.getElementById("RecipeList");
const IngredientViews = [FoodList, RecipeList];

const FilterFood = document.getElementById('FilterFood');
FilterFood.onkeyup = function(){ Filter("toggleFoodDiv", FilterFood.value); };
const FilterRecipe = document.getElementById('FilterRecipe');
FilterRecipe.onkeyup = function(){ Filter("toggleRecipeDiv", FilterRecipe.value); };

NewEntryServings.onkeyup = function(){ UpdateServings(); };

// Assignments
// Message Box
messageBox.onclick = function(){ TogglePanel(messageBox); };
// Settings
Find.onkeyup = function(){ Filter("recipeType", Find.value); };
// New Stack
AddNew.onclick = function(){ AddNewItem(); };
New.onclick = function(){ 
  TogglePanel(NewEntry); 
  ClearNewScreen(); };
CloseNewEntry.onclick = function(){ TogglePanel(NewEntry); };
ToggleData.onclick = function(){ SwitchView(NewViews, 0); };
ToggleIngredients.onclick = function(){ SwitchView(NewViews, 1); };
ToggleInstructions.onclick = function(){ SwitchView(NewViews, 2); };
AddInstructionButton.onclick = function(){ AddInstruction(); };
RemoveInstructionButton.onclick = function(){ RemoveInstruction(); };
ToggleFoods.onclick = function(){ SwitchView(IngredientViews, 0); };
ToggleRecipes.onclick = function(){ SwitchView(IngredientViews, 1); };

// target amounts
let tCalories, tCarbohydrate, tSugar, tFat, tSaturated, tProtein, tFibre, tSalt, tAlcohol;
if(profile !== null && profile !== undefined)
{
  tCalories = profile['caloryGoal'];
  tCarbohydrate = targets['carbohydrate'];
  tSugar = targets['sugar'];
  tFat = targets['fat'];
  tSaturated = targets['saturated'];
  tProtein = targets['protein'];
  tFibre = targets['fibre'];
  tSalt = targets['salt'];
  tAlcohol = targets['alcohol'];
}
else
{
  tCalories = 2000;
  tCarbohydrate = 267;
  tSugar = 27;
  tFat = 78;
  tSaturated = 24;
  tProtein = 45;
  tFibre = 30;
  tSalt = 6;
  tAlcohol = 16;
}
// high / low figures per 100g
let hSugar = 22.5;
let lSugar = 5;
let hFat = 17.5;
let lFat = 3;
let hSaturated = 5;
let lSaturated = 1.5;
let hSalt = 1.5;
let lSalt = 0.3;

// Startup
SwitchView(NewViews, 0);
SwitchView(IngredientViews, 0);

let timeOut = undefined;

function TogglePanel(panel)
{
  if(panel.style.display == "none")
  {
    panel.style.display = "";
    AnimateFadeIn(panel);
  }
  else
  {
    AnimateFadeOut(panel);
  }
}

function TogglePanel2(ref)
{
  let panel = document.getElementById(ref);
  if(panel.style.display == "none")
  {
    panel.style.display = "";
    AnimateFadeIn(panel);
  }
  else
  {
    AnimateFadeOut(panel);
  }
}

function SwitchView(array, index)
{
  for(let i = 0; i < array.length; i++)
  {
    if(i === index)
    {
      array[i].style.display = "";
      AnimateFadeIn(array[i]);
    }
    else array[i].style.display = "none";
  }
}

function MessageBox(message)
{
  messageBox.innerHTML = message;
  if(messageBox.style.display === "none") TogglePanel(messageBox);
  AnimatePop(messageBox);
  if(timeOut != null) clearTimeout(timeOut);
  timeOut = setTimeout(AutoOff, 2500);
}

function AnimatePop(panel)
{
  panel.animate([
    { transform: 'scale(110%, 110%)'},
    { transform: 'scale(109%, 109%)'},
    { transform: 'scale(108%, 108%)'},
    { transform: 'scale(107%, 107%)'},
    { transform: 'scale(106%, 106%)'},
    { transform: 'scale(105%, 105%)'},
    { transform: 'scale(104%, 104%)'},
    { transform: 'scale(103%, 103%)'},
    { transform: 'scale(102%, 102%)'},
    { transform: 'scale(101%, 101%)'},
    { transform: 'scale(100%, 100%)'}],
    {
      duration: 100,
    }
  );
}

function AnimateFadeIn(panel)
{
  panel.animate(
  [
    { opacity: '0' },
    { opacity: '0.25' },
    { opacity: '0.5' },
    { opacity: '0.75' },
    { opacity: '1' }
  ],
  {
    duration: 500,
  }
  );
}

function AnimateFadeOut(panel)
{
  let timer = 500;
  let deduct = timer - (timer / 5);
  setTimeout(function() { panel.style.display = "none" }, deduct);
  panel.animate(
  [
    { opacity: '1' },
    { opacity: '0.75' },
    { opacity: '0.5' },
    { opacity: '0.25' },
    { opacity: '0' }
  ],
  {
    duration: timer,
  }
  );
}

function AutoOff()
{
  messageBox.style.display = "none";
}

function Filter(dataset, inputFilter)
{
  let filter, li, len, a, i;
  filter = inputFilter.toUpperCase();
  if(filter === "378462SDJKFHDSDBS8743247832" || filter === "-1") filter = "";
  li = document.getElementsByClassName(dataset);
  len = li.length;
  for(i = 0; i < len; i++)
  {
    if(filter === "")
    {
      li[i].style.display = "";
      continue;
    }
    a = li[i].dataset.search.toString();
    if(a.toUpperCase().indexOf(filter) > -1)
    {
      li[i].style.display = "";
    }
    else
    {
      li[i].style.display = "none";
    }
  }
}

function ClearNewScreen()
{
  NewEntryName.value = "";
}

function Delete(id)
{
  if(!confirm("Delete this recipe?"))
  {
    return;
  }

  let data = [
    id,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/recipes/DeleteRecipe',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function(result)
    {
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {

    }
  });
}

function UpdateName(id)
{
  let newName = document.getElementById(id + "NewName").value;

  let data = [
    id,
    newName
  ];

  $.ajax(
  {
    method: "POST",
    url: '/recipes/UpdateRecipeName',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function()
    {
      MessageBox("Recipe name updated.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function AddNewItem()
{
  let selected = document.getElementsByClassName("inputamount");
  let ingredients = [];
  for(let i = 0; i < selected.length; i++)
  {
    if(selected[i].disabled === false)
    {
      let type = selected[i].dataset.type;
      let index = selected[i].dataset.index;
      let amount = selected[i].value;
      ingredients.push({
        type:type,
        index:index,
        amount:amount,
      });
    }
  }

  let instructionTexts = document.getElementsByClassName("instructionText");
  let instructions = [];
  for(let i = 0; i < instructionTexts.length; i++)
  {
    let num = i + 1;
    let instructionText = document.getElementById(num + "instruction").value;
    let instructionTimer = document.getElementById(num + "instructionTimer").value;
    instructions.push({
      number:num,
      text:instructionText,
      timer:instructionTimer,
    });
  }

  let data = [
    NewEntryName.value,
    NewEntryServings.value,
    ingredients,
    instructions,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/recipes/AddNewRecipe',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function(result)
    {
      Display.innerHTML = result;
      TogglePanel(NewEntry);
      ReAssign();
    },
    error:function()
    {

    }
  });
}

function EditExisting(id)
{
  let selected = document.getElementsByClassName(id + "inputamountExists");
  let ingredients = [];
  for(let i = 0; i < selected.length; i++)
  {
    let type = selected[i].dataset.type;
    let index = selected[i].dataset.index;
    let amount = selected[i].value;
    if(amount > 0)
    {
      ingredients.push({
        type:type,
        index:index,
        amount:amount,
      });
    }
  }

  let instructionTexts = document.getElementsByClassName(id + "instructionTextExists");
  let instructions = [];
  for(let i = 0; i < instructionTexts.length; i++)
  {
    let recipeID = instructionTexts[i].dataset.recipe;
    let num = i + 1;
    let instructionText = document.getElementById(recipeID + num + "instructionExists").value;
    let instructionTimer = document.getElementById(recipeID + num + "instructionTimerExists").value;
    instructions.push({
      number:num,
      text:instructionText,
      timer:instructionTimer,
    });
  }

  let newName = document.getElementById(id + "NewNameExists");
  let newEntryServing = document.getElementById(id + "EntryServingsExists");

  let data = [
    newName.value,
    newEntryServing.value,
    ingredients,
    instructions,
    id,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/recipes/EditExisting',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function()
    {
      MessageBox("Recipe updated.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ToggleItem(type, display, id)
{
  let panel;
  if(type === "F")
  {
    panel = document.getElementById(id + "foodItem");
  }
  else if(type === "R")
  {
    panel = document.getElementById(id + "recipeItem");
  }
  if(panel.disabled === true)
  {
    panel.disabled = false;
    display.style.backgroundColor = "var(--foreground)";
    display.style.color = "var(--background)";
  }
  else
  {
    panel.value = "";
    panel.disabled = true;
    display.style.backgroundColor = "var(--background)";
    display.style.color = "var(--foreground)";
  }
}

function ReAssign()
{
  let toggleFood = document.getElementsByClassName("toggleFood");
  for(let i = 0; i < toggleFood.length; i++)
  {
    let id = parseInt(toggleFood[i].dataset.index);
    toggleFood[i].onclick = function() { ToggleItem("F", toggleFood[i], id); };
  }

  let toggleRecipe = document.getElementsByClassName("toggleRecipe");
  for(let i = 0; i < toggleRecipe.length; i++)
  {
    let id = toggleRecipe[i].dataset.index;
    toggleRecipe[i].onclick = function() { ToggleItem("R", toggleRecipe[i], id); };
  }

  let togglestack = document.getElementsByClassName("togglestack");
  for(let i = 0; i < togglestack.length; i++)
  {
    let id = togglestack[i].dataset.i;
    togglestack[i].onclick = function() { TogglePanel2(id + "displayStack") };
  }

  let updatestackname = document.getElementsByClassName("updatestackname");
  for(let i = 0; i < updatestackname.length; i++)
  {
    let id = updatestackname[i].dataset.i;
    updatestackname[i].onclick = function() { UpdateName(id) };
  }

  let editstackscreen = document.getElementsByClassName("editstackscreen");
  for(let i = 0; i < editstackscreen.length; i++)
  {
    let id = editstackscreen[i].dataset.i;
    editstackscreen[i].onclick = function() { EditScreen(id) };
  }

  let deletestack = document.getElementsByClassName("deletestack");
  for(let i = 0; i < deletestack.length; i++)
  {
    let id = deletestack[i].dataset.i;
    deletestack[i].onclick = function() { Delete(id) };
  }

  let updatestat = document.getElementsByClassName("updatestat");
  for(let i = 0; i < updatestat.length; i++)
  {
    let id = updatestat[i].dataset.i;
    updatestat[i].onkeyup = function() { UpdateStat(id) };
  }

  let recipeType = document.getElementsByClassName("recipeType");
  for(let i = 0; i < recipeType.length; i++)
  {
    let id = recipeType[i].dataset.id;
    let oList = document.getElementById(id + "OptionsList");
    let dList = document.getElementById(id + "DataList");
    let iList = document.getElementById(id + "IngredientList");
    let i2List = document.getElementById(id + "InstructionList");
    let a = [oList, dList, iList, i2List];
    let optionsButton = document.getElementById(id + "Options");
    let dataButton = document.getElementById(id + "Data");
    let ingredientsButton = document.getElementById(id + "Ingredients");
    let instructionsButton = document.getElementById(id + "Instructions");
    optionsButton.onclick = function() { SwitchView(a, 0) };
    dataButton.onclick = function() { SwitchView(a, 1) };
    ingredientsButton.onclick = function() { SwitchView(a, 2) };
    instructionsButton.onclick = function() { SwitchView(a, 3) };
    let save = document.getElementById(id + "SaveRecipe");
    save.onclick = function() { EditExisting(id); };
    let del = document.getElementById(id + "DeleteRecipe");
    del.onclick = function() { Delete(id); };
  }

  let switchrecipe = document.getElementsByClassName("switchrecipe");
  for(let i = 0; i < switchrecipe.length; i++)
  {
    let id = switchrecipe[i].dataset.i;
    switchrecipe[i].onclick = function() { AnimatePop(switchrecipe[i]); Switch(id) };
  }

  let logrecipe = document.getElementsByClassName("logrecipe");
  for(let i = 0; i < logrecipe.length; i++)
  {
    let id = logrecipe[i].dataset.i;
    logrecipe[i].onclick = function() { AnimatePop(logrecipe[i]); LogRecipe(id) };
  }

  let inputamount = document.getElementsByClassName("inputamount");
  for(let i = 0; i < inputamount.length; i++)
  {
    inputamount[i].onchange = function() { UpdateNewRecipeStats(); };
  }
}

function UpdateNewRecipeStats(id)
{
  let data = [];

  let inputamount = document.getElementsByClassName("inputamount");
  for(let i = 0; i < inputamount.length; i++)
  {
    if(inputamount[i].disabled !== true)
    {
      data.push({
        'type':inputamount[i].dataset.type,
        'index':inputamount[i].dataset.index,
        'amount':inputamount[i].value,
      });
    }
  }

  $.ajax(
  {
    method: "POST",
    url: '/recipes/UpdateNewRecipeStats',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function(result)
    {

      let total = undefined;

      for(let i = 0; i < result.length; i++)
      {
        if(result[i].type === 'total') total = result[i];
      }

      let servings = document.getElementById('NewEntryServings').value;

      document.getElementById('NewRecipeTotalPrice').innerHTML = '£' + total['price'];

      document.getElementById('NewRecipeTotalCalories').innerHTML = total['calories'] + 'c';

      document.getElementById('NewRecipeTotalCarbohydrate').innerHTML = total['carbohydrate'] + 'g';
      document.getElementById('NewRecipeTotalSugar').innerHTML = total['sugar'] + 'g';
      document.getElementById('NewRecipeTotalFat').innerHTML = total['fat'] + 'g';

      document.getElementById('NewRecipeTotalSaturated').innerHTML = total['saturated'] + 'g';
      document.getElementById('NewRecipeTotalProtein').innerHTML = total['protein'] + 'g';
      document.getElementById('NewRecipeTotalFibre').innerHTML = total['fibre'] + 'g';

      document.getElementById('NewRecipeTotalSalt').innerHTML = total['salt'] + 'g';
      document.getElementById('NewRecipeTotalAlcohol').innerHTML = total['alcohol'] + 'g';



      document.getElementById('NewRecipeServingPrice').innerHTML = '£' + ( total['price'] / servings) ;

      document.getElementById('NewRecipeServingCalories').innerHTML = ( total['calories'] / servings) + 'c';

      document.getElementById('NewRecipeServingCarbohydrate').innerHTML = ( total['carbohydrate'] / servings) + 'g';
      document.getElementById('NewRecipeServingSugar').innerHTML = ( total['sugar'] / servings) + 'g';
      document.getElementById('NewRecipeServingFat').innerHTML = ( total['fat'] / servings) + 'g';

      document.getElementById('NewRecipeServingSaturated').innerHTML = ( total['saturated'] / servings) + 'g';
      document.getElementById('NewRecipeServingProtein').innerHTML = ( total['protein'] / servings) + 'g';
      document.getElementById('NewRecipeServingFibre').innerHTML = ( total['fibre'] / servings) + 'g';

      document.getElementById('NewRecipeServingSalt').innerHTML = ( total['salt'] / servings) + 'g';
      document.getElementById('NewRecipeServingAlcohol').innerHTML = ( total['alcohol'] / servings) + 'g';
    },
    error:function()
    {

    }
  });
}

function UpdateServings()
{
  let servings = parseFloat(document.getElementById('NewEntryServings').value);

  let price = parseFloat(document.getElementById('NewRecipeTotalPrice').innerHTML.replace('£', ''));

  let calories = parseFloat(document.getElementById('NewRecipeTotalCalories').innerHTML);

  let carbohydrate = parseFloat(document.getElementById('NewRecipeTotalCarbohydrate').innerHTML);
  let sugar = parseFloat(document.getElementById('NewRecipeTotalSugar').innerHTML);
  let fat = parseFloat(document.getElementById('NewRecipeTotalFat').innerHTML);

  let saturated = parseFloat(document.getElementById('NewRecipeTotalSaturated').innerHTML);
  let protein = parseFloat(document.getElementById('NewRecipeTotalProtein').innerHTML);
  let fibre = parseFloat(document.getElementById('NewRecipeTotalFibre').innerHTML);

  let salt = parseFloat(document.getElementById('NewRecipeTotalSalt').innerHTML);
  let alcohol = parseFloat(document.getElementById('NewRecipeTotalAlcohol').innerHTML);

  if(!isNaN(price)) document.getElementById('NewRecipeServingPrice').innerHTML = '£' + ( price / servings ).toFixed(2) ;

  if(!isNaN(calories)) document.getElementById('NewRecipeServingCalories').innerHTML = ( calories / servings ).toFixed(2) + 'c';

  if(!isNaN(carbohydrate)) document.getElementById('NewRecipeServingCarbohydrate').innerHTML = ( carbohydrate / servings ).toFixed(2) + 'g';
  if(!isNaN(sugar)) document.getElementById('NewRecipeServingSugar').innerHTML = ( sugar / servings ).toFixed(2) + 'g';
  if(!isNaN(fat)) document.getElementById('NewRecipeServingFat').innerHTML = ( fat / servings ).toFixed(2) + 'g';

  if(!isNaN(saturated)) document.getElementById('NewRecipeServingSaturated').innerHTML = ( saturated / servings ).toFixed(2) + 'g';
  if(!isNaN(protein)) document.getElementById('NewRecipeServingProtein').innerHTML = ( protein / servings ).toFixed(2) + 'g';
  if(!isNaN(fibre)) document.getElementById('NewRecipeServingFibre').innerHTML = ( fibre / servings ).toFixed(2) + 'g';

  if(!isNaN(salt)) document.getElementById('NewRecipeServingSalt').innerHTML = ( salt / servings ).toFixed(2) + 'g';
  if(!isNaN(alcohol)) document.getElementById('NewRecipeServingAlcohol').innerHTML = ( alcohol / servings ).toFixed(2) + 'g';
}

function Switch(index)
{
  let amount = document.getElementById(index + "Amount");
  amount.value = "";
  if(amount.dataset.mode === "Q")
  {
    amount.dataset.mode = "S";
    amount.placeholder = "Servings...";
  }
  else
  {
    amount.dataset.mode = "Q";
    amount.placeholder = "Quantity...";
  }
  AnimateFadeIn(amount);
}

function AddInstruction()
{
  let instructions = document.getElementsByClassName("instructionText");

  let num = ( instructions.length + 1 );

  let divHolder = document.createElement("div");
  divHolder.className = "w-full flex flex-row justify-evenly items-start p-2";
  divHolder.id = num + "instructionBox";

  let divNumber = document.createElement("div");
  divNumber.className = "w-16";
  divNumber.innerHTML = num + ".";

  let txt = document.createElement("textarea");
  txt.id = num + "instruction";
  txt.className = "instructionText px-2 mx-2 w-full";
  txt.style = "min-height:70px";

  let inputTime = document.createElement("input");
  inputTime.type = "number";
  inputTime.min = 0;
  inputTime.step = 0.1;
  inputTime.style = "min-height:70px";
  inputTime.className = "w-16";
  inputTime.id = num + "instructionTimer";

  divHolder.appendChild(divNumber);
  divHolder.appendChild(txt);
  divHolder.appendChild(inputTime);

  InstructionBox.appendChild(divHolder);
}

function RemoveInstruction()
{
  let instructions = document.getElementsByClassName("instructionText");
  if(instructions.length === 0) return;
  let num = instructions.length;
  let target = document.getElementById(num + "instructionBox");
  target.remove();
}

function LogRecipe(id)
{
  let amount = document.getElementById(id + "Amount");
  let mode = amount.dataset.mode;
  let value = amount.value;
  let data = [
    id,
    mode,
    value
  ];

  $.ajax(
  {
    method: "POST",
    url: '/recipes/AddLog',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function(result)
    {
      MessageBox("Log Updated.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function UpdateStat(index)
{
  // the amount input and whether quantity or serving based calculation
  let amount = document.getElementById(index + "Amount");
  let mode = amount.dataset.mode;
  let value = amount.value;

  // the count displays
  let cCalories = document.getElementById(index + "CountCalories");
  let cPrice = document.getElementById(index + "CountPrice");
  let cCarbohydrate = document.getElementById(index + "CountCarbohydrate");
  let cSugar = document.getElementById(index + "CountSugar");
  let cFat = document.getElementById(index + "CountFat");
  let cSaturated = document.getElementById(index + "CountSaturated");
  let cProtein = document.getElementById(index + "CountProtein");
  let cFibre = document.getElementById(index + "CountFibre");
  let cSalt = document.getElementById(index + "CountSalt");
  let cAlcohol = document.getElementById(index + "CountAlcohol");

  // the percent displays
  let pCalories = document.getElementById(index + "PercentCalories");
  let pPrice = document.getElementById(index + "PercentPrice");
  let pCarbohydrate = document.getElementById(index + "PercentCarbohydrate");
  let pSugar = document.getElementById(index + "PercentSugar");
  let pFat = document.getElementById(index + "PercentFat");
  let pSaturated = document.getElementById(index + "PercentSaturated");
  let pProtein = document.getElementById(index + "PercentProtein");
  let pFibre = document.getElementById(index + "PercentFibre");
  let pSalt = document.getElementById(index + "PercentSalt");
  let pAlcohol = document.getElementById(index + "PercentAlcohol");

    // the amounts in the product
  let Weight = document.getElementById(index + "RecipeTotalWeight").innerHTML;
  let Servings = document.getElementById(index + "EntryServingsExists").value;

  let Calories = document.getElementById(index + "RecipeTotalCalories").innerHTML;
  let Price = document.getElementById(index + "RecipeTotalPrice").innerHTML;

  let Carbohydrate = document.getElementById(index + "RecipeTotalCarbohydrate").innerHTML;
  let Sugar = document.getElementById(index + "RecipeTotalSugar").innerHTML;
  let Fat = document.getElementById(index + "RecipeTotalFat").innerHTML;
  let Saturated = document.getElementById(index + "RecipeTotalSaturated").innerHTML;
  let Protein = document.getElementById(index + "RecipeTotalProtein").innerHTML;
  let Fibre = document.getElementById(index + "RecipeTotalFibre").innerHTML;
  let Salt = document.getElementById(index + "RecipeTotalSalt").innerHTML;
  let Alcohol = document.getElementById(index + "RecipeTotalAlcohol").innerHTML;

  // per 100g - need to check that per is 100 else recalc the main values
  let Per = Weight;

  let sugarColour, fatColour, satColour, saltColour;

  // adjust if using servings to calculate weight
  if(mode === "S")
  {
    let servingSize = Weight / Servings;
    value = value * servingSize;
  }

  // calculate totals and then percentages based on reference amounts
  // also get color based on high/low figures
  let amountCalories = ( Calories / Per ) * value;
  let percentCalories = ( 100 / tCalories ) * amountCalories;

  let amountPrice = ( Price / Weight ) * value;
  let percentPrice = "n/a";

  let amountCarbohydrate = ( Carbohydrate / Per ) * value;
  let percentCarbohydrate = ( 100 / tCarbohydrate ) * amountCarbohydrate;

  let amountSugar = ( Sugar / Per ) * value;
  let percentSugar = ( 100 / tSugar ) * amountSugar;
  if(parseInt(Per) === 100)
  {
    if(Sugar <= lSugar) sugarColour = "var(--green)";
    if(Sugar > lSugar && Sugar <= hSugar) sugarColour = "var(--orange)";
    if(Sugar > hSugar) sugarColour = "var(--red)";
  }
  else
  {
    let newSugar = Sugar / Per * 100;
    if(newSugar <= lSugar) sugarColour = "var(--green)";
    if(newSugar > lSugar && newSugar <= hSugar) sugarColour = "var(--orange)";
    if(newSugar > hSugar) sugarColour = "var(--red)";
  }

  let amountFat = ( Fat / Per ) * value;
  let percentFat = ( 100 / tFat ) * amountFat;
  if(parseInt(Per) === 100)
  {
    if(Fat <= lFat) fatColour = "var(--green)";
    if(Fat > lFat && Sugar <= hFat) fatColour = "var(--orange)";
    if(Fat > hFat) fatColour = "var(--red)";
  }
  else
  {
    let newFat = Fat / Per * 100;
    if(newFat <= lFat) fatColour = "var(--green)";
    if(newFat > lFat && Sugar <= hFat) fatColour = "var(--orange)";
    if(newFat > hFat) fatColour = "var(--red)";
  }

  let amountSaturated = ( Saturated / Per ) * value;
  let percentSaturated = ( 100 / tSaturated ) * amountSaturated;
  if(parseInt(Per) === 100)
  {
    if(Fat <= lSaturated) satColour = "var(--green)";
    if(Fat > lSaturated && Sugar <= hSaturated) satColour = "var(--orange)";
    if(Fat > hSaturated) satColour = "var(--red)";
  }
  else
  {
    let newSaturated = Fat / Per * 100;
    if(newSaturated <= lSaturated) satColour = "var(--green)";
    if(newSaturated > lSaturated && Sugar <= hSaturated) satColour = "var(--orange)";
    if(newSaturated > hSaturated) satColour = "var(--red)";
  }

  let amountProtein = ( Protein / Per ) * value;
  let percentProtein = ( 100 / tProtein ) * amountProtein;

  let amountFibre = ( Fibre / Per ) * value;
  let percentFibre = ( 100 / tFibre ) * amountFibre;

  let amountSalt = ( Salt / Per ) * value;
  let percentSalt = ( 100 / tSalt ) * amountSalt;
  if(parseInt(Per) === 100)
  {
    if(Salt <= lSalt) saltColour = "var(--green)";
    if(Salt > lSalt && Salt <= hSalt) saltColour = "var(--orange)";
    if(Salt > hSalt) saltColour = "var(--red)";
  }
  else
  {
    let newSalt = Salt / Per * 100;
    if(newSalt <= lSalt) saltColour = "var(--green)";
    if(newSalt > lSalt && Salt <= hSalt) saltColour = "var(--orange)";
    if(newSalt > hSalt) saltColour = "var(--red)";
  }

  let amountAlcohol = ( Alcohol / Per ) * value;
  let percentAlcohol = ( 100 / tAlcohol ) * amountAlcohol;

  cCalories.innerHTML = amountCalories.toFixed(2) + "c";
  pCalories.innerHTML = percentCalories.toFixed(2);

  cPrice.innerHTML = "£" + amountPrice.toFixed(2);
  pPrice.innerHTML = percentPrice;

  cCarbohydrate.innerHTML = amountCarbohydrate.toFixed(2) + "g";
  pCarbohydrate.innerHTML = percentCarbohydrate.toFixed(2);

  cSugar.innerHTML = amountSugar.toFixed(2) + "g";
  pSugar.innerHTML = percentSugar.toFixed(2);
  cSugar.style.backgroundColor = sugarColour;
  pSugar.style.backgroundColor = sugarColour;

  cFat.innerHTML = amountFat.toFixed(2) + "g";
  pFat.innerHTML = percentFat.toFixed(2);
  cFat.style.backgroundColor = fatColour;
  pFat.style.backgroundColor = fatColour;

  cSaturated.innerHTML = amountSaturated.toFixed(2) + "g";
  pSaturated.innerHTML = percentSaturated.toFixed(2);
  cSaturated.style.backgroundColor = satColour;
  pSaturated.style.backgroundColor = satColour;

  cProtein.innerHTML = amountProtein.toFixed(2) + "g";
  pProtein.innerHTML = percentProtein.toFixed(2);

  cFibre.innerHTML = amountFibre.toFixed(2) + "g";
  pFibre.innerHTML = percentFibre.toFixed(2);

  cSalt.innerHTML = amountSalt.toFixed(2) + "g";
  pSalt.innerHTML = percentSalt.toFixed(2);
  cSalt.style.backgroundColor = saltColour;
  pSalt.style.backgroundColor = saltColour;

  cAlcohol.innerHTML = amountAlcohol.toFixed(2) + "g";
  pAlcohol.innerHTML = percentAlcohol.toFixed(2);
}

document.addEventListener("DOMContentLoaded", ReAssign);