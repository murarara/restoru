<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class TopPageController extends Controller
{
    public function index(){
        $departments = Department::select('id', 'name')->get();
        $department_id_loop = $departments->pluck('name', 'id');
        if (\Auth::check()) { // 認証済みの場合
            if (\Auth::user()->flg_admin==1){
                return view('auth.register', compact('department_id_loop'));
            }
            else{
                return view('welcome');
            }
        }
        return view('welcome');
    }
}
