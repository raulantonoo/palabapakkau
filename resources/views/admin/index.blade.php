@extends('layouts_admin.app')

@section('content')

<head>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script type="text/javascript">
        var analytics = <?php echo $category_id; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                backgroundColor: '',
                'title': 'Keterangan : 1 = Tshirt 2 = Crewneck',
                border: '1px solid'
            };
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        var analytics2 = <?php echo $data1; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data1 = google.visualization.arrayToDataTable(analytics2);
            // var options = {
            //     title: 'Keterangan : 1 = Tshirt 2 = Crewneck'
            // };
            var options1 = {
                'title': 'Data Produk Terjual',
                border: '1px solid',
                width: 900,
                height: 400,
                colors: ['#7ec4cf'],
                opacity: ['0.2'],
                stroke: ['black '],
                bar: {
                    groupWidth: "80%",
                    width: 60
                },

            };
            var chart1 = new google.visualization.ColumnChart(document.getElementById('blog_chart'));
            chart1.draw(data1, options1);
        }
    </script>
    <script type="text/javascript">
        var analytics1 = <?php echo $data2; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data2 = google.visualization.arrayToDataTable(analytics1);
            // var options = {
            //     title: 'Keterangan : 1 = Tshirt 2 = Crewneck'
            // };
            var options2 = {
                'title': 'Data Hasil Penjualan',
                border: '1px solid',
                width: 900,
                height: 400,
                colors: ['#7ec4cf'],
                opacity: ['0.2'],
                stroke: ['black '],
                bar: {
                    groupWidth: "80%",
                    width: 60
                },

            };
            var chart2 = new google.visualization.LineChart(document.getElementById('column_chart'));
            chart2.draw(data2, options2);
        }
    </script>
</head>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">

                <div class="page-header-content header-elements-md-inline" style="background-color:#e9ecef">
                    <div class="page-title d-flex" style="padding-top:1% !important;padding-bottom:1% !important">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span></h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="/dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-lg-12">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="ml-auto mr-auto ">
                                    <h3 class="panel-title mt-3 ">Persentase Produk pada Toko</h3>
                                </div>
                                <div class="panel-body row" align="left">
                                    <div class="col-md-6">
                                        <div id="pie_chart" style="height:350px">
                                        </div>
                                    </div>


                                    <div class="col-md-5 mt-5">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Jumlah Tshirt</td>
                                                    <td>:</td>
                                                    <td>{{$tshirt}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Crewneck</td>
                                                    <td>:</td>
                                                    <td>{{$crwnk}} </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Total Produk</b></td>
                                                    <td><b>:</b></td>
                                                    <td><b>{{$jml}}</b></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>


                        <div id="blog_chart" class="text-center" style="height:350px">
                        </div>
                        <div id="column_chart" class="text-center" style="height:350px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection