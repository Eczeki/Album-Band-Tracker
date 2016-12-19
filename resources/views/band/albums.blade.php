@extends('layouts.app')

@section('pageTitle', 'Albums')

@section('content')
    
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-info">
              {{Session::get('message')}}
            </div>
        @endif
    </div>
    <div class="row">
        <b>Filter By Band</b>
        <select class="form-control" onchange="window.location.href='{{Request::url()}}?band_id=' + $(this).val()">
            <option value="0">All</option>
            @foreach ($bands as $band)
                @if($band->id === $selected_band)
                    <option value="{{ $band->id }}" selected>{{ $band->name }}</option>
                @else
                    <option value="{{ $band->id }}">{{ $band->name }}</option>
                @endif
            @endforeach            
        </select>
    </div>
    <br>
    <div class="row">
        {!! $grid !!} 
    </div>

@endsection