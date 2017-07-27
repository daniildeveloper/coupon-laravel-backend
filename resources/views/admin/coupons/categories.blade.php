@extends("admin.layouts.master")

@section("title")
Категории
@endsection

@section("content")
<div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Все категории<small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <ul>
        @foreach($cats as $cat)
          <li><i class="fa fa-{{$cat->icon}}"></i> <span>{{$cat->title}}</span></li>
        @endforeach
        </ul> 
      </div>
    </div>

    

</div>
@endsection

@section("scripts")

@endsection