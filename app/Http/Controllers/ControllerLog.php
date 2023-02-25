<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ModelLog;

class ControllerLog extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
  */

  public function log()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelLog();
    $day = date("Y-m-d", time());
    $logs = $model->GetLogsWithData(time());
    // return $logs;
    $totals = $model->Totals($logs);
    // $totals = $model->GetFoodTotals(time());
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    return view('log', [
      'day' => $day,
      'logs' => $logs,
      'totals' => $totals,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function DeleteLog(Request $request)
  {
    $index = (int)$request->data[0];
    $day = (string)$request->data[1];
    $newDate = strtotime(date("Y-m-d", strtotime($day)));
    $model = new ModelLog();
    $model->DeleteLog($index);
    $logs = $model->GetLogsWithData($newDate);
    return view('components.Log.data', [
      'logs' => $logs,
    ]);
  }

  public function ChangeTime(Request $request)
  {
    $index = (int)$request->data[0];
    $time = (string)$request->data[1];
    $model = new ModelLog();
    $log = $model->GetLog($index);
    $date = date("Y-m-d", $log->logTime);
    $newTime = $date .  " " . $time;
    $newTime = strtotime($newTime);
    $model->ChangeLogTime($index, $newTime);
  }

  public function ChangeDate(Request $request)
  {
    $index = (int)$request->data[0];
    $date = (string)$request->data[1];
    $day = strtotime(date("Y-m-d", strtotime((string)$request->data[2])));
    $model = new ModelLog();
    $log = $model->GetLog($index);
    $time = date("H:i:s", $log->logTime);
    $newDate = $date .  " " . $time;
    $newDate = strtotime($newDate);
    $model->ChangeLogTime($index, $newDate);
    $logs = $model->GetLogsWithData($day);
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    return view('components.Log.data', [
      'logs' => $logs,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function ChangeAmount(Request $request)
  {
    $index = (int)$request->data[0];
    $amount = (float)$request->data[1];
    $day = strtotime(date("Y-m-d", strtotime((string)$request->data[2])));
    $model = new ModelLog();
    $model->ChangeLogAmount($index, $amount);
    $logs = $model->GetLogsWithData($day);
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    return view('components.Log.data', [
      'logs' => $logs,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function ReLog(Request $request)
  {
    $index = (int)$request->data[0];
    $dayDate = strtotime(date("Y-m-d", strtotime((string)$request->data[1])));
    $model = new ModelLog();
    $model->ReLog($index);
    $totals = $model->GetFoodTotals($dayDate);
    $logs = $model->GetLogsWithData($dayDate);
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    $day = date("Y-m-d", $dayDate);
    return view('components.Log.controls', [
      'logs' => $logs,
      'totals' => $totals,
      'day' => $day,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function GetDay(Request $request)
  {
    $day = (string)$request->data[0];
    $newDate = strtotime(date("Y-m-d", strtotime($day)));
    $model = new ModelLog();
    $logs = $model->GetLogsWithData($newDate);
    $totals = $model->GetFoodTotals($newDate);
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    $day = date("Y-m-d", $newDate);
    return view('components.Log.controls', [
      'logs' => $logs,
      'totals' => $totals,
      'day' => $day,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function LastDay(Request $request)
  {
    $day = (string)$request->data[0];
    $newDate = strtotime(date("Y-m-d", strtotime($day . ' -1 day')));
    $model = new ModelLog();
    $logs = $model->GetLogsWithData($newDate);
    $totals = $model->GetFoodTotals($newDate);
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    $day = date("Y-m-d", $newDate);
    return view('components.Log.controls', [
      'logs' => $logs,
      'totals' => $totals,
      'day' => $day,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }

  public function NextDay(Request $request)
  {
    $day = (string)$request->data[0];
    $newDate = strtotime(date("Y-m-d", strtotime($day . ' +1 day')));
    $model = new ModelLog();
    $logs = $model->GetLogsWithData($newDate);
    $totals = $model->GetFoodTotals($newDate);
    $targets = $model->GetNutrientTargets();
    $profile = $model->GetProfile();
    $day = date("Y-m-d", $newDate);
    return view('components.Log.controls', [
      'logs' => $logs,
      'totals' => $totals,
      'day' => $day,
      'targets' => $targets,
      'profile' => $profile,
    ]);
  }
}