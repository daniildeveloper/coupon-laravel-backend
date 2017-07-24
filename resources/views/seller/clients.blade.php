@extends('seller.layout')

@section('seller_title')
Мои клиенты
@endsection

@section('seller_content')
  <table class="table table-striped">
    <thead>
      <tr>
        <td>Имя</td>
        <td>Последняя покупка</td>
        <td>Покупок всего</td>
        <td>На общую сумму</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      @foreach($clients as $client)
        <tr>
          <td>{{ App\User::find($client->user_id)->name }}</td>
          <td>{{ App\Coupons::find($client->last_buyed_item_id) }}</td>
          <td>{{ $client->buys_count }}</td>
          <td>{{ $client->buys_total }}</td>
          <td>
            <!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Полюбить <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                {{-- TODO: пригласить в акцию --}}
                <li><a href="#">Пригласить в акцию</a></li>
                {{-- TODO: Спецтиальное предложение --}}
                <li><a href="#">Специальное предложение</a></li>
                <li role="separator" class="divider"></li>
                {{-- TODO: make gift --}}
                <li><a href="#">Сделать подарок</a></li>
              </ul>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection