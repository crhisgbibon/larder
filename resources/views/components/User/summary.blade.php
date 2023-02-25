<style>
  :root{
    --green: rgba(150, 225, 150, 1);
    --greenBorder: rgba(125, 175, 125, 1);
    --red: rgba(225, 150, 150, 1);
    --redBorder: rgba(175, 125, 125, 1);
  }
</style>

<div class="w-full flex flex-col rows-center justify-center max-w-3xl mx-auto" style="height:calc(var(--vh) * 77);;max-height:calc(var(--vh) * 77);">

  <div class="flex flex-row justify-center rows-center w-full max-w-2xl mx-auto my-4" style="height:calc(var(--vh) * 5)">
    <button id="LastStat" class="w-1/3 h-10/12 mx-4 p-2 flex justify-center rows-center rounded-lg">
      <img src="{{ asset('storage/Assets/chevronLeftLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
    <div id="Stat" class="w-1/3 h-10/12 mx-4 p-2 flex justify-center rows-center rounded-lg">
      {{ __('Weight') }}
    </div>
    <button id="NextStat" class="w-1/3 h-10/12 mx-4 p-2 flex justify-center rows-center rounded-lg">
      <img src="{{ asset('storage/Assets/chevronRightLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
    </button>
  </div>

  <div id="CanvasHolder" class="w-full my-2 flex justify-center rows-center" style="height:calc(var(--vh) * 75)">
    <canvas id="Chart"></canvas>
  </div>

  <div class="flex flex-row justify-center rows-center w-full max-w-2xl mx-auto my-4" style="height:calc(var(--vh) * 5)">
    <button id="LastPeriod" class="w-1/3 h-10/12 mx-4 p-2 flex justify-center rows-center rounded-lg">
      <img src="{{ asset('storage/Assets/chevronLeftLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
    <div id="Period" class="w-1/3 h-10/12 mx-4 p-2 flex justify-center rows-center rounded-lg">
      {{ __('Week') }}
    </div>
    <button id="NextPeriod" class="w-1/3 h-10/12 mx-4 p-2 flex justify-center rows-center rounded-lg">
      <img src="{{ asset('storage/Assets/chevronRightLight.svg') }}" style="width:75%;height:75%;max-width:30px;max-height:30px">
    </button>
  </div>

<script type="module" src="https://cdn.jsdelivr.net/npm/chart.js@4.1.1/dist/chart.umd.min.js"></script>

