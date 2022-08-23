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
            // var options = {
            //     title: 'Keterangan : 1 = Tshirt 2 = Crewneck'
            // };
            var options = {
                backgroundColor: '',
                'title': 'Keterangan : 1 = Tshirt 2 = Crewneck',
                border: '1px solid'


            };
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            chart.draw(data, options);
        }
    </script>
</head>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Data Produk</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="/dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Data Produk</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="ml-auto mr-auto ">
                                <h3 class="panel-title   ">Persentase Produk pada Toko</h3>
                            </div>
                            <div class="panel-body" align="left">

                                <div id="pie_chart" class="text-center" style="height:350px">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection