@extends('layouts.app')

@section('content')
<div class='row'>
    <div class='col-sm-12'>
        @include('admins.tab')
        
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