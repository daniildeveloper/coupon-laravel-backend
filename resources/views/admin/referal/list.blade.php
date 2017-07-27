@extends("admin.layouts.master")

@section("title")
Все рефералы
@endsection

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                Все рефералы
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Человек
                        </th>
                        <th>
                            Пригласивший
                        </th>
                        <th>
                            Дата регистрации
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if(count($refs) > 0)
                    @foreach($refs as $r)
                    <tr>
                        <th scope="row">
                            {{\App\User::findOne($r->user_id)->name}}(#{{$r->user_id}})
                        </th>
                        <td>
                            {{\App\User::findOne($r->parent_id)->name}}(#{{$r->parent_id}})
                        </td>
                        <td>
                            Otto
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    @endforeach
                @else
                <p>Что то слабо людей приглашаем. Надо лучше.</p>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
