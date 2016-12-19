@extends('layouts.app')

@section('pageTitle', 'Create Band')

@section('content')
    
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-info">
              {{Session::get('message')}}
            </div>
        @endif
    </div>
    <div class="row">
        {{ Html::linkRoute('home', 'Back', [], ['class' => 'btn btn-default']) }}
    </div>
    <br>
    <div class="row">     
        {!! form($form) !!}
    </div>


@endsection