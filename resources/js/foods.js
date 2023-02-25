"use strict";

// Const
const messageBox = document.getElementById("messageBox");

let togglepanelwithids = document.getElementsByClassName("togglepanelwithid");
for(let i = 0; i < togglepanelwithids.length; i++)
{
  let id = togglepanelwithids[i].dataset.i;
  togglepanelwithids[i].onclick = function() { AnimatePop(togglepanelwithids[i]); TogglePanelWithID(id + "Food", true, true); };
}

let updatefoods = document.getElementsByClassName("updatefood");
for(let i = 0; i < updatefoods.length; i++)
{
  let id = updatefoods[i].dataset.i;
  updatefoods[i].onclick = function() { AnimatePop(updatefoods[i]), UpdateFood(id) };
}

let togglefoodpanel1 = document.getElementsByClassName("togglefoodpanel1");
for(let i = 0; i < togglefoodpanel1.length; i++)
{
  let id = togglefoodpanel1[i].dataset.i;
  togglefoodpanel1[i].onclick = function() { AnimatePop(togglefoodpanel1[i]); ToggleFoodPanel(id, 1); };
}

let togglefoodpanel2 = document.getElementsByClassName("togglefoodpanel2");
for(let i = 0; i < togglefoodpanel2.length; i++)
{
  let id = togglefoodpanel2[i].dataset.i;
  togglefoodpanel2[i].onclick = function() { AnimatePop(togglefoodpanel2[i]); ToggleFoodPanel(id, 2); };
}

let updatestat = document.getElementsByClassName("updatestat");
for(let i = 0; i < updatestat.length; i++)
{
  let id = updatestat[i].dataset.i;
  updatestat[i].onkeyup = function() { UpdateStat(id) };
}

let switchfood = document.getElementsByClassName("switchfood");
for(let i = 0; i < switchfood.length; i++)
{
  let id = switchfood[i].dataset.i;
  switchfood[i].onclick = function() { AnimatePop(switchfood[i]); Switch(id); };
}

let logfood = document.getElementsByClassName("logfood");
for(let i = 0; i < logfood.length; i++)
{
  let id = logfood[i].dataset.i;
  logfood[i].onclick = function() { AnimatePop(logfood[i]); LogFood(id); };
}

let shopfood = document.getElementsByClassName("shopfood");
for(let i = 0; i < shopfood.length; i++)
{
  let id = shopfood[i].dataset.i;
  shopfood[i].onclick = function() { AnimatePop(shopfood[i]); ShopFood(id); };
}

let larderfood = document.getElementsByClassName("larderfood");
for(let i = 0; i < larderfood.length; i++)
{
  let id = larderfood[i].dataset.i;
  larderfood[i].onclick = function() { AnimatePop(larderfood[i]); LarderFood(id); };
}

let updatefood = document.getElementsByClassName("updatefood");
for(let i = 0; i < updatefood.length; i++)
{
  let id = updatefood[i].dataset.i;
  updatefood[i].onclick = function() { AnimatePop(updatefood[i]); UpdateFood(id); };
}

let deletefood = document.getElementsByClassName("deletefood");
for(let i = 0; i < deletefood.length; i++)
{
  let id = deletefood[i].dataset.i;
  deletefood[i].onclick = function() { AnimatePop(deletefood[i]); DeleteFood(id); };
}

const Find = document.getElementById("Find");
const New = document.getElementById("New");
const Display = document.getElementById("Display");

const EditScreen = document.getElementById("EditScreen");
const Add = document.getElementById("Add");
const Close = document.getElementById("Close");

const Alphabet = document.getElementById("Alphabet");
const Vendor = document.getElementById("Vendor");

const EditScreenName = document.getElementById("EditScreenName");
const EditScreenVendor = document.getElementById("EditScreenVendor");
const EditScreenURL = document.getElementById("EditScreenURL");

const EditScreenPrice = document.getElementById("EditScreenPrice");
const EditScreenWeight = document.getElementById("EditScreenWeight");
const EditScreenServings = document.getElementById("EditScreenServings");

const EditScreenExpiry = document.getElementById("EditScreenExpiry");
const EditScreenPer = document.getElementById("EditScreenPer");
const EditScreenCalories = document.getElementById("EditScreenCalories");

