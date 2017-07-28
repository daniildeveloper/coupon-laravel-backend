@extends("shop.master")

@section("title") Мои купоны @endsection

@section("content")
    <div class="container">
        <h1 class="text-center">Мои купоны</h1>


        @if(\Illuminate\Support\Facades\Session::has("cart") && \Illuminate\Support\Facades\Session::get("cart")->totalQty > 0)
            
                <div class="row">
                <div class="col-md-8">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Название</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        {{-- {{dd(\Illuminate\Support\Facades\Session::get("cart"))}} --}}
                            @foreach(\Illuminate\Support\Facades\Session::get("cart")->items as $item)

                            <tr>
                                <td class="cart-item-image">
                                    <a href="#">
                                        <img src="{{asset( $item["item"]->image)}}" style="width: 70px; height: 70px" alt="{{$item["item"]->title}}" title="{{$item["item"]->title}}" />
                                    </a>
                                </td>
                                <td>
                                    {{$item["item"]->title}}
                                </td>
                                <td class="cart-item-quantity">
                                    <a href="{{ route('cart.increment', ['id' => $item['id']]) }}">
                                        <i class="fa fa-minus cart-item-minus"></i>
                                    </a>
                                    <input type="text" name="cart-quantity" class="cart-quantity" value="{{$item["qty"]}}" />
                                    <a href="{{ route('cart.increment', ['id' => $item['id']]) }}">
                                        <i class="fa fa-plus cart-item-plus"></i>
                                    </a>
                                </td>
                                <td>{{$item["item"]->price * $item['qty']}}</td>
                                {{-- <td class="cart-item-remove">
                                    <a class="fa fa-times" href="#"></a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>    {{-- <a href="#" class="btn btn-primary">Update the cart</a> --}}
                </div>
                <div class="col-md-3">
                    <ul class="cart-total-list">
                        <li><span>Всего:</span><span>{{\Session::get("cart")->totalQty}}</span>
                        </li>
                        {{-- <li><span>Всего:</span><span>{{\Session::get("cart")->totalPrice}} тг</span>
                        </li> --}}
                    </ul>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="cart" value="{{ serialize(\Session::get('cart')) }}">
                        <button type="submit" class="btn btn-primary btn-lg">Заказать</button>
                    </form>
                </div>
            </div>
            <div class="gap"></div>
            
            {{-- <div class="container">
                <a type="button" href="{{route("checkout")}}" class="btn btn-success">Оплатить</a>
            </div> --}}
        @else
            <p>Вы не выбрали ни одного купона</p>
        @endif

    </div>

@endsection