<section class="content-header">
  <h1>
    Report
    <small>Rekap Data Perolehan Suara</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>    
    <li class="active">TPS</li>
  </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="box box-danger">
				<!-- <div class="box-header"> -->
					<!-- <button type="button" class="btn btn-primary" onclick="add_jm()"><span class="glyphicon glyphicon-plus"></span> Add</button> -->
				<!-- </div> -->
				<div class="box-body">
					<table class="table table-bordered table-hover" id="example">
						<thead>
							<tr class="active">
								<th width="1%">No</th>
								<th>No_Urut / Nama Caleg</th>
								<th>TPS</th>
								<th>Alamat TPS</th>
								<th>Suara Sah/Jumlah</th>
								<th>Presentase</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($view as $data) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->noUrut.'/'.$data->calonLegislatif ?></td>
								<td><?php echo $data->namaTps ?></td>
								<td><?php echo $data->alamat ?></td>
								<td><?php echo $data->suara_in.'/'.$data->suara_all ?></td>
								<td><?php echo $data->suara_percent.'%'?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>