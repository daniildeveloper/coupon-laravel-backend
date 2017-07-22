@extends('seller.layout')

@section('seller_content')
<div class="container">
    <div class="row row-wrap">
        <h1 class="text-center">
            Seller dashboard
        </h1>
        {{-- TODO: отчет по просмотрам купонов и покупкам. --}}

      {{-- coupons: views and byus summary --}}
        <div class="container">
          <canvas id="couponsChart" width="400" height="400"> </canvas>
        </div>
        {{-- end coupons views and buys --}}

      {{-- TODO: денег на счету --}}
      {{-- TODO: непрочитаные сообщения --}}
      {{-- TODO: новые отзывы о купонах--}}
      {{-- TODO: жалобы и претензии --}}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/Chart.bundle.min.js') }}">
</script>
<script>
    function createConfig(gridlines, title) {
            return {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: "My First dataset",
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: [10, 30, 39, 20, 25, 34, 0],
                        fill: false,
                    }, {
                        label: "My Second dataset",
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: [18, 33, 22, 19, 11, 39, 30],
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
                                max: 100,
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

      var config = createConfig(gridlines, "Все купоны");
      new Chart(ctx, config);
    }
</script>
@endsection
