@extends('layouts.app')

@section('pageTitle', 'Edit Band')

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
    <div class="row">
        <h2>Albums:</h2>
    </div>
    <br>
    <div class="row">
        @foreach ($albumSet->data as $album)
            <div class="col-sm-4" style="margin-bottom: 5px">
                <strong>{!! $album->name !!}</strong><br />
                <em>{!! $album->label !!}</em><br />
                <small>{!! $album->producer  !!}</small><br />
             </div>
        @endforeach        
    </div>
    {!! $albumSet->links() !!}
@endsection