const EditScreenCarbohydrate = document.getElementById("EditScreenCarbohydrate");
const EditScreenSugar = document.getElementById("EditScreenSugar");
const EditScreenFat = document.getElementById("EditScreenFat");

const EditScreenSaturated = document.getElementById("EditScreenSaturated");
const EditScreenProtein = document.getElementById("EditScreenProtein");
const EditScreenFibre = document.getElementById("EditScreenFibre");

const EditScreenSalt = document.getElementById("EditScreenSalt");
const EditScreenAlcohol = document.getElementById("EditScreenAlcohol");

// Assignments
messageBox.onclick = function(){ TogglePanel(messageBox, true, true); };
Find.onkeyup = function(){ Filter("foodsearch", Find.value); };
New.onclick = function(){ TogglePanel(EditScreen, true, true); };
Close.onclick = function(){ TogglePanel(EditScreen, true, true); };

Add.onclick = function(){ AddNewFood(); };
Alphabet.onchange = function(){ ChangeLetter(); };
Vendor.onchange = function(){ FilterVendor(); };

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

// Variables
let timeOut = undefined;

// Startup
TogglePanel(messageBox, false, false);
TogglePanel(EditScreen, false, false);

function TogglePanel(panel, animateOpen, animateClose)
{
  if(panel.style.display == "none")
  {
    panel.style.display = "";
    if(animateOpen) AnimateFadeIn(panel);
  }
  else
  {
    if(animateClose) AnimateFadeOut(panel);
    else panel.style.display = "none";
  }
}

function TogglePanelWithID(id, animateOpen, animateClose)
{
  let panel = document.getElementById(id);
  if(panel.style.display == "none")
  {
    panel.style.display = "";
    if(animateOpen) AnimateFadeIn(panel);
  }
  else
  {
    if(animateClose) AnimateFadeOut(panel);
    else panel.style.display = "none";
  }
}

