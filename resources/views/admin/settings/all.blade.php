@extends("admin.layouts.master")

@section("title")
Настройки
@endsection

@section("content")
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                Настройки
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
            <div class="container">
              @foreach($settings as $s)
                <form class="row" action="{{route("setting.update")}}" method="GET">
                <input type="hidden" value="{{$s->id}}" name="id">
                  <div class="col-md-4"><input class=form-control type="text" disabled="true" value="{{$s->slug}}"></div>
                  <div class="col-md-4"><input class=form-control type="text" name="setup" value="{{$s->value}}" required="true"></div>
                  <div class="col-md-4"><input class="btn btn-success" type="submit" value="Изменить"></div>
                </form>
              @endforeach
            </div>
        </div>
    </div>
</div>
@endsection