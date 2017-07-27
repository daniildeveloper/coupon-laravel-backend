@extends("admin.layouts.master")

@section("title")
Все компании
@endsection

@section("content")
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Все компании
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
                        Купоны
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
                        Все купоны
                    </p>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 20%">
                                    Название компании
                                </th>
                                <th>
                                    Адрес
                                </th>
                                <th>
                                    Телефон
                                </th>
                                <th>
                                    Количество {{-- активных --}} купонов
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $companie)
                        
                            <tr>
                                <td>
                                {{$companie->id}}
                                </td>
                                <td>
                                    {{$companie->name}}
                                </td>
                                <td>
                                    {{$companie->city}}, {{$companie->address}}
                                </td>
                                <td>
                                    {{$companie->phone}}
                                </td>
                                <td>
                                    {{count(\Illuminate\Support\Facades\DB::table("coupons")->where('company_id', $companie->id)->get())}}
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{url("backend/company/$companie->id")}}">Посмотреть</a>
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
