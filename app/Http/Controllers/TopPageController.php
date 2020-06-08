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
        
        if (Auth::check()) { // 認証済みの場合
            if (Auth::user()->flg_admin==1){
                if(Auth::user()->flg_first_login==0){
                    return view('users.reset_password');
                } else {
                    return view('admins.main', compact('department_id_loop'));
                }
            }
            else{
                
                if(Auth::user()->flg_first_login==0){
                    return view('users.reset_password');
                } else {
                    return view('welcome');
                }
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
        ]);
        
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->flg_first_login = 1;

        $user->save();
        
        return redirect('/');
    
    }
    
    public function change_department_page(){
        $users = User::select('id', 'email')->get();
        $departments = Department::select('id', 'name')->get();
        
        // $users = User::select('id', 'name', 'email', 'department_id')->get();
        
        $user_id_loop = $users->pluck('email','id');
        $department_id_loop = $departments->pluck('name', 'id');

        
        return view('admins.department',compact('user_id_loop', 'department_id_loop'));
    }
    
    public function change_department(Request $request){
        // dd($request->all());

        // $this->validate($request, [
        //     'department_id' => 'required',
        // ]);
        
        
        if (Auth::check()) {
            $this->validate($request, [
                'email' => ['required','string'],
                'department_id' => ['required','int'],
            ]);
            
            
        }
        
        return back();
    }
}
