@if(isset($_GET['id']) == false)

<div class="text-center">
    <h1>ユーザー登録</h1>
</div>

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

@else

<div class="text-center">
    <h1>ユーザー登録完了</h1>
</div>

<h3>
    発行したパスワードは {{ $_GET['id'] }} です！
</h3>

<div class="text-center">
    <a href="/" class="btn btn-primary">戻る</a>
</div>

@endif
