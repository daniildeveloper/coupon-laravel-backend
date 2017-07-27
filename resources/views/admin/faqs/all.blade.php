@extends("admin.layouts.master")

@section("title")
Вопрос-ответ
@endsection

@section("content")
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Вопрос-ответ
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
                        Вопросы
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route("faq.new")}}" class="btn btn-success">Добавить</a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <p>
                        Все вопросы
                    </p>
                    <!-- start project list -->
                    @foreach($faqs as $faq)
                        <div class="container row">
                            <div class="col-md-8">
                                {{$faq->quest}}
                            </div>
                            <div class="col-md-4">
                                <a href="{{route("faq.edit", ["id"=>$faq->id])}}" class="btn btn-info">Редактировать</a>
                                <a href="{{route("faq.toggle", ["id" => $faq->id])}}" class="brn btn-default">
                                    @if($faq->show_in_footer === 0)
                                        Опубликовать
                                    @else
                                        Убрать
                                    @endif
                                </a>
                            </div>
                            {{-- div. --}}
                        </div>
                    @endforeach
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
