@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザー登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('joined_at', '入社日') !!}
                    {!! Form::date('joined_at', new DateTime(), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('department_id', '部署') !!}
                    {!! Form::select('department_id', $department_id_loop, null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        {!! Form::radio('flg_admin', 0, true, ['class' => 'form-check-input']) !!}
                        <label class="form-check-label" for="exampleRadios1">
                            一般
                        </label>
                    </div>
                    <div class="form-check">
                        {!! Form::radio('flg_admin', 1, false, ['class' => 'form-check-input' ]) !!}
                        <label class="form-check-label" for="exampleRadios1">
                            管理者
                        </label>
                    </div>
                </div>

                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection