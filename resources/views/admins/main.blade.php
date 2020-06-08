@extends('layouts.app')

@section('content')
<div class='row'>
    <div class='col-sm-12'>
        @include('admins.tab')
        
        @include('auth.register')
        
    </div>
</div>

@endsection