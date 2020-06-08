<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

use App\User;
use Auth;

use Illuminate\Support\Facades\Hash;

use \Yasumi\Yasumi;
use Carbon\Carbon;

use App\PaidVacation;
use App\Post;

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
                    $currentMonth = (int)date('m');
                    $currentYear = (int)date('Y');
                    $dates = $this->getDates($currentMonth, $currentYear);
                    $holidays = $this->getHolidays($currentYear);
                    $all = $this->getAllOfYear($currentYear);
                    $users_paid_vacations = PaidVacation::where('user_id', Auth::user()->id)->get();
                    
                    //既に有給入れてる人たちのでーた
                    $users = User::all();
                    $paidVacations = PaidVacation::all();
                    
                    //ススメのでーた
                    $posts = Post::all();
                    
                    return view('welcome',[
                        'currentMonth' => $currentMonth,
                        'currentYear' => $currentYear,
                        'allDates' => $all,
                        // 'dates' => $dates,
                        'users' => $users,
                        'paid_vacations' => $paidVacations,
                        'users_paid_vacations' => $users_paid_vacations,
                        'holidays' => $holidays,
                        'posts' => $posts
                    ]);
                    
                    //return redirect('/main'); // カレンダーを強制的に表示
                    //return view('welcome');
                }
            }
        }
        return view('welcome');  //非ログイン時のview
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

    public function change_department_page(){
        $users = User::select('id', 'email')->get();
        $departments = Department::select('id', 'name')->get();
        
        // $users = User::select('id', 'name', 'email', 'department_id')->get();
        
        $user_id_loop = $users->pluck('email','id');
        $department_id_loop = $departments->pluck('name', 'id');

        
        return view('admins.department',compact('user_id_loop', 'department_id_loop'));
    }
    
    public function change_department(Request $request){
        if (Auth::check()) {
            $this->validate($request, [
                'email' => ['required','string'],
                'department_id' => ['required','int'],
            ]);
            
            $user = User::find($request->email);
            $user->department_id = $request->department_id;
            $user->save();
        }
        
        return back();
    }

    public function susume_page(){
        if (Auth::check()) {
            $user = Auth::user();
        }
        
        $months = array();
        for($monthi = 1; $monthi <= 12; $monthi++){
            $months[(string)$monthi] = $monthi.'月';
        }
        
        return view('admins.susume', ['user'=>$user, 'months'=>$months]);
    }
    
    public function susume_post(Request $request){
        
        if (Auth::check()) {
            $month = $request->month;
            $content = $request->content;
            $user_id = Auth::user()->id;
            
            Post::create([
                    'user_id' => $user_id,
                    'content' => $content,
                    'month' => $month,
                ]);
        }
        
        return back();
    }
}
