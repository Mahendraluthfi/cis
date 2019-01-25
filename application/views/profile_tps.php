<section class="content-header">
  <h1>
    Profile TPS
    <!-- <small>Data Calon Kepala/Wakil Kepala Daerah</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>    
    <li class="active">Profile</li>
  </ol>
</section>

<section class="content">
          	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="box box-danger">
				<div class="box-header"></div>
				<div class="box-body">
		          <div class="info-box bg-aqua" style="height: 100px;">
		            <span class="info-box-icon" style="height: 100px;"><i class="fa fa-dropbox"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text pull-right"><button type="button" class="btn btn-danger btn-sm" onclick="edit_jm('<?php echo $view->userTps ?>')"><i class="fa fa-edit"></i> Edit</button></span>		
		              <span class="info-box-number"><?php echo $view->namaTps; ?></span>		        
	                  <span class="progress-description"><?php echo $view->alamat ?></span>
		              <span class="info-box-text"><?php echo $view->namaPic ?></span>
		              <span class="info-box-text"><?php echo $view->contactPic ?></span>		              		             
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
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
    var gid;

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
      url = "<?php echo site_url('index.php/tps/edit/')?>" + gid;                     
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
    
</script>