<script>
  // Data
  const chartdata = {!! json_encode($chartdata) !!};
  // Canvas
  const CanvasHolder = document.getElementById("CanvasHolder");
  // Stat
  const LastStat = document.getElementById("LastStat");
  const Stat = document.getElementById("Stat");
  const NextStat = document.getElementById("NextStat");
  // Period
  const LastPeriod = document.getElementById("LastPeriod");
  const Period = document.getElementById("Period");
  const NextPeriod = document.getElementById("NextPeriod");

  // Stat
  LastStat.onclick = function() { AnimatePop2(LastStat); LastS(); };
  NextStat.onclick = function() { AnimatePop2(NextStat); NextS(); };
  // Period
  LastPeriod.onclick = function() { AnimatePop2(LastPeriod); LastP(); };
  NextPeriod.onclick = function() { AnimatePop2(NextPeriod); NextP(); };

  let currentStat = 0, currentPeriod = 0;
  const stats = ["Weight", "Calories", "Nutrients", "BMI", "Cost"];
  const periods = ["Week", "Month", "Quarter", "Year", "Decade", "Forever"];

  let style = getComputedStyle(document.body);
  let red = style.getPropertyValue('--red');
  let green = style.getPropertyValue('--green');
  let redBorder = style.getPropertyValue('--redBorder');
  let greenBorder = style.getPropertyValue('--greenBorder');

  function AnimatePop2(panel)
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

    function AnimateFadeIn2(panel)
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

    function AnimateFadeOut2(panel)
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

    function AnimateFromRight2(panel)
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

    function AnimateFromLeft2(panel)
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

  function NextS()
  {
    currentStat++;
    if(currentStat > stats.length - 1) currentStat = 0;
    Stat.innerHTML = stats[currentStat];
    AnimateFromRight2(Stat);
    LoadTable();
  }

  function LastS()
  {
    currentStat--;
    if(currentStat < 0) currentStat = stats.length - 1;
    Stat.innerHTML = stats[currentStat];
    AnimateFromLeft2(Stat);
    LoadTable();
  }

  function NextP()
  {
    currentPeriod++;
    if(currentPeriod > periods.length - 1) currentPeriod = 0;
    Period.innerHTML = periods[currentPeriod];
    AnimateFromRight2(Period);
    LoadTable();
  }

  function LastP()
  {
    currentPeriod--;
    if(currentPeriod < 0) currentPeriod = periods.length - 1;
    Period.innerHTML = periods[currentPeriod];
    AnimateFromLeft2(Period);
    LoadTable();
  }

  function LoadTable()
  {
    let stat = Stat.innerHTML.trim();
    let period = Period.innerHTML.trim();
    if(stat === "Weight" || stat === "Calories" || stat === "BMI" || stat === "Cost")
    {
      LineChart(stat, period);
    }
    else if(stat === "Nutrients" || stat === "Distribution")
    {
      BarChart(stat, period);
    }
    AnimateFadeIn2(CanvasHolder, true, true);
  }

  function LineChart(stat, period)
  {
    if(window.chart !== undefined) if(window.chart !== null) window.chart.destroy();
    if(chartdata === null || chartdata === undefined) return;

    let d2 = [], labels = [], info = [], backgroundColor = green, borderColor = greenBorder;

    if(stat === "Weight")
    {
      if(chartdata['weights'] === null || chartdata['weights'] === undefined) return;
      let d = chartdata['weights'];
      if(period === "Week") d2 = d.filter(item => (item.period === "WEEK"));
      else if(period === "Month") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH"));
      else if(period === "Quarter") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER"));
      else if(period === "Year") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR"));
      else if(period === "Decade") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR" || item.period === "DECADE"));
      else if(period === "Forever") d2 = d;

      labels = d2.map(row => row.logTime );
      info = d2.map(row =>  row.weight );
    }
    else if(stat === "Calories")
    {
      if(chartdata['calories'] === null || chartdata['calories'] === undefined) return;
      let d = chartdata['calories'];
      if(period === "Week") d2 = d.filter(item => (item.period === "WEEK"));
      else if(period === "Month") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH"));
      else if(period === "Quarter") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER"));
      else if(period === "Year") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR"));
      else if(period === "Decade") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR" || item.period === "DECADE"));
      else if(period === "Forever") d2 = d;

      labels = d2.map(row => row.logTime );
      info = d2.map(row =>  row.calories );
    }
    else if(stat === "BMI")
    {
      if(chartdata['bmi'] === null || chartdata['bmi'] === undefined) return;
      let d = chartdata['bmi'];
      if(period === "Week") d2 = d.filter(item => (item.period === "WEEK"));
      else if(period === "Month") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH"));
      else if(period === "Quarter") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER"));
      else if(period === "Year") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR"));
      else if(period === "Decade") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR" || item.period === "DECADE"));
      else if(period === "Forever") d2 = d;

      labels = d2.map(row => row.logTime );
      info = d2.map(row =>  row.bmi );
    }
    else if(stat === "Cost")
    {
      if(chartdata['price'] === null || chartdata['price'] === undefined) return;
      let d = chartdata['price'];
      if(period === "Week") d2 = d.filter(item => (item.period === "WEEK"));
      else if(period === "Month") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH"));
      else if(period === "Quarter") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER"));
      else if(period === "Year") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR"));
      else if(period === "Decade") d2 = d.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR" || item.period === "DECADE"));
      else if(period === "Forever") d2 = d;

      labels = d2.map(row => row.logTime );
      info = d2.map(row =>  row.price );
    }

    let data = {
      labels: labels,
      datasets: [{
        data: info,
        fill: true,
        backgroundColor: backgroundColor,
        borderColor: borderColor,
        tension: 0.1,
        borderWidth: 1,
      }]
    };

    window.chart = new Chart(
      document.getElementById('Chart'),
      {
        type: 'line',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: false,
          },
        },
      }
    );
  }

  function BarChart(stat, period)
  {
    if(window.chart !== undefined) if(window.chart !== null) window.chart.destroy();
    if(chartdata === null || chartdata === undefined) return;

    let labels = [], info1 = [], info2 = [], backgroundColor = green, borderColor = greenBorder;

    if(stat === "Nutrients")
    {
      if(chartdata['nutrients'] === null || chartdata['nutrients'] === undefined) return;
      let d = chartdata['nutrients'];
      let days = d['days'];

      let days2 = [];
      if(period === "Week") days2 = days.filter(item => (item.period === "WEEK"));
      else if(period === "Month") days2 = days.filter(item => (item.period === "WEEK" || item.period === "MONTH"));
      else if(period === "Quarter") days2 = days.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER"));
      else if(period === "Year") days2 = days.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR"));
      else if(period === "Decade") days2 = days.filter(item => (item.period === "WEEK" || item.period === "MONTH" || item.period === "QUARTER" || item.period === "YEAR" || item.period === "DECADE"));
      else if(period === "Forever") days2 = days;

      let targets = d['targets'];
      labels = targets.map(row => {
        let first = row.name.charAt(0);
        let cap = first.toUpperCase();
        let remain = row.name.slice(1);
        let result = cap + remain;
        return result;
      });
      info1 = targets.map(row => row.total);
      let temp = [0, 0, 0, 0, 0, 0, 0, 0];
      for(let i = 0; i < days2.length; i++)
      {
        temp[0] += days2[i]['carbohydrate'];
        temp[1] += days2[i]['sugar'];
        temp[2] += days2[i]['fat'];
        temp[3] += days2[i]['saturated'];
        temp[4] += days2[i]['protein'];
        temp[5] += days2[i]['fibre'];
        temp[6] += days2[i]['salt'];
        temp[7] += days2[i]['alcohol'];
      }
      info2 = temp;
    }

    let data = {
      labels: labels,
      datasets: [{
        label: 'Targets',
        data: info1,
        fill: false,
        backgroundColor: red,
        borderColor: redBorder,
        pointBackgroundColor: 'rgb(255, 99, 132)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(255, 99, 132)'
      }, {
        label: 'Totals',
        data: info2,
        fill: false,
        backgroundColor: green,
        borderColor: greenBorder,
        pointBackgroundColor: 'rgb(54, 162, 235)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(54, 162, 235)'
      }]
    };

    window.chart = new Chart(
      document.getElementById('Chart'),
      {
        type: 'bar',
        data: data,
        options: {
          indexAxis: 'x',
          responsive: true,
          plugins: {
            legend: true,
          },
          elements: {
            line: {
              borderWidth: 3
            }
          },
          scales: {
            y: {
              type: 'logarithmic',
            }
          }
        },
      }
    );
  }

  document.addEventListener("DOMContentLoaded", LoadTable);

</script>

</div>