@extends ("layouts.app")

@section("title")Оплата @endsection

@section("content")
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1 class="text-center">Оплатить</h1>
            <h3>Сумма к оплате: {{$sum}}</h3>
            <p>Номер счета: {{$order_id}}</p>

            <p><a href="#">Перейти к оплате банковской картой</a></p>
        </div>
    </div>
@endsection