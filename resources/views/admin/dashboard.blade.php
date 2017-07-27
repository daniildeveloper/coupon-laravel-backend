@extends("admin.layouts.master")

@section("title")
Панель управления
@endsection

@section("content")
<!-- top tiles -->
<div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top">
            <i class="fa fa-user">
            </i>
            Пользователей всего
        </span>
        <div class="count">
            {{$usersTotal}}
        </div>
        <span class="count_bottom">
            <i class="green">
                {{$usersToday}}
            </i>
            за сегодня
        </span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top">
            <i class="fa fa-clock-o">
            </i>
            Активных купонов
        </span>
        <div class="count">
            {{$couponsActive}}
        </div>
        <span class="count_bottom">
            <i class="green">
                <i class="fa fa-sort-asc">
                </i>
                {{$couponsTotal}}
            </i>
            купонов всего
        </span>
    </div>
    {{-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top">
            <i class="fa fa-clock-o">
            </i>
            Доход
        </span>
        <div class="count">
            0 тг
        </div>
        <span class="count_bottom">
            <i class="green">
                <i class="fa fa-sort-asc">
                </i>
                
            </i>
            от 0 платежей
        </span>
    </div> --}}
    {{-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top">
            <i class="fa fa-eye">
            </i>
            Просмотров
        </span>
        <div class="count">
            {{$viewsTotal}}
        </div>
        <span class="count_bottom">
            <i class="green">
                <i class="fa fa-sort-asc">
                </i>
            </i>
            {{$viewsToday}} за сегодня
        </span>
    </div> --}}
</div>
<br/>
<div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <h2>
                    Посещения (See ideas)
                </h2>
                <div class="clearfix">
                </div>
            </div>
            <div class="x_content">
                <table class="" style="width:100%">
                    <tr>
                        <th style="width:37%;">
                            <p>
                                Все
                            </p>
                        </th>
                        <th>
                            {{-- <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <p class="">
                                    Device
                                </p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <p class="">
                                    Progress
                                </p>
                            </div> --}}
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <canvas class="canvasDoughnut" height="140" style="margin: 15px 10px 10px 0" width="140">
                            </canvas>
                        </td>
                        <td>
                            <table class="tile_info">
                                <tr>
                                    <td>
                                        <p>
                                            <i class="fa fa-square blue">
                                            </i>
                                            IOS
                                        </p>
                                    </td>
                                    <td>
                                        30%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>
                                            <i class="fa fa-square green">
                                            </i>
                                            Android
                                        </p>
                                    </td>
                                    <td>
                                        50%
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>
                                            <i class="fa fa-square purple">
                                            </i>
                                            Веб
                                        </p>
                                    </td>
                                    <td>
                                        20%
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    {{-- PAYMENTS WIDGET --}}
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    Платежи
                    <small>
                        10 последних
                    </small>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Человек
                            </th>
                            <th>
                                Платеж
                            </th>
                            <th>
                                Дата
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            {{-- @foreach($payments as $payment)
                            <tr>
                                <th scope="row">
                                    {{$payment->id}}
                                </th>
                                <td>
                                    {{\App\User::find($payment->user_id)->name}}
                                </td>
                                <td>
                                    {{$payment->payment}}
                                </td>
                                <td>
                                    {{$payment->created_at}}
                                </td>
                            </tr>
                            @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    Быстрые отчеты
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
                
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
    <script>
        function init_chart_doughnut(){
                
        if( typeof (Chart) === 'undefined'){ return; }
        
        console.log('init_chart_doughnut');
     
        if ($('.canvasDoughnut').length){
            
        var chart_doughnut_settings = {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Web",
                        "Android",
                        "IOS"
                    ],
                    datasets: [{
                        data: [ 20, 50, 30],
                        backgroundColor: [
                            "#9B59B6",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#B370CF",
                        ]
                    }]
                },
                options: { 
                    legend: false, 
                    responsive: false 
                }
            }
        
            $('.canvasDoughnut').each(function(){
                
                var chart_element = $(this);
                var chart_doughnut = new Chart( chart_element, chart_doughnut_settings);
                
            });         
        
        }  
       
    }
    </script>
@endsection