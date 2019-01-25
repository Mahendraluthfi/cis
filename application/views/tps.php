<section class="content-header">
  <h1>
    TPS
    <small>Data Tempat Pemungutan Suara</small>
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
				<div class="box-header">
					<button type="button" class="btn btn-primary" onclick="add_jm()"><span class="glyphicon glyphicon-plus"></span> Add</button>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-hover" id="example">
						<thead>
							<tr class="active">
								<th width="1%">No</th>
								<th>User Tps</th>
								<th>Nama Tps</th>
								<th>Alamat</th>
								<th>Penanggung Jawab</th>
								<th>Kontak</th>								
								<th>Aksi</th>								
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;	
							foreach ($row as $data) { ?>
                <tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->userTps ?></td>
								<td><?php echo $data->namaTps ?></td>
								<td><?php echo $data->alamat ?></td>
								<td><?php echo $data->namaPic ?></td>
								<td><?php echo $data->contactPic ?></td>
								<td>
                  <button type="button" class="btn btn-success btn-sm" onclick="edit_jm('<?php echo $data->userTps ?>')"><span class="glyphicon glyphicon-edit"></span></button>
        					<a href="<?php echo base_url('tps/delete/'.$data->userTps) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ?')"><span class="glyphicon glyphicon-trash"></span></a>
                  <a href="<?php echo base_url('tps/reset/'.$data->userTps) ?>" class="btn btn-warning btn-sm" onclick="return confirm('Reset Password ?')"><span class="fa fa-key"></span></a>
								</td>
              </tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Add Data TPS</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <div class="form-body">                  
                  <div class="form-group">
                      <label class="control-label col-md-3">Username TPS</label>
                      <div class="col-md-9">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Nama TPS</label>
                      <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama">                      
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-3">Alamat TPS</label>
                      <div class="col-md-9">
                      	<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-3">Penanggung Jawab</label>
                      <div class="col-md-9">
                        <input type="text" name="pic" class="form-control" placeholder="Nama Penanggung Jawab">                        
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-3">Nomor HP</label>
                      <div class="col-md-9">
                        <input type="text" name="hp" class="form-control" placeholder="Nomor Handphone">                        
                      </div>
                  </div>  
                   <div class="form-group">
                      <label class="control-label col-md-3"></label>
                      <div class="col-md-9">
                        <p class="form-control-static">*Password set default same as username</p>
                      </div>
                  </div>            
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

<script>
    var save_method; 
    var table;
    var gid;
    function add_jm()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal      

    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
    function edit_jm(id)
    {
      save_method = 'update';
      gid = id;
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/tps/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // $('#kabkot').trigger('change');  
            $('[name="username"]').val(data.userTps);
            $('[name="username"]').attr("disabled","disabled");
            $('[name="nama"]').val(data.namaTps);
            $('[name="alamat"]').val(data.alamat);
            $('[name="pic"]').val(data.namaPic);
            $('[name="hp"]').val(data.contactPic);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data TPS'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      });

    }
    function save(){
      var url;      
      if(save_method == 'add'){
          url = "<?php echo site_url('index.php/tps/save')?>";          
      }else{          
          url = "<?php echo site_url('index.php/tps/edit/')?>" + gid;         
      }
    var x = document.forms["form"]["username"].value;
 	if (x == "") {
        alert("Username Harus Diisi");
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