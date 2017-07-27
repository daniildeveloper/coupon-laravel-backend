@extends("admin.layouts.master")

@section("title")
Вопрос-ответ
@endsection

@section("content")
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Список категорий купонов
                
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
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Категории купонов
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
                    <p>
                        Все категории купонов
                    </p>
                    <!-- start project list -->
                    <div class="container">
                    @foreach($cats as $c)
                        <form action="{{route("categories.update", ["id" => $c->id])}}">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="fa fa-{{$c->icon}}"></i>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" value="{{$c->name}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success">Изменить</button>
                                </div>
                            </div>
                            
                        </form>
                    @endforeach
                    </div>
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
