<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PaidVacation;

class PaidVacationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * ここに全件取得の処理入れたらいいのかな？
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $paidVacations = PaidVacation::all();
        $data = [
            'users' => $users, 
            'paid_vacations' => $paidVacations
        ];
        
        return view('calendars.index', $data);
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
        foreach($request->dates as $date){
            $request->user()->paidVacation()->create([
                'date' => $date,
            ]);
        }
        
        return back();
    }

    /**
     * Display the specified resource.
     * 多分ここに部署別表示の処理を入れたらいいと思う 
     * ($idが部署ID？)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
