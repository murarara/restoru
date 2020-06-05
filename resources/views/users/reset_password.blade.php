@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            <div class="text-center">
                <h1>パスワード変更</h1>
            </div>
            
            {!! Form::open(['route' => 'reset_password']) !!}
                
                <div class="form-group">
                      {!! Form::label('password', '新規パスワード') !!}
                      {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                      {!! Form::label('password_confirmation', '新規パスワードの確認') !!}
                      {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>


                {!! Form::submit('変更', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection