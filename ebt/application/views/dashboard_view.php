<?php include('header_view.php');?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<form>
  <?php echo validation_errors(); ?>
  <!-- rest of form... -->
</form>

<script type="text/javascript">
  
$(function () { 
  
    var data_booking = <?php echo $booking; ?>;
  
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Yearly Website Ratio'
        },
        xAxis: {
            categories: ['jan','feb','mar', 'apr','may','jun','jul','aug','sep','oct','nov','dev']
        },
        yAxis: {
            title: {
                text: 'Month'
            }
        },
        series: [{
            name: 'Booking',
            data: data_booking
        }]
    });
});
  
</script>
  
<div class="container">
	<br/>
	<h2 class="text-center">Codeigniter 3 - Highcharts mysql json example</h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard - ItSolutionStuff.com</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer_view.php');?>
