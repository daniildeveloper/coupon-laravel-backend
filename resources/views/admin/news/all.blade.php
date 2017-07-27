@extends("admin.layouts.master")

@section("title")
Новости
@endsection

@section("content")
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Новости
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
                        Новости
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route("news.new")}}" class="btn btn-success">Добавить</a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <p>
                        Все новости
                    </p>
                    <!-- start project list -->
                    @foreach($news as $newsItem)
                        <div class="container row">
                            <div class="col-md-8">
                                {{$newsItem->title}}
                            </div>
                            <div class="col-md-2"><a href="{{route("news.edit", ["id"=>$newsItem->id])}}" class="btn btn-info">Редактировать</a></div>
                        </div>
                    @endforeach
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
