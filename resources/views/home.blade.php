@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Grafik Absensi Keseluruhan</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart" style="height:230px; min-height:386px"></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- AREA CHART -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Data Statistik Bulanan</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var rgb = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };

    var rgba = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgba(" + r + "," + g + "," + b + ", 0.2)";
    };


    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
        labels: ['Ontime', 'Telat'],
        datasets: [{
            data: [`{{ $ontime }}`, `{{ $telat }}`],
            backgroundColor: [rgb(), rgb()],
        }]
    }

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })


    var labels = <?php echo json_encode($labels); ?>;
        var dataTelat = <?php echo json_encode($dataTelat); ?>;
        var dataOntime = <?php echo json_encode($dataOntime); ?>;

    var data = {
        labels: labels,
        datasets: [{
            label: "Ontime",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 2,
            data: dataOntime,
        },
        {
            label: "Telat",
            backgroundColor: rgba(),
            borderColor: rgba(),
            borderWidth: 2,
            data: dataTelat,
        },
    ]
    };

    // Opsi konfigurasi grafik area
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Membuat grafik area
    var areaChartCanvas = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(areaChartCanvas, {
        type: 'line',
        data: data,
        options: options
    });
</script>
@stop
