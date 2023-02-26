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

  console.log(data);

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
      console.log(result);
      Display.innerHTML = result;
      TogglePanel(NewEntry);
      ReAssign();
    },
    error:function(result)
    {
      console.log(result);
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

  let dataviewbutton = document.getElementsByClassName("dataviewbutton");
  for(let i = 0; i < dataviewbutton.length; i++)
  {
    let id = dataviewbutton[i].dataset.i;
    let oList = document.getElementById(id + "OptionsList");
    let dList = document.getElementById(id + "DataList");
    let iList = document.getElementById(id + "IngredientList");
    let i2List = document.getElementById(id + "InstructionList");
    let a = [oList, dList, iList, i2List];
    let optionsButton = document.getElementById(id + "Options");
    let ingredientsButton = document.getElementById(id + "Ingredients");
    let instructionsButton = document.getElementById(id + "Instructions");
    optionsButton.onclick = function() { SwitchView(a, 0) };
    dataviewbutton[i].onclick = function() { SwitchView(a, 1) };
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

document.addEventListener("DOMContentLoaded", ReAssign);