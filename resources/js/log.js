"use strict";

let togglepanelwithid = document.getElementsByClassName("togglepanelwithid");
for(let i = 0; i < togglepanelwithid.length; i++)
{
  let id = togglepanelwithid[i].dataset.i;
  togglepanelwithid[i].onclick = function() { AnimatePop(togglepanelwithid[i]); TogglePanelWithID(id + "Log", true, true); };
}

let changetime = document.getElementsByClassName("changetime");
for(let i = 0; i < changetime.length; i++)
{
  let id = changetime[i].dataset.i;
  changetime[i].onchange = function() { ChangeTime(id); };
}

let deleteLog = document.getElementsByClassName("deleteLog");
for(let i = 0; i < deleteLog.length; i++)
{
  let id = deleteLog[i].dataset.i;
  deleteLog[i].onclick = function() { DeleteLog(id); };
}

let changeamount = document.getElementsByClassName("changeamount");
for(let i = 0; i < changeamount.length; i++)
{
  let id = changeamount[i].dataset.i;
  changeamount[i].onchange = function() { ChangeAmount(id); };
}

let changedate = document.getElementsByClassName("changedate");
for(let i = 0; i < changedate.length; i++)
{
  let id = changedate[i].dataset.i;
  changedate[i].onchange = function() { ChangeDate(id); };
}

let relog = document.getElementsByClassName("relog");
for(let i = 0; i < relog.length; i++)
{
  let id = relog[i].dataset.i;
  relog[i].onclick = function() { AnimatePop(relog[i]); ReLog(id); };
}

// Const
const messageBox = document.getElementById("messageBox");
const Controls = document.getElementById("Controls");

let lastdaybutton = document.getElementById("lastdaybutton");
lastdaybutton.onclick = function(){ AnimatePop(lastdaybutton); LastDay(); };

let nextdaybutton = document.getElementById("nextdaybutton");
nextdaybutton.onclick = function(){ AnimatePop(nextdaybutton); NextDay(); };

let Day = document.getElementById("Day");
let Breakdown = document.getElementById("Breakdown");
let Display = document.getElementById("Display");
let BreakdownScreen = document.getElementById("BreakdownScreen");

// Assignments
messageBox.onclick = function(){ TogglePanel(messageBox, true, true); };
Breakdown.onclick = function(){ TogglePanel(BreakdownScreen, true, true); };
Day.onchange = function(){ GetDay(Day.value); };

// Variables
let timeOut = undefined;

// Startup
TogglePanel(messageBox, false, false);
TogglePanel(BreakdownScreen, false, false);

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

