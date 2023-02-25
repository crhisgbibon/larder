"use strict";

// Const
const messageBox = document.getElementById("messageBox");
const panelDisplay = document.getElementById("panelDisplay");

const Summary = document.getElementById("Summary");
const Profile = document.getElementById("Profile");
const Nutrient = document.getElementById("Nutrient");
const WeightB = document.getElementById("WeightB");

const SummaryScreen = document.getElementById("SummaryScreen");
const ProfileScreen = document.getElementById("ProfileScreen");
const NutrientScreen = document.getElementById("NutrientScreen");
const WeightOutput = document.getElementById("WeightOutput");
const WeightScreen = document.getElementById("WeightScreen");

const saveprofilebutton = document.getElementById("saveprofilebutton");
saveprofilebutton.onclick = function(){ 
  AnimatePop(saveprofilebutton);
  SaveProfile()
};
const setbmrbutton = document.getElementById("setbmrbutton");
setbmrbutton.onclick = function(){ 
  AnimatePop(setbmrbutton);
  SetBMR(setbmrbutton.dataset.bmr)
};
const noexercisebutton = document.getElementById("noexercisebutton");
noexercisebutton.onclick = function(){ 
  AnimatePop(noexercisebutton);
  SetBMR(noexercisebutton.dataset.bmr)
};
const lightexercisebutton = document.getElementById("lightexercisebutton");
lightexercisebutton.onclick = function(){ 
  AnimatePop(lightexercisebutton);
  SetBMR(lightexercisebutton.dataset.bmr)
};
const moderateExercisebutton = document.getElementById("moderateExercisebutton");
moderateExercisebutton.onclick = function(){ 
  AnimatePop(moderateExercisebutton);
  SetBMR(moderateExercisebutton.dataset.bmr)
};
const veryActivebutton = document.getElementById("veryActivebutton");
veryActivebutton.onclick = function(){ 
  AnimatePop(veryActivebutton);
  SetBMR(veryActivebutton.dataset.bmr)
};
const extraActivebutton = document.getElementById("extraActivebutton");
extraActivebutton.onclick = function(){ 
  AnimatePop(extraActivebutton);
  SetBMR(extraActivebutton.dataset.bmr)
};

const minusOnebutton = document.getElementById("minusOnebutton");
minusOnebutton.onclick = function(){ 
  AnimatePop(minusOnebutton);
  SetGoal("minusOne")
};
const minusHalfbutton = document.getElementById("minusHalfbutton");
minusHalfbutton.onclick = function(){ 
  AnimatePop(minusHalfbutton);
  SetGoal("minusHalf")
};
const maintainbutton = document.getElementById("maintainbutton");
maintainbutton.onclick = function(){ 
  AnimatePop(maintainbutton);
  SetGoal("maintain")
};
const gainHalfbutton = document.getElementById("gainHalfbutton");
gainHalfbutton.onclick = function(){ 
  AnimatePop(gainHalfbutton);
  SetGoal("gainHalf")
};
const gainOnebutton = document.getElementById("gainOnebutton");
gainOnebutton.onclick = function(){ 
  AnimatePop(gainOnebutton);
  SetGoal("gainOne")
};

const savenutrientgoal = document.getElementById("savenutrientgoal");
savenutrientgoal.onclick = function()
{
  AnimatePop(savenutrientgoal);
  SaveNutrient();
};

let deleteweights = document.getElementsByClassName("deleteweights");
for(let i = 0; i < deleteweights.length; i++)
{
  let index = deleteweights[i].dataset.i;
  deleteweights[i].onclick = function()
  {
    AnimatePop(deleteweights[i]);
    DeleteWeight(index);
  };
}

const Carbohydrate = document.getElementById("Carbohydrate");
const Sugar = document.getElementById("Sugar");
const Fat = document.getElementById("Fat");
const Saturated = document.getElementById("Saturated");
const Protein = document.getElementById("Protein");
const Fibre = document.getElementById("Fibre");
const Salt = document.getElementById("Salt");
const Alcohol = document.getElementById("Alcohol");

const SaveWeightButton = document.getElementById("SaveWeightButton");
const WeightInput = document.getElementById("WeightInput");

let Gender = document.getElementById("Gender");
let Height = document.getElementById("Height");
let DOB = document.getElementById("DOB");
let Weight = document.getElementById("Weight");

