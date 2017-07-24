@extends('seller.layout')

@section('seller_title')
  Мои счета
@endsection

@section('seller_content')
  <table class="table table-striped">
    <thead>
      <tr>
        <td>Номер счета</td>
        <td>Статус счета</td>
        <td>Сумма</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ \App\Model\OrderStatus::find($order->status)->name }}</td>
          <td>{{ $order->total }}</td>
          <td>
            @if($order->status === 1)
              {{-- TODO: checkout route --}}
              <a href="" class="btn btn-success">Оплатить</a>
            @else
              Оплачен
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection