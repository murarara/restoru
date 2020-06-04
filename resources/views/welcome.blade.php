@extends('layouts.app')

@section('content')
    @if(Auth::check())
        @if(Auth::user()->flg_admin==1)
            <div class="center jumbotron">
                <div class="text-center">
                    <h3>管理者ページです</h3>
                </div>
            </div>
        @else
            <div class="center jumbotron">
                <div class="text-center">
                    <h3>風邪で有休消化はもったいない！<br>
                        どうせ休むなら思いっきり楽しんで、リフレッシュしましょう！<br>
                        リフレッシュして帰ってきたら、また仕事に一生懸命取り組みましょう。<br>
                        仕事も遊びも全力で！
                    </h3>
                </div>
            </div>
        @endif
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h3>風邪で有休消化はもったいない！<br>
                    どうせ休むなら思いっきり楽しんで、リフレッシュしましょう！<br>
                    リフレッシュして帰ってきたら、また仕事に一生懸命取り組みましょう。<br>
                    仕事も遊びも全力で！
                </h3>
            </div>
        </div>
        
        <div class="center jumbotron">
            <div class="text-center">
                <h3>-----------------<br>
                    レストルでは、有給取得日の登録が簡単にできます！<br>
                    有給取得日を他の人と共有しましょう。
                </h3>
            </div>
        </div>
    @endif
@endsection