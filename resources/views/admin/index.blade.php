@extends('admin.layout.master')
@section('content')
<?php $billData=Session::get('billData');
$billData1=Session::get('billData1');
$billData2=Session::get('billData2');
$billData3=Session::get('billData3');
$billData4=Session::get('billData4');
$tong=Session::get('tong');
?>
<style>
        .highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
    max-width: 800px;
    margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
    padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
    background: #f1f7ff;
    }
</style>
  <div id="page-wrapper">
  		<h3>Trang quản lý</h3>
          <figure class="highcharts-figure">
            <div id="container" data-order="{{ $billData }}" data-order1="{{ $billData1 }}"
            data-order2="{{ $billData2 }}" data-order3="{{ $billData3 }}" data-order4="{{ $billData4 }}"></div>
          </figure>
          <figure class="highcharts-figure">
            <div id="container1"  ></div>
            
                </figure>
  </div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
  $(this).ready(function(){
   var order = $('#container').data('order');
   var listOfValue = [];
   var listOfValue1 = [];
   var listOfValue2 = [];
   var listOfValue3 = [];
   var listOfValue4 = [];
   var listOfMonth = [];
 
  
   order.forEach(function(element){
       listOfMonth.push(element.getMonth);
       listOfValue.push(element.value);
   });
   var order1 = $('#container').data('order1');
   order1.forEach(function(element){
       
       listOfValue1.push(element.value);
   });
   var order2 = $('#container').data('order2');
   order2.forEach(function(element){
       
       listOfValue2.push(element.value);
   });
   var order3 = $('#container').data('order3');
   order3.forEach(function(element){
      
       listOfValue3.push(element.value);
   });
   var order4 = $('#container').data('order4');
   order4.forEach(function(element){
      
       listOfValue4.push(element.value);
   });
  
   Highcharts.chart('container', {

       title: {
           text: 'Tổng đơn hàng theo tháng'
       },

       subtitle: {
           text: 'Tổng đơn hàng trong 5 tháng'
       },

       xAxis: {
           categories: listOfMonth,
           title: {
            text: 'Tháng'
            }
       },
       yAxis: {
            title: {
            text: 'Số đơn hàng'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        
       series: [{
        colorByPoint: true,
           type: 'line',
           name:'Số đơn hàng giao thành công',
           data: listOfValue,

       },{
           name:'Số đơn hàng đang xử lý',
          data:listOfValue1
          }
        ,{
                name:'Số đơn hàng đã xử lý',
                data:listOfValue2,}
        ,{
                name:'Số đơn hàng đang giao hàng',
                data:listOfValue3,}
        ,{
                name:'Số đơn hàng đã bị hủy',
                data:listOfValue4,}
        
        ]
   });

   var listOfValue5 = [];

   var tong =<?php echo $tong ?>;
   console.log(tong);
   

   $('#container1').highcharts( {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tổng tiền các đơn hàng giao thành công theo tháng'
        },
        subtitle: {
            text: 'Tổng tiền các đơn hàng giao thành công trong 5 tháng'
        },
        xAxis: {
            categories: listOfMonth,
            crosshair: true,
            title: {
            text: 'Tháng'
            }
        },
        yAxis: {
            min: 0,
            title: {
            text: 'Thành tiền (VND)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} VND</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
            }
        },
        series: [{
            colorByPoint: false,
            name: 'Tổng tiền đơn hàng giao thành công',
            data: tong
            
        }]
    });
responsive: {
            rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
                }
            }
            }]
        }

    });

</script>
@endsection