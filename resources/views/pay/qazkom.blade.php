@extends('layouts.app')

@section("title")
Оплата заказа #{{ $orderId }}
@endsection

@section('content')
<form name="SendOrder" method="post" action="https://testpay.kkb.kz/jsp/process/logon.jsp">
   <input type="hidden" name="Signed_Order_B64" value="{{$xml}}">
   <p>
   <input type="hidden" name="Language" value="eng">
   <input type="hidden" name="BackLink" value="http://epay.mil/return.php">
   <input type="hidden" name="PostLink" value="http://epay.mil/return.php">
   <input type="submit" name="GotoPay"  value="Оплатить" >
</form>
@endsection