@extends("admin.layouts.master")

@section("title")
Настройки платежей
@endsection

@section("content")
<div class="row">
	

<div class="col-md-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                Фиксированная цена
                <small>
                    цены за размещение
                </small>
            </h2>
            <div class="clearfix">
            </div>
        </div>
        <div class="x_content">
            <br>
                <form class="form-horizontal form-label-left" method="POST" action="{{route("pay-change")}}" >
                {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Цена за месяц
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="pro_month" class="form-control" placeholder="" type="number" value="{{$pro_month}}">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Цена за 3 месяца
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="pro_3_month" class="form-control" placeholder="Disabled Input" value="{{$pro_3_month}}" type="number">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                           Цена за полгода 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="pro_6_month" class="form-control" value="{{$pro_6_month}}"  type="text">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                           Цена за выделение
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="to_top" class="form-control" value="{{$to_top}}"  type="text">
                            </input>
                        </div>
                    </div>
                    <button class="btn btn-success">Изменить</button>
                </form>
            </br>
        </div>
    </div>
</div>
</div>
@endsection
