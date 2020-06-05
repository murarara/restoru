<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

use App\User;
use Auth;

use Illuminate\Support\Facades\Hash;

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
    
    public function reset_page(){
        return view('users.reset_password');
    }
    
    public function reset_password(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'password' => ['required','string','min:8','confirmed'],
            //'password_confirmation' => ['required','string','min:8','confirmed', 'same::password'],
        ]);
        
        $user = User::find(Auth::user()->id);
        
        $user->password = Hash::make($request->password);
        //$user->password_confirmation = Hash::make($request->password_confirmation);

        $user->save();
        
        return redirect('/');
    
    }
}
