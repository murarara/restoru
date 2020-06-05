<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Yasumi\Yasumi;
use Carbon\Carbon;
use App\User;
use App\PaidVacation;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = (int)date('m');
        $currentYear = (int)date('Y');
        $dates = $this->getDates($currentMonth, $currentYear);
        $holidays = $this->getHolidays($currentYear);
        $all = $this->getAllOfYear($currentYear);
        
        //既に有給入れてる人たちのでーた
        $users = User::all();
        $paidVacations = PaidVacation::all();
        
        return view('welcome',[
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'allDates' => $all,
            // 'dates' => $dates,
            'users' => $users,
            'paid_vacations' => $paidVacations,
            'holidays' => $holidays,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 多分ここで表示ビュー返せばいい気がする
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dates = $this->getDates;
        
        //viewを返しちゃえば表示できるんじゃね？
        return view('calendars.month',[
                'dates' => $dates,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
     
        
    // $currentMonth = 5;
    // $currentYear = 2020;
    // $dates = getDates($currentYear, $currentMonth);
    
    /**
     * カレンダーのデータを作成する
     */
    public function getDates($currentMonth, $currentYear)
    {
        $dateStr = sprintf('%04d-%02d-01', $currentYear, $currentMonth);
        $date = new Carbon($dateStr);
        $addDay = ($date->copy()->endOfMonth()->isSunday()) || ($date->copy()->endOfMonth()->isMonday()) ? 7 : 0;
        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $date->subDay($date->dayOfWeek);
        // 同上。右下の隙間のための計算。
        $count = 31 + $addDay + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        
        $dates = [];
    
        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            // copyしないと全部同じオブジェクトを入れてしまうことになる
            $dates[] = $date->copy();
        }
        return $dates;
        
        
    }
    
    /**
     * カレンダーのデータを作成する
     */
    public function getAllOfYear($currentYear)
    {
        $all = array();
        $year = $currentYear;
        for($i = 4; $i <= 15; $i++) {
            $j = $i;
            if($i >= 13) {
                $j = $i - 12;
                $year = $currentYear + 1;
            }
            array_push($all, $this->getDates($j, $year));
        }
        return $all;
    }
    
    /**
     * 日本の祝日
     */
    public function getHolidays($currentYear)
    {
        $holidays[(string)$currentYear] = Yasumi::create('Japan', (string)$currentYear, 'ja_JP');
        $holidays[(string)($currentYear+1)] = Yasumi::create('Japan', (string)($currentYear+1), 'ja_JP');
    
        return $holidays;
    
    }
}
