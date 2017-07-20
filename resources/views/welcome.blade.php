@extends('layouts.app')

@section("title")
CouponLand
@endsection

@section('content')
<main>
    <div class="container">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.sidebar")
    </div>
    <div class="col-md-9">
      <div class="gap gap-small"></div>
      <div class="row row-wrap">
        @foreach($products as $product)
          {{-- {{ dd(Session::get('favorites')) }} --}}
          <div class="col-md-4">
            <div class="product-thumb"  @if ($product->is_border) style="border: 5px solid #FEC52E; @endif ">
                @if($product->is_hit != 0)
                  <div class="hit">
                    <div class="hit-text">
                      Хит
                    </div>
                  </div>
                @endif
                <div class="favorites-link ">
                  <a href="{{ route(H::favoritesToggle($product->id), ['id' => $product->id]) }}" class="favorites @if(H::checkFavorites($product->id)) active @endif">
                    <i class="fa fa-heart"></i>
                  </a>
                </div>
              <header class="product-header"><img style="height: 260px" src="{{$product->image}}" alt="{{$product->title}}" title="{{$product->title}}">
                <div class="product-quick-view">
                  <a class="fa fa-eye popup-text" href="#product-quick-view-dialog-{{$product->id}}" data-effect="mfp-move-from-top" data-toggle="tooltip" data-placement="top" title="Посмотреть"></a>
                </div>
                {{-- <div class="product-secondary-image"><img style="height: 260px" src="/public/storage/{{$product->carousel_1}}" alt="{{$product->title}}" title="{{$product->title}}"></div> --}}
              </header>
              <div class="product-inner">
                <ul class="icon-group icon-list-rating icon-list-non-rated" title="not rated yet">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <h5 class="product-title">{{$product->title}}</h5>
                <p class="product-desciption">{!!$product->short_description!!}</p>
                <div class="product-meta">
                  <ul class="product-price-list">
                    {{-- <li><span class="product-price">500тг</span></li>
                    <li><span class="product-old-price">1000тг</span></li> --}}
                    {{-- <li><span class="product-save">Скидка {{$product->profit_all}}%</span></li> --}}
                  </ul>
                  <ul class="product-actions-list">
                    <li><a class="btn btn-sm" href="{{route("shop.to-cart", ["id" => $product->id])}}"><i class="fa fa-shopping-cart"></i> В корзину</a></li>
                    <li><button class="btn btn-sm " data-target="#email" data-toggle="modal">Быстрый заказ</button></li>
                    {{-- <li><a class="btn btn-sm"><i class="fa fa-bars"></i> Больше</a></li> --}}
                  </ul>
                </div>
              </div>
            </div>
          </div>

          {{-- quick view dialog --}}
        <div class="mfp-with-anim mfp-hide mfp-dialog mfp-dialog-big clearfix" id="product-quick-view-dialog-{{$product->id}}">
          <div class="row">
           {{--  <div class="col-md-7">
              <div class="fotorama" data-nav="thumbs" data-allowfullscreen="1" data-thumbheight="100" data-thumbwidth="100">
                <img src="/public/storage/{{$product->image}}" alt="{{$product->title}}" title="{{$product->title}}" 
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
 --}}
            <div class="col-md-5">
              <ul class="icon-group icon-list-rating text-color" title="4.5/5 rating">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-half-empty"></i></li>
              </ul><small><a class="text-muted" href="#">оценили 4 купивших</a></small>
              <h3>{{$product->title}}</h3>
              <div>
                {!! $product->description !!}
              </div>
              <p>До конца акции: <span id="countdown{{$product->id}}"></span></p>
              <p></p>
              <script>

                
              </script>
            </div>
          </div>
          {{-- <hr><a class="btn btn-primary" href="#">Больше</a> --}}
        </div>
        {{-- end dialog --}}

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
        @endforeach
      </div>
    </div>
  </div>
</div>
</main>
@endsection

@section("scripts")
<script src="{{asset("js/jquery.js")}}">
</script>
<script src="{{asset("js/boostrap.min.js")}}">
</script>
<script src="{{asset("js/countdown.min.js")}}">
</script>
<script src="{{asset("js/flexnav.min.js")}}">
</script>
<script src="{{asset("js/magnific.js")}}">
</script>
<script src="{{asset("js/tweet.min.js")}}">
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false">
</script>
<script src="{{asset("js/fitvids.min.js")}}">
</script>
<script src="{{asset("js/mail.min.js")}}">
</script>
<script src="{{asset("js/ionrangeslider.js")}}">
</script>
<script src="{{asset("js/icheck.js")}}">
</script>
<script src="{{asset("js/fotorama.js")}}">
</script>
<script src="{{asset("js/card-payment.js")}}">
</script>
<script src="{{asset("js/owl-carousel.js")}}">
</script>
<script src="{{asset("js/masonry.js")}}">
</script>
<script src="{{asset("js/nicescroll.js")}}">
</script>
<script src="{{asset("js/custom.js")}}">
</script>
<script src="{{asset("js/simple.js")}}"></script>
  <script src="{{asset("vendors/jquery.countdown/dist/jquery.countdown.js")}}">
    
  </script>

  
  <script>
    window.onload = function() {
      @foreach($products as $product)
        $("#countdown{{$product->id}}").countdown("{{\Carbon\Carbon::parse($product->available_until)->format("Y/m/d")}}", function(event) {
            $(this).text(event.strftime("%D дней %H:%M:%S"));
        })
      @endforeach
    }
  </script>

@endsection 
