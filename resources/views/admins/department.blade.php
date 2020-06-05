@extends('layouts.app')

@section('content')
<div class='row'>
    <div class='col-sm-6'>
        <ul class="nav nav-tabs nav-justified mb-3">
            {{-- ユーザ詳細タブ --}}
            <li class="nav-item">
                <a href="{{ route('index') }}" class="nav-link {{ Request::routeIs('index') ? 'active' : '' }}">
                    ユーザー登録
                </a>
            </li>
            {{-- フォロー一覧タブ --}}
            <li class="nav-item">
                <a href="{{ route('change_department_page') }}" class="nav-link {{ Request::routeIs('change_department_page') ? 'active' : '' }}">
                    部署変更
                </a>
            </li>
        </ul>
        
        <div class="text-center">
            <h1>部署変更</h1>
        </div>
        
        {!! Form::open(['route' => 'change_department']) !!}

            <div class="form-group">
                {!! Form::label('email', 'メール') !!}
                {!! Form::select('email', $user_id_loop, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('department_id', '部署') !!}
                {!! Form::select('department_id', $department_id_loop, null, ['class' => 'form-control']) !!}
            </div>


            {!! Form::submit('変更', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
        
    </div>
</div>

@endsection