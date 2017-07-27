@extends('seller.layout')

@section('seller_title')
Мои купоны
@endsection

@section('seller_content')
@foreach($products as $product)
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
                {{-- TODO: inline coupon edit --}}
                  <a href="{{ route('seller.coupon.edit', ['id' => $product->id]) }}" class="favorites">
                    <i class="fa fa-edit"></i>
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
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endforeach
@endsection