function ToggleFoodPanel(index, trigger)
{
  let options = document.getElementById(index + "Options");
  let edits = document.getElementById(index + "Edit");

  if(options.style.display === "")
  {
    if(trigger === 1)
    {
      options.style.display = "none";
      edits.style.display = "";
    }
  }
  else
  {
    if(trigger === 2)
    {
      options.style.display = "";
      edits.style.display = "none";
    }
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
  AnimateFadeOut(messageBox);
}

function Filter(dataset, inputFilter)
{
  let filter, li, len, a, i;
  filter = inputFilter.toUpperCase();
  if(filter === "-1") filter = "";
  li = document.getElementsByClassName(dataset);
  len = li.length;
  for(i = 0; i < len; i++)
  {
    if(filter === "")
    {
      li[i].style.display = "";
      continue;
    }
    a = li[i].dataset.name.toString();
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

function FilterVendor()
{
  let dataset = 'foodsearch';
  let vendor = Vendor.value;
  if(vendor === 'All') vendor = '';
  let filter, li, len, a, i;
  filter = vendor.toUpperCase();
  if(filter === "-1") filter = "";
  li = document.getElementsByClassName(dataset);
  len = li.length;
  for(i = 0; i < len; i++)
  {
    if(filter === "")
    {
      li[i].style.display = "";
      continue;
    }
    a = li[i].dataset.vendor.toString();
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
  let Weight = document.getElementById(index + "EditScreenWeight").value;
  let Servings = document.getElementById(index + "EditScreenServings").value;

  let Calories = document.getElementById(index + "EditScreenCalories").value;
  let Price = document.getElementById(index + "EditScreenPrice").value;

  let Carbohydrate = document.getElementById(index + "EditScreenCarbohydrate").value;
  let Sugar = document.getElementById(index + "EditScreenSugar").value;
  let Fat = document.getElementById(index + "EditScreenFat").value;
  let Saturated = document.getElementById(index + "EditScreenSaturated").value;
  let Protein = document.getElementById(index + "EditScreenProtein").value;
  let Fibre = document.getElementById(index + "EditScreenFibre").value;
  let Salt = document.getElementById(index + "EditScreenSalt").value;
  let Alcohol = document.getElementById(index + "EditScreenAlcohol").value;

  // per 100g - need to check that per is 100 else recalc the main values
  let Per = document.getElementById(index + "EditScreenPer").value;

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

function ChangeLetter()
{
  let data = [
    Alphabet.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/foods/ChangeLetter',
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
      MessageBox("Letter Changed.");
      Display.innerHTML = result;
      ReAssign();
      FilterVendor();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ClearEditScreen()
{
  EditScreenName.value = "";
  EditScreenVendor.value = "";
  EditScreenURL.value = "";

  EditScreenPrice.value = "";
  EditScreenWeight.value = "";
  EditScreenServings.value = "";

  EditScreenExpiry.value = "";
  EditScreenPer.value = "";
  EditScreenCalories.value = "";

  EditScreenCarbohydrate.value = "";
  EditScreenSugar.value = "";
  EditScreenFat.value = "";

  EditScreenSaturated.value = "";
  EditScreenProtein.value = "";
  EditScreenFibre.value = "";

  EditScreenSalt.value = "";
  EditScreenAlcohol.value = "";
}

function AddNewFood()
{
  let data = [
    EditScreenName.value.trim(),
    EditScreenVendor.value.trim(),
    EditScreenURL.value.trim(),

    EditScreenPrice.value.trim(),
    EditScreenWeight.value.trim(),
    EditScreenServings.value.trim(),

    EditScreenExpiry.value.trim(),
    EditScreenPer.value.trim(),
    EditScreenCalories.value.trim(),

    EditScreenCarbohydrate.value.trim(),
    EditScreenSugar.value.trim(),
    EditScreenFat.value.trim(),

    EditScreenSaturated.value.trim(),
    EditScreenProtein.value.trim(),
    EditScreenFibre.value.trim(),

    EditScreenSalt.value.trim(),
    EditScreenAlcohol.value.trim(),
    Alphabet.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/foods/NewFood',
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
      MessageBox("Food Added.");
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function UpdateFood(index)
{
  let data = [
    index,
    document.getElementById(index + "EditScreenName").value.trim(),
    document.getElementById(index + "EditScreenVendor").value.trim(),
    document.getElementById(index + "EditScreenURL").value.trim(),

    document.getElementById(index + "EditScreenPrice").value.trim(),
    document.getElementById(index + "EditScreenWeight").value.trim(),
    document.getElementById(index + "EditScreenServings").value.trim(),

    document.getElementById(index + "EditScreenExpiry").value.trim(),
    document.getElementById(index + "EditScreenPer").value.trim(),
    document.getElementById(index + "EditScreenCalories").value.trim(),

    document.getElementById(index + "EditScreenCarbohydrate").value.trim(),
    document.getElementById(index + "EditScreenSugar").value.trim(),
    document.getElementById(index + "EditScreenFat").value.trim(),

    document.getElementById(index + "EditScreenSaturated").value.trim(),
    document.getElementById(index + "EditScreenProtein").value.trim(),
    document.getElementById(index + "EditScreenFibre").value.trim(),

    document.getElementById(index + "EditScreenSalt").value.trim(),
    document.getElementById(index + "EditScreenAlcohol").value.trim(),
  ];

  $.ajax(
  {
    method: "POST",
    url: '/foods/UpdateFood',
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
      MessageBox("Food Updated.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function DeleteFood(id)
{
  if(!confirm("Delete this food?"))
  {
    return;
  }

  let data = [
    id,
    Alphabet.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/foods/DeleteFood',
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
      MessageBox("Food deleted.");
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function LogFood(id)
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
    url: '/foods/AddFoodLog',
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
      MessageBox("Log Updated.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ReAssign()
{
  togglepanelwithids = document.getElementsByClassName("togglepanelwithid");
  for(let i = 0; i < togglepanelwithids.length; i++)
  {
    let id = togglepanelwithids[i].dataset.i;
    togglepanelwithids[i].onclick = function() { AnimatePop(togglepanelwithids[i]); TogglePanelWithID(id + "Food", true, true); };
  }
  
  updatefoods = document.getElementsByClassName("updatefood");
  for(let i = 0; i < updatefoods.length; i++)
  {
    let id = updatefoods[i].dataset.i;
    updatefoods[i].onclick = function() { AnimatePop(updatefoods[i]), UpdateFood(id) };
  }
  
  togglefoodpanel1 = document.getElementsByClassName("togglefoodpanel1");
  for(let i = 0; i < togglefoodpanel1.length; i++)
  {
    let id = togglefoodpanel1[i].dataset.i;
    togglefoodpanel1[i].onclick = function() { AnimatePop(togglefoodpanel1[i]); ToggleFoodPanel(id, 1); };
  }
  
  togglefoodpanel2 = document.getElementsByClassName("togglefoodpanel2");
  for(let i = 0; i < togglefoodpanel2.length; i++)
  {
    let id = togglefoodpanel2[i].dataset.i;
    togglefoodpanel2[i].onclick = function() { AnimatePop(togglefoodpanel2[i]); ToggleFoodPanel(id, 2); };
  }
  
  updatestat = document.getElementsByClassName("updatestat");
  for(let i = 0; i < updatestat.length; i++)
  {
    let id = updatestat[i].dataset.i;
    updatestat[i].onkeyup = function() { UpdateStat(id) };
  }
  
  switchfood = document.getElementsByClassName("switchfood");
  for(let i = 0; i < switchfood.length; i++)
  {
    let id = switchfood[i].dataset.i;
    switchfood[i].onclick = function() { AnimatePop(switchfood[i]); Switch(id); };
  }
  
  logfood = document.getElementsByClassName("logfood");
  for(let i = 0; i < logfood.length; i++)
  {
    let id = logfood[i].dataset.i;
    logfood[i].onclick = function() { AnimatePop(logfood[i]); LogFood(id); };
  }
  
  shopfood = document.getElementsByClassName("shopfood");
  for(let i = 0; i < shopfood.length; i++)
  {
    let id = shopfood[i].dataset.i;
    shopfood[i].onclick = function() { AnimatePop(shopfood[i]); ShopFood(id); };
  }
  
  larderfood = document.getElementsByClassName("larderfood");
  for(let i = 0; i < larderfood.length; i++)
  {
    let id = larderfood[i].dataset.i;
    larderfood[i].onclick = function() { AnimatePop(larderfood[i]); LarderFood(id); };
  }
  
  updatefood = document.getElementsByClassName("updatefood");
  for(let i = 0; i < updatefood.length; i++)
  {
    let id = updatefood[i].dataset.i;
    updatefood[i].onclick = function() { AnimatePop(updatefood[i]); UpdateFood(id); };
  }
  
  deletefood = document.getElementsByClassName("deletefood");
  for(let i = 0; i < deletefood.length; i++)
  {
    let id = deletefood[i].dataset.i;
    deletefood[i].onclick = function() { AnimatePop(deletefood[i]); DeleteFood(id); };
  }

  Get = document.getElementById("Get");
  Get.onclick = function() { GetURLFromPHP(EditScreenURL.value) };
}

let Get = document.getElementById("Get");
Get.onclick = function() { GetURLFromPHP(EditScreenURL.value) };

function GetURLFromPHP(url)
{
  let type = EditScreenVendor.value;
  $.ajax(
  {
    method: "POST",
    url: "/foods/GetScrape" + type,
    timeout:5000,
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      url
    },
    success:function(result)
    {
      EditScreenName.value = result.answer.name;
      EditScreenPrice.value = result.answer.price;
      EditScreenWeight.value = result.answer.weight;

      EditScreenServings.value = result.answer.servings;
      EditScreenExpiry.value = result.answer.expiry;
      EditScreenPer.value = result.answer.per;

      EditScreenCalories.value = result.answer.calories;
      EditScreenCarbohydrate.value = result.answer.carbohydrate;
      EditScreenSugar.value = result.answer.sugar;

      EditScreenFat.value = result.answer.fat;
      EditScreenSaturated.value = result.answer.saturated;
      EditScreenProtein.value = result.answer.protein;

      EditScreenFibre.value = result.answer.fibre;
      EditScreenSalt.value = result.answer.salt;
      EditScreenAlcohol.value = result.answer.alcohol;
    },
    error:function()
    {
      MessageBox('Error.');
    }
  });
}