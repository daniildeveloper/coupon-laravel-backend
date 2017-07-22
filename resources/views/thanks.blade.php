@extends('layouts.app')

@section('title')
{{ $title }}
@endsection

@section('content')
  <div class="thank-you container">
    <h2 class="message text-center">{{ $message }}</h2>
    <img class="" src="@if(isset($imgSrc)) {{ $imgSrc }} @else {{ asset('images/thanks/default.png')}} @endif" alt="{{ $title }}">
  </div>
@endsection