@extends('email.layout')

@section('content')
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td class="navbar navbar-inverse" align="center">
            <!-- This setup makes the nav background stretch the whole width of the screen. -->
            <table width="650px" cellspacing="0" cellpadding="3" class="container">
                <tr class="navbar navbar-inverse">
                    <td colspan="4"><a class="brand" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" align="center">
            <table width="650px" cellspacing="0" cellpadding="3" class="container">
                <tr>
                    <td>Владелец: {{$email}}</td>
                </tr>
                <tr>
                    Название купона: {{ $coupon->title }}
                </tr>
                <tr>
                    <td>Код купона: {{$deal->user_code}}</td>
                </tr>
                <tr>
                    <td>Ждем вас по адрессу: {{$address}}</td>
                </tr>

                <tr>
                    <td>В "{{$company}}"</td>
                </tr>

                <tr>
                    <td>Применить купон до: {{ $deal->expiration_date }}</td>
                </tr>

                <tr>
                    <td>
                        Телефоны компании: 
                        <ul>
                            @foreach($phones as $phone)
                                <li><a href="{{ 1phone }}">{{ $phone }}</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" align="center">
            <table width="650px" cellspacing="0" cellpadding="3" class="container">
                <tr>
                    <td>
                        <hr>
                        <p>Спасибо, что с нами!</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection