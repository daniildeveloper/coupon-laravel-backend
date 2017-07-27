@extends('layouts.app')

@section("title")
Оплата заказа #{{ $orderId }}
@endsection

@section('content')
<form  class="col-md-4 col-md-offset-2" name="SendOrder" method="post" action="https://testpay.kkb.kz/jsp/process/logon.jsp">

   <input type="hidden" name="Signed_Order_B64" value="{{$xml}}">
   <div class="form-group">
     <label for="#email" class="col-xs-12">E-mail: </label>
     <input type="text" name="email" size=50 maxlength=50  class="form-control">
   </div>
   
   <input type="hidden" name="Language" value="rus"> <!-- язык формы оплаты rus/eng -->
   <input type="hidden" name="BackLink" value="{{ route('seller.dashboard') }}">
   <input type="hidden" name="PostLink" value="http://www.pl.tes.kz/post_link.php">
   <p>
     Со счетом согласен (-а)
   </p>
   <input type="submit" name="GotoPay"  value="Да, перейти к оплате" class="btn btn-success" >&nbsp;
</form>
@endsection