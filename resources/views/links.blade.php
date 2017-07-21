@extends('layouts.app')

@section('title')
  Опциональные ссылки
@endsection

@section('content')
  <div class="container row">
    <div class="col-md-3">
      <h3>Компания</h3>
      <ul>
        <li><a href="{{ route('seller.register.view') }}"></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
      </ul>
    </div>
    <div class="col-md-6"></div>
  </div>
@endsection