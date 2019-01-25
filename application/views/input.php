<section class="content-header">
  <h1>
    Input Data Perolehan Suara
    <!-- <small>Data Tempat Pemungutan Suara</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>    
    <li class="active">Input Suara</li>
  </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="box box-danger">
				<div class="box-header">
					<button type="button" class="btn btn-primary" onclick="add_jm()"><span class="glyphicon glyphicon-plus"></span> Input</button>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-hover" id="example">
						<thead>
							<tr class="active">
								<th>No Urut</th>
								<th>Nama Caleg</th>
								<th>Tanggal</th>
								<th>Suara Sah</th>
								<th>Jumlah Suara</th>
								<th>Presentase</th>
								<th>Foto</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($row as $data) { ?>
								<tr class="text-center">
									<td><?php echo $data->noUrut ?></td>
									<td><?php echo $data->calonLegislatif ?></td>
									<td><?php echo date('d M Y', strtotime($data->date)) ?></td>
									<td><?php echo $data->suara_in ?></td>
									<td><?php echo $data->suara_all ?></td>
									<td><?php echo $data->suara_percent.'%' ?></td>
									<td><button type="button" class="btn btn-default btn-sm" onclick="foto('<?php echo $data->file ?>')"><i class="fa fa-image"></i></button></td>
									<td><?php echo $data->keterangan ?></td>
									<td>
										<button type="button" class="btn btn-success btn-sm" onclick="edit_jm('<?php echo $data->id ?>')"><span class="glyphicon glyphicon-edit"></span></button>
        								<a href="<?php echo base_url('input/delete/'.$data->id.'/'.$data->file) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ?')"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div id="piechart"></div>
		</div>
		
	</div>
</section>

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Input Perolehan Suara</h3>
          </div>
          <div class="modal-body form">
            <?php echo form_open_multipart('input/save', array('id' => 'form','class' => 'form-horizontal')); ?>
                <div class="form-body">                  
                  <div class="form-group">
                      <label class="control-label col-md-4">No Urut/nama Caleg</label>
                      <div class="col-md-8" style="display: show;" id="c1">
                        <select name="nourut" class="form-control" style="width: 100%;" required="">
       						<option value="" selected="">Pilih</option>
       						<?php foreach ($caleg as $key) { ?>
                        	<option value="<?php echo $key->noUrut ?>"><?php echo $key->noUrut.' / '.$key->calonLegislatif; ?></option>      
                        	<?php } ?>                  	
                        </select>
                      </div>
                      <div class="col-md-8" style="display: none;" id="c2">
                        <input type="text" name="namacaleg" class="form-control" disabled="">
                      </div>
                  </div>
                   <div class="form-group">
                      <label class="control-label col-md-4">Tanggal</label>
                      <div class="col-md-8">
                        <input type="text" name="date" class="form-control" placeholder="Tanggal" id="datepicker">
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-4">Suara sah</label>
                      <div class="col-md-8">
                        <input type="number" name="sah" class="form-control" placeholder="Suara Masuk Sah" min="1">
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-4">Jumlah Pemilih</label>
                      <div class="col-md-8">
                        <input type="number" name="dari" class="form-control" placeholder="Jumlah Suara Pemilih" min="1">                      	
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-4">Foto</label>
                      <div class="col-md-8">
                        <input type="file" name="file">
                        <p class="help-block"></p>
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-4">Keterangan</label>
                      <div class="col-md-8">
                      	<textarea name="ket" class="form-control" placeholder="Keterangan"></textarea>
                      </div>
                  </div>  
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal_foto" role="dialog">
  		<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		            <h3 class="modal-title">Foto Evident</h3>
		        </div>
		        <div class="modal-body form text-center">
		          	<img src="" id="img" class="img-rounded">
		        </div>
		        <div class="modal-footer">                       
		            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        </div>
      		</div>
      	</div>
  </div>

<script>
	var save_method; 
    var table;
    var gid;
    function add_jm()
    {
      save_method = 'add';
  	  $('#c2').hide();
      $('#c1').show();
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal      
    
    }

    function edit_jm(id)
    {
      save_method = 'update';
      gid = id;
      $('#form')[0].reset(); // reset form on modals
	  //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/input/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // $('#kabkot').trigger('change');  
            if (data.file == '0') {
            	var z = ''
            }else{
            	var z = data.file
            }
          	$('#c1').hide();
          	$('#c2').show();
          	$('#form').attr('action','<?php echo base_url("input/edit/") ?>'+data.idsuara);
          	$('[name="namacaleg"]').val(data.noUrut+' / '+data.calonLegislatif);          	
          	$('[name="date"]').val(data.date);          	
          	$('[name="sah"]').val(data.suara_in);	
          	$('[name="dari"]').val(data.suara_all);	
          	$('[name="ket"]').val(data.keterangan);	
          	$('[name="nourut"]').removeAttr('required');	
          	$('.help-block').text(z);	
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Perolehan Suara'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      });

    }

    function foto(id)
    {
      $('#img').attr("src",'asset/foto/'+id);
      $('#modal_foto').modal('show'); // show bootstrap modal      
    
    }

     function save(){
      var url;      
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/tps/save')?>";          
      }else{          
          url = "<?php echo site_url('index.php/tps/edit/')?>" + gid;         
      }
	    var x = document.forms["form"]["nourut"].value;
	 	if (x == "") {
	        alert("Nama Caleg Harus Diisi");
	        return false;
	    }else{
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }
    }
</script>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Suara Masuk',     80],
          ['Oposisi',     100]
          
        ]);

        var options = {
          title: 'Presentase Perolehan Suara di TPS <?php echo $view->namaTps ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script> -->