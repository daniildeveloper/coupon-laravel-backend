@extends("admin.layouts.master")

@section("title")
Все купоны
@endsection

@section("content")
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Все купоны
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
                                    Название купона
                                </th>
                                <th>
                                    Preview
                                </th>
                                <th>
                                    Компания
                                </th>
                                <th>
                                    Статус
                                </th>
                                <th style="width: 20%">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                            {{-- id --}}
                                <td>
                                    {{$coupon->id}}
                                </td>
                            {{-- name --}}
                                <td>
                                    <a href="{{route("single-coupon", ["id" => $coupon->id])}}"> {{$coupon->title}} </a>
                                </td>
                                <td>
                                    <img src="{{asset("$coupon->image")}}" alt="" class="avatar">
                                </td>
                                <td>
                                    {{\App\Company::find($coupon->company_id)->name}}
                                </td>
                                <td>
                                @if($coupon->is_show != 0)
                                    <button class="btn btn-success btn-xs" type="button">
                                        опубликованно
                                    </button>
                                @else
                                <button class="btn btn-info btn-xs" type="button">
                                        Скрыто
                                    </button>
                                @endif
                                    
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="{{route("single-coupon", ["id" => $coupon->id])}}">
                                        <i class="fa fa-folder">
                                        </i>
                                        Просмотр
                                    </a>
                                    @if($coupon->is_show != 0)
                                    <a class="btn btn-danger btn-xs" href="{{ route('coupon-h', ['id' => $coupon->id]) }}">
                                        <i class="fa fa-trash-o">
                                        </i>
                                        Скрыть
                                    </a>
                                    @else
                                    <a class="btn btn-success btn-xs" href="{{ route('coupon-p', ['id' => $coupon->id]) }}">
                                        <i class="fa fa-pencil">
                                        </i>
                                        опубликовать
                                    </a>
                                    @endif
                                    {{-- TODO: delete coupons --}}
                                    {{-- <a class="btn btn-danger btn-xs" href="{{route("trash.moveTo", ["id" => $coupon->id, "table" => "coupons"])}}">
                                        <i class="fa fa-trash">
                                        </i>
                                        В корзину
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    {{$coupons->links()}}
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
