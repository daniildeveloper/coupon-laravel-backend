@extends('layouts.app')

@section('title')
  Кабинет продавца | @yield('seller_title')
@endsection

@section('content')
  <div class="container">
    <div class="row row-wrap">
      {{-- seller sidebar menu --}}
      {{-- this sidebar is for sellers with good ui only for desktops. For mobile and tablets is seller app better --}}
      <div class="col-md-3">
        @include('seller.sidebar')
      </div>
      {{-- end seller app --}}

      <div class="col-md-8">
        @yield('seller_content')
      </div>
    </div>
  </div>
@endsection