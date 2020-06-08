@extends('layouts.app')

@section('content')
<div class='row'>
    
    <div class='col-sm-12'>
        
        @include('admins.tab')
        
        <div class="text-center">
            <h1>有給取得のススメ</h1>
        </div>
        <div class='row'>
            <div class='col-sm-3'>
                <ul class="list-group list-group-flush">
                  @foreach($user->posts as $post)
                      <li class="list-group-item">
                          {{$post->content}}<br>
                          {!! Form::open(['route' => ['susume.destroy', $post->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                      </li>
                  @endforeach
                </ul>
            </div>
        
        
            <div class='col-sm-9'>
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
        
    </div>
</div>

@endsection