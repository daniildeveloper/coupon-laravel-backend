@extends('seller.layout')

@section('seller_content')
  <h1 class="text-center">
      Seller dashboard
  </h1>
  
  {{-- TODO: отчеты за день\месяц\год с возможностью выбора --}}
  {{-- TODO: возмоность просматривать простые добавления в корзину и в избранное--}}
  {{-- coupons: views and byus summary --}}
  <canvas id="couponsChart" width="400" height="200"> </canvas>
  {{-- end coupons views and buys --}}

  {{-- TODO: денег на счету --}}
  {{-- TODO: непрочитаные сообщения --}}
  {{-- TODO: новые отзывы о купонах--}}
  {{-- TODO: жалобы и претензии --}}
@endsection

@section('scripts')
<script src="{{ asset('js/Chart.bundle.min.js') }}">
</script>
<script>
    var chartColors = {
      red: '#FF6384',
      blue: '#9AD0F4'
    }
    function createConfig(gridlines, title) {
            return {
                type: 'line',
                data: {
                    labels: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
                    datasets: [{
                        label: "Просмотры",
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: [20, 30, 39, 20, 25, 34, 20],
                        fill: false,
                    }, {
                        label: "Покупки",
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: [18/2, 33/2, 22/2, 19/2, 11/2, 39/2, 30/2],
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display: true,
                        text: title
                    },
                    scales: {
                        xAxes: [{
                            gridLines: gridlines
                        }],
                        yAxes: [{
                            gridLines: gridlines,
                            ticks: {
                                min: 0,
                                max: 50,
                                stepSize: 10
                            }
                        }]
                    }
                }
            };
        }

    window.onload = function () {
      var canvas = document.getElementById('couponsChart');
      var ctx = canvas.getContext('2d');

      var gridLines = {
        display: true
      };

      var config = createConfig(gridLines, "Все купоны");
      new Chart(ctx, config);
    }
</script>
@endsection
