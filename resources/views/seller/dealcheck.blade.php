@extends('seller.layout')

@section('seller_title')
Проверить купон по коду
@endsection

@section('seller_content')
<div class="row">
  <div class="col-md-6">
    @if(count($coupons) > 0)
      <h3>Введите код купона</h3>
      <form action="">
        <input type="number" class="form-control" placeholder="Код купона">
        <br>
        <select name="coupon_id" id="coupon id" class="form-control">
          @foreach($coupons as $coupon)
            <option value="{{ $coupon->id }}">{{ $coupon->title }}</option>
          @endforeach
        </select>
        <br>
        <button class="btn btn-success" type="submit">Проверить</button>
      </form>
    @else
      <h3>У вас еще нет купонов!</h3>
      <p><a href="#">Создать новый</a></p>
    @endif
  </div>
</div>
@endsection