@extends('seller.layout')

@section('seller_title')
Мои менеджеры
@endsection

@section('seller_content')
<div class="row">
    @if (count($managers) > 0)
      @foreach($managers as $manager)
        <div class="col-md-3 text-center">
          <img src="" alt="" class="img-responsive img-circle manager_avatar">
          <h3>{{ $manager->name }}</h3>
          <div class="row">
          {{-- TODO: show managers personal statistics --}}
          {{-- TODO: delete manager --}}
            <div class="col-xs-6"><a href="" class="btn btn-default">Просмотр</a></div>
            <div class="col-xs-6"><a href="" class="btn btn-warning">Уволить</a></div>
          </div>
        </div>
      @endforeach
  @endif
</div>