let Burn = document.getElementById("Burn");
let ShowBmrButton = document.getElementById("ShowBmrButton");
let CloseBmrButton = document.getElementById("CloseBmrButton");
let BmrPanel = document.getElementById("BmrPanel");

let BMR = document.getElementById("BMR");
let noExercise = document.getElementById("noExercise");
let lightExercise = document.getElementById("lightExercise");
let moderateExercise = document.getElementById("moderateExercise");
let veryActive = document.getElementById("veryActive");
let extraActive = document.getElementById("extraActive");

let Goal = document.getElementById("Goal");
let ShowGoalButton = document.getElementById("ShowGoalButton");
let CloseGoalButton = document.getElementById("CloseGoalButton");
let GoalPanel = document.getElementById("GoalPanel");

const b = [Summary, Profile, Nutrient, WeightB];
const p = [SummaryScreen, ProfileScreen, NutrientScreen, WeightScreen];

// Assignments
messageBox.onclick = function(){ TogglePanel(messageBox, true, true); };
Summary.onclick = function(){
  AnimatePop(Summary);
  SwitchPanel(0);
};
Profile.onclick = function(){
  AnimatePop(Profile);
  SwitchPanel(1);
};
Nutrient.onclick = function(){
  AnimatePop(Nutrient);
  SwitchPanel(2);
};
WeightB.onclick = function(){
  AnimatePop(WeightB);
  SwitchPanel(3);
};
SaveWeightButton.onclick = function(){
  AnimatePop(SaveWeightButton);
  SaveWeight();
};
ShowBmrButton.onclick = function(){
  AnimatePop(ShowBmrButton);
  TogglePanel(BmrPanel, true, true);
};
CloseBmrButton.onclick = function(){
  AnimatePop(ShowBmrButton);
  TogglePanel(BmrPanel, true, true);
};
ShowGoalButton.onclick = function(){
  AnimatePop(ShowGoalButton);
  TogglePanel(GoalPanel, true, true);
  GetGoalInfo();
};
CloseGoalButton.onclick = function(){
  AnimatePop(CloseGoalButton);
  TogglePanel(GoalPanel, true, true);
};

// Variables
let timeOut = undefined;

// Startup
TogglePanel(messageBox, false, false);
TogglePanel(BmrPanel, false, false);
TogglePanel(GoalPanel, false, false);
SwitchPanel(0);

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

function SwitchPanel(index)
{
  for(let i = 0; i < p.length; i++)
  {
    if(i === index)
    {
      AnimateFadeIn(p[i]);
      b[i].classList.add("selected");
    }
    else
    {
      p[i].style.display = "none";
      b[i].classList.remove("selected");
    }
  }
}

function MessageBox(message)
{
  messageBox.innerHTML = message;
  if(messageBox.style.display === "none") TogglePanel(messageBox, true, true);
  AnimatePop(messageBox);
  if(timeOut != null) clearTimeout(timeOut);
  timeOut = setTimeout(AutoOff, 2500);
}

function AutoOff()
{
  AnimateFadeOut(messageBox);
}

