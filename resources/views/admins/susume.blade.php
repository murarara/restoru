@extends('layouts.app')

@section('content')
<div class='row'>
    <div class='col-sm-12'>
        
        @include('admins.tab')
        
        <div class="text-center">
            <h1>有給取得のススメ</h1>
        </div>
        
        
        {!! Form::open(['route' => 'susume_post']) !!}

            <!--登録する月-->
            <div class="form-group">
                {!! Form::label('month', '月') !!}
                {!! Form::select('month', $months, null, ['class' => 'form-control']) !!}
            </div>
            
            <!--投稿内容-->
            <div class="form-group">
                {!! Form::label('content', '内容') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>


            {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
        
    </div>
</div>

@endsection