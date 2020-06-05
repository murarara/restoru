<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class TopPageController extends Controller
{
    public function index(){

        if (\Auth::check()) { // 認証済みの場合
            if (\Auth::user()->flg_admin==1){ //管理者ユーザの場合、ユーザ登録時に部署一覧が必要
                $departments = Department::select('id', 'name')->get();
                $department_id_loop = $departments->pluck('name', 'id');
                return view('auth.register', compact('department_id_loop'));
            }
            else{ //一般ユーザの処理
                return view('welcome');
            }
        }
        return view('welcome');  //非ログイン時のview
    }
}
