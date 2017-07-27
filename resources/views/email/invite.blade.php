@extends("email.layout")

@section("title")
{{$title}}
@endsection

@section("content")

<table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td class="navbar navbar-inverse" align="center">
                <!-- This setup makes the nav background stretch the whole width of the screen. -->
                <table width="650px" cellspacing="0" cellpadding="3" class="container">
                    <tr class="navbar navbar-inverse">
                        <td colspan="4"><a class="brand" href="http://chiki-chiki.kz">Чики Чики</a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF" align="center">
                <table width="650px" cellspacing="0" cellpadding="3" class="container">
                    <tr>
                        <td>Увеличте поток клиентов в пару кликов </td>
                        
                        
                    </tr>
                    <tr>
                        <td>Перейдите по ссылке: <a href="http://chiki-chiki.kz/c/add">Ссылка</a></td>
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