function SaveProfile()
{
  let g = (Gender.options[Gender.selectedIndex].value === "M") ? 1 : 0;
  let data = [
    g,
    Height.value,
    DOB.value,
    Weight.value,
    Burn.value,
    Goal.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/user/SaveUser',
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
      MessageBox("User updated.");
      ProfileScreen.innerHTML = result;

      Gender = document.getElementById("Gender");
      Height = document.getElementById("Height");
      DOB = document.getElementById("DOB");
      Weight = document.getElementById("Weight");
      Burn = document.getElementById("Burn");
      Goal = document.getElementById("Goal");

      ShowBmrButton = document.getElementById("ShowBmrButton");
      CloseBmrButton = document.getElementById("CloseBmrButton");
      BmrPanel = document.getElementById("BmrPanel");

      BMR = document.getElementById("BMR");
      noExercise = document.getElementById("noExercise");
      lightExercise = document.getElementById("lightExercise");
      moderateExercise = document.getElementById("moderateExercise");
      veryActive = document.getElementById("veryActive");
      extraActive = document.getElementById("extraActive");

      TogglePanel(BmrPanel, false, false);

      ShowBmrButton.onclick = function(){
        AnimatePop(ShowBmrButton);
        TogglePanel(BmrPanel, true, true);
      };
      CloseBmrButton.onclick = function(){
        AnimatePop(ShowBmrButton);
        TogglePanel(BmrPanel, true, true);
      };

      ShowGoalButton = document.getElementById("ShowGoalButton");
      CloseGoalButton = document.getElementById("CloseGoalButton");
      GoalPanel = document.getElementById("GoalPanel");

      TogglePanel(GoalPanel, false, false);

      ShowGoalButton.onclick = function(){
        AnimatePop(ShowGoalButton);
        TogglePanel(GoalPanel, true, true);
        GetGoalInfo();
      };
      CloseGoalButton.onclick = function(){
        AnimatePop(CloseGoalButton);
        TogglePanel(GoalPanel, true, true);
      };
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function SaveNutrient()
{
  let data = [
    Carbohydrate.value,
    Sugar.value,
    Fat.value,
    Saturated.value,
    Protein.value,
    Fibre.value,
    Salt.value,
    Alcohol.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/user/SaveNutrient',
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
      MessageBox("Nutrient goal updated.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function SaveWeight()
{
  let data = [
    WeightInput.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/user/SaveWeight',
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
      MessageBox("Weight log added.");
      WeightOutput.innerHTML = result;
      deleteweights = document.getElementsByClassName("deleteweights");
      for(let i = 0; i < deleteweights.length; i++)
      {
        let index = deleteweights[i].dataset.i;
        deleteweights[i].onclick = function()
        {
          AnimatePop(deleteweights[i]);
          DeleteWeight(index);
        };
      }
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function DeleteWeight(id)
{
  if(!confirm("Delete this weight log?"))
  {
    return;
  }

  let data = [
    id,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/user/DeleteWeight',
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
      MessageBox("Weight log deleted.");
      WeightOutput.innerHTML = result;
      deleteweights = document.getElementsByClassName("deleteweights");
      for(let i = 0; i < deleteweights.length; i++)
      {
        let index = deleteweights[i].dataset.i;
        deleteweights[i].onclick = function()
        {
          AnimatePop(deleteweights[i]);
          DeleteWeight(index);
        };
      }
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function SetBMR(figure)
{
  let result = figure.replaceAll(",", "");
  Burn.value = result;
  TogglePanel(BmrPanel, true, true);
}

function GetGoalInfo()
{
  let currentBurn = parseFloat(document.getElementById("Burn").value);
  document.getElementById("minusOne").innerHTML = currentBurn - 1000;
  document.getElementById("minusHalf").innerHTML = currentBurn - 500;
  document.getElementById("maintain").innerHTML = currentBurn;
  document.getElementById("gainHalf").innerHTML = currentBurn + 500;
  document.getElementById("gainOne").innerHTML = currentBurn + 1000;
}

function SetGoal(ref)
{
  let figure = document.getElementById(ref).innerHTML;
  let result = figure.replaceAll(",", "");
  document.getElementById("Goal").value = result;
  TogglePanel(GoalPanel, true, true);
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
  panel.style.display = "";
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

function AnimateFromRight(panel)
{
  panel.animate(
  [
    { transform: 'translateX(+25%)', opacity: '0.0' },
    { transform: 'translateX(+20%)',  opacity: '0.25' },
    { transform: 'translateX(+15%)',  opacity: '0.50' },
    { transform: 'translateX(+10%)',  opacity: '0.75' },
    { transform: 'translateX(+5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
    { transform: 'translateX(-5%)',  opacity: '1.0' },
    { transform: 'translateX(-10%)',  opacity: '1.0' },
    { transform: 'translateX(-7.5%)',  opacity: '1.0' },
    { transform: 'translateX(-5%)',  opacity: '1.0' },
    { transform: 'translateX(-2.5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
  ],
  {
    duration: 150,
  }
);
}

function AnimateFromLeft(panel)
{
  panel.animate(
  [
    { transform: 'translateX(-25%)', opacity: '0.0' },
    { transform: 'translateX(-20%)',  opacity: '0.25' },
    { transform: 'translateX(-15%)',  opacity: '0.50' },
    { transform: 'translateX(-10%)',  opacity: '0.75' },
    { transform: 'translateX(-5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
    { transform: 'translateX(+5%)',  opacity: '1.0' },
    { transform: 'translateX(+10%)',  opacity: '1.0' },
    { transform: 'translateX(+7.5%)',  opacity: '1.0' },
    { transform: 'translateX(+5%)',  opacity: '1.0' },
    { transform: 'translateX(+2.5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
  ],
  {
    duration: 150,
  }
);
}