function MessageBox(message)
{
  messageBox.innerHTML = message;
  if(messageBox.style.display === "none") TogglePanel(messageBox, true, true);
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

function CloseCircle(panel)
{
  let timer = 250;
  let deduct = timer - (timer / 10);
  setTimeout(function() { panel.style.display = "none" }, deduct);
  let h = panel.scrollHeight;
  let w = panel.scrollWidth;
  let n = 0;
  if(h > w) n = w;
  else n = h;
  panel.animate([
    { fontSize: '100%', transform: 'scale(100%, 100%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '80%', transform: 'scale(80%, 80%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '60%', transform: 'scale(70%, 70%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '50%', transform: 'scale(60%, 60%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '40%', transform: 'scale(50%, 50%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '30%', transform: 'scale(40%, 40%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '20%', transform: 'scale(30%, 30%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '10%', transform: 'scale(20%, 20%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '0%', transform: 'scale(10%, 10%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    { fontSize: '0%', transform: 'scale(5%, 5%)', borderRadius: '50%', height: n + "px", width: n + "px", maxHeight: n + "px", maxWidth: n + "px"},
    ],
    {
      duration: timer,
    }
  );
}

function CloseSlideUp(panel)
{
  let timer = 250;
  let deduct = timer - (timer / 10);
  setTimeout(function() { panel.style.display = "none" }, deduct);
  let h = panel.scrollHeight;
  let heights = [h, h*0.9, h*0.8, h*0.7, h*0.6, h*0.5, h*0.4, h*0.3, h*0.2, h*0.1];
  panel.animate([
    { height: heights[0] + "px", maxHeight: heights[0] + "px"},
    { height: heights[1] + "px", maxHeight: heights[1] + "px"},
    { height: heights[2] + "px", maxHeight: heights[2] + "px"},
    { height: heights[3] + "px", maxHeight: heights[3] + "px"},
    { height: heights[4] + "px", maxHeight: heights[4] + "px"},
    { height: heights[5] + "px", maxHeight: heights[5] + "px"},
    { height: heights[6] + "px", maxHeight: heights[6] + "px"},
    { height: heights[7] + "px", maxHeight: heights[7] + "px"},
    { height: heights[8] + "px", maxHeight: heights[8] + "px"},
    { height: heights[9] + "px", maxHeight: heights[9] + "px"},
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

function DeleteLog(id)
{
  if(!confirm("Delete this log?"))
  {
    return;
  }

  let data = [
    id,
    Day.value
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/DeleteLog',
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
      MessageBox("Log Deleted.");
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function GetDay(date)
{
  let data = [
    date,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/GetDay',
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
      MessageBox("Day Changed.");
      Controls.innerHTML = result;
      Day = document.getElementById("Day");
      Breakdown = document.getElementById("Breakdown");
      Display = document.getElementById("Display");
      BreakdownScreen = document.getElementById("BreakdownScreen");
      Breakdown.onclick = function(){ TogglePanel(BreakdownScreen, true, true); };
      Day.onchange = function(){ GetDay(Day.value); };
      TogglePanel(BreakdownScreen, false, false);
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ChangeTime(id)
{
  let time = document.getElementById(id + "Time");

  let data = [
    id,
    time.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/ChangeTime',
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
      MessageBox("Time Changed.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ChangeDate(id)
{
  if(!confirm("Change this log's date?"))
  {
    return;
  }

  let date = document.getElementById(id + "Date");

  let data = [
    id,
    date.value,
    Day.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/ChangeDate',
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
      MessageBox("Date Changed.");
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ChangeAmount(id)
{
  let amount = document.getElementById(id + "Amount");

  let data = [
    id,
    amount.value,
    Day.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/ChangeAmount',
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
      MessageBox("Amount Changed.");
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ReLog(id)
{
  if(!confirm("Re-log this entry?"))
  {
    return;
  }

  let data = [
    id,
    Day.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/ReLog',
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
      MessageBox("Re-logged.");
      Controls.innerHTML = result;
      Day = document.getElementById("Day");
      Breakdown = document.getElementById("Breakdown");
      Display = document.getElementById("Display");
      BreakdownScreen = document.getElementById("BreakdownScreen");
      Breakdown.onclick = function(){ TogglePanel(BreakdownScreen, true, true); };
      Day.onchange = function(){ GetDay(Day.value); };
      TogglePanel(BreakdownScreen, false, false);
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function LastDay()
{
  let data = [
    Day.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/LastDay',
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
      MessageBox("Day Changed.");
      Controls.innerHTML = result;
      Day = document.getElementById("Day");
      Breakdown = document.getElementById("Breakdown");
      Display = document.getElementById("Display");
      BreakdownScreen = document.getElementById("BreakdownScreen");
      Breakdown.onclick = function(){ TogglePanel(BreakdownScreen, true, true); };
      Day.onchange = function(){ GetDay(Day.value); };
      TogglePanel(BreakdownScreen, false, false);
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function NextDay()
{
  let data = [
    Day.value,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/log/NextDay',
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
      MessageBox("Day Changed.");
      Controls.innerHTML = result;
      Day = document.getElementById("Day");
      Breakdown = document.getElementById("Breakdown");
      Display = document.getElementById("Display");
      BreakdownScreen = document.getElementById("BreakdownScreen");
      Breakdown.onclick = function(){ TogglePanel(BreakdownScreen, true, true); };
      Day.onchange = function(){ GetDay(Day.value); };
      TogglePanel(BreakdownScreen, false, false);
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ReAssign()
{
  lastdaybutton = document.getElementById("lastdaybutton");
  lastdaybutton.onclick = function(){ AnimatePop(lastdaybutton); LastDay(); };

  nextdaybutton = document.getElementById("nextdaybutton");
  nextdaybutton.onclick = function(){ AnimatePop(nextdaybutton); NextDay(); };

  togglepanelwithid = document.getElementsByClassName("togglepanelwithid");
  for(let i = 0; i < togglepanelwithid.length; i++)
  {
    let id = togglepanelwithid[i].dataset.i;
    togglepanelwithid[i].onclick = function() { AnimatePop(togglepanelwithid[i]); TogglePanelWithID(id + "Log", true, true); };
  }

  changetime = document.getElementsByClassName("changetime");
  for(let i = 0; i < changetime.length; i++)
  {
    let id = changetime[i].dataset.i;
    changetime[i].onchange = function() { ChangeTime(id); };
  }

  deleteLog = document.getElementsByClassName("deleteLog");
  for(let i = 0; i < deleteLog.length; i++)
  {
    let id = deleteLog[i].dataset.i;
    deleteLog[i].onclick = function() { DeleteLog(id); };
  }

  changeamount = document.getElementsByClassName("changeamount");
  for(let i = 0; i < changeamount.length; i++)
  {
    let id = changeamount[i].dataset.i;
    changeamount[i].onchange = function() { ChangeAmount(id); };
  }

  changedate = document.getElementsByClassName("changedate");
  for(let i = 0; i < changedate.length; i++)
  {
    let id = changedate[i].dataset.i;
    changedate[i].onchange = function() { ChangeDate(id); };
  }

  relog = document.getElementsByClassName("relog");
  for(let i = 0; i < relog.length; i++)
  {
    let id = relog[i].dataset.i;
    relog[i].onclick = function() { AnimatePop(relog[i]); ReLog(id); };
  }
}