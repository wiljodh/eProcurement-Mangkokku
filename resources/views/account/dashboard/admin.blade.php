@extends('layout/account')

@section('content')

<div class="row">

  <div class="col-6">
        <div class="widget lazur-bg no-padding">
            <div class="p-m">
              <h1 class="m-xs">{{$tendersCount}}</h1>
              <h3 class="font-bold no-margins">Total Tenders</h3>
            </div>
        </div>
  </div>
  <div class="col-3">
        <div class="widget yellow-bg  no-padding">
            <div class="p-m">
              <h1 class="m-xs">{{$offersPendingCount}}</h1>
              <p class="font-bold no-margins">Total Pending Bids</p>
            </div>
        </div>
  </div>
  <div class="col-3">
        <div class="widget navy-bg no-padding">
            <div class="p-m">
              <h1 class="m-xs">{{$offersApprovedCount}}</h1>
              <p class="font-bold no-margins">Total Approved Bids</p>
            </div>
        </div>
  </div>
</div>
<div class="row">
    <div class="col-12">
        <canvas id="myChart" width="200" height="100"></canvas>
    </div>
</div>
  
<script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>

  <script>
  var graph=@json($graph);

  console.log(graph);

  var ctx = document.getElementById('myChart').getContext('2d');

  var myChart = new Chart(ctx, {
    type: 'line',
    data: graph,
    options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Line Chart'
      }
    }
  },
});

  </script>

@endsection
