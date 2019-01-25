<section class="content-header">
  <h1>
    Dashboard
    <small>Quick Count Legislatif System</small>
  </h1>
  <!-- <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>    
    <li class="active">Jenis Mata Pelajaran</li>
  </ol> -->
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="box box-danger">				
				<div class="box-body">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					          <!-- small box -->
					          <div class="small-box bg-aqua">
					            <div class="inner">
					              <h3><?php echo $num_profile ?></h3>
					              <p>Calon Legislatif</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-users"></i>
					            </div>
					            <a href="<?php echo base_url('profile') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					          <!-- small box -->
					          <div class="small-box bg-green">
					            <div class="inner">
					              <h3><?php echo $num_tps ?></h3>
					              <p>TPS</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-list"></i>
					            </div>
					            <a href="<?php echo base_url('tps') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					          </div>						
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							  <div class="box box-solid">
					            <div class="box-header with-border">
					              <h3 class="box-title">Calon Legislatif</h3>
		
					            </div>
					            <div class="box-body no-padding">
					              <ul class="nav nav-pills nav-stacked">
					              <?php foreach ($show as $row) { ?>					                
					                <li><a href="#" onclick="chart('<?php echo $row->noUrut ?>')"><i class="fa fa-user"></i> <?php echo $row->noUrut.' / '.$row->calonLegislatif ?></a></li>					
					            <?php } ?>
					              </ul>
					            </div>
					            <!-- /.box-body -->
					          </div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							  					          
									<div id="piechart" style="height: 400px;"></div>	            	
					          
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    // function chart() {    	     
    //   google.charts.load('current', {'packages':['corechart']});
    //   google.charts.setOnLoadCallback(drawChart);
    // }

      // function drawChart() {

      //   var data = google.visualization.arrayToDataTable([
      //     ['Task', 'Jumlah'],
      //     ['Work',     483],
      //     ['Eat',      341]          
      //   ]);

      //   var options = {
      //     title: 'Rekapituasi Suara'
      //   };
      //   var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      //   chart.draw(data, options);        
      // }
    </script>