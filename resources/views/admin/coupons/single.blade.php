@extends('admin.layouts.master')

@section("title")
Просмотр купона | {{$coupon->title}}
@endsection

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                {{$coupon->title}}
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up">
                        </i>
                    </a>
                </li>
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="x_content">
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="product-image">
                    <img alt="{{$coupon->title}}" src="{{asset("$coupon->image")}}">
                    </img>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                <h3 class="prod_title">
                    {{$coupon->title}}
                </h3>
                <hr>
                <p>{{ App\Company::find($coupon->company_id)->seller_name }}</p>
                <p>
                    <a href="tel:{{ App\Company::find($coupon->company_id)->seller_primary_phone }}">{{ App\Company::find($coupon->company_id)->seller_primary_phone }}</a>
                </p>
                <hr>
                {!!$coupon->description!!}
                <hr>
                @if($coupon->costs === null)

                <form action="{{route("coupon-price", ["id" => $coupon->id])}}">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="price" placeholder="Плата за размещение" type="number" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Установить</button>
                            </span>
                          </div>
                    </div>
                </form>
                @else
                <p>Плата за размещение: {{ $coupon->costs }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
