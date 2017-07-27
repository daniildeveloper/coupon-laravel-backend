@extends("admin.layouts.master")

@section("title")
Корзина
@endsection

@section("content")
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Корзина
                <small>
                    список
                </small>
            </h3>
        </div>
        {{-- <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input class="form-control" placeholder="Search for..." type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                Go!
                            </button>
                        </span>
                    </input>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Корзина
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <p>
                        Корзина
                    </p>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 20%">
                                    Таблица
                                </th>
                                <th>
                                    Пользователь
                                </th>
                                <th>
                                    Ид в таблице
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($trash as $t)
                            <tr>
                            {{-- id --}}
                                <td>
                                    {{$t->id}}
                                </td>
                            {{-- name --}}
                                <td>
                                    {{$t->table}}
                                </td>
                                <td>
                                    {{App\User::find($t->user_id)->name}}
                                </td>
                                <td>
                                    {{unserialize($t->object)->id}}
                                </td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="{{route("trash.restore", ["id" => $t->id])}}">
                                        <i class="fa fa-folder">
                                        </i>
                                        Восстановить
                                    </a>

                                    <a class="btn btn-danger btn-xs" href="{{route("trash.delete", ["id" => $t->id])}}">
                                        <i class="fa fa-folder">
                                        </i>
                                        Удалить навсегда
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
