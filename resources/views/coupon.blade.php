@extends('layouts.app')

@section('title')
  {{ $product->title }}
@endsection

@section('content')
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-6">
    <div class="fotorama" data-nav="thumbs" data-allowfullscreen="1" data-thumbheight="100" data-thumbwidth="100">
      <img src="{{asset($product->image)}}" alt="{{$product->title}}" title="{{$product->title}}" 
      style="width: 200px">
      @if($product->carousel_1)
        <img src="/public/storage/{{$product->carousel_1}}" alt="{{$product->title}}" title="{{$product->title}}"> 
      @endif
      
      @if($product->carousel_2)
        <img src="/public/storage/{{$product->carousel_2}}" alt="{{$product->title}}" title="{{$product->title}}"> 
      @endif
      @if($product->carousel_3)
        <img src="/public/storage/{{$product->carousel_3}}" alt="{{$product->title}}" title="{{$product->title}}"> 
      @endif
      @if($product->carousel_4)
        <img src="/public/storage/{{$product->carousel_4}}" alt="{{$product->title}}" title="{{$product->title}}"> 
      @endif
    </div>
  </div>

  <div class="col-md-5">
{{--     <ul class="icon-group icon-list-rating text-color" title="4.5/5 rating">
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star-half-empty"></i></li>
    </ul>
    <small><a class="text-muted" href="#">оценили 4 купивших</a></small> --}}
    <h3>{{$product->title}}</h3>
    <div>
      {!! $product->description !!}
    </div>
    <p>До конца акции: <span id="countdown{{$product->id}}"></span></p>
    
    <a class="btn btn-sm" href="{{route("shop.to-cart", ["id" => $product->id])}}"><i class="fa fa-shopping-cart"></i> В корзину</a>
    <button class="btn btn-sm " data-target="#email" data-toggle="modal">Быстрый заказ</button>
    {{-- <li><a class="btn btn-sm"><i class="fa fa-bars"></i> Больше</a></li> --}}
    
  </div>
</div>

<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <form action="{{url('/shop/mailorder/new/' . $product->id)}}" method="GET">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Быстрый заказ</h4>
      </div>
    <div class="modal-body">
        
      <div class="form-group">
        <label for="recipient-name" class="control-label">Email отправителя:</label>
        <input type="email" name="email" class="form-control" id="recipient-name">
      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Купить сейчас</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection