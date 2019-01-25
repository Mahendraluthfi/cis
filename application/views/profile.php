<section class="content-header">
  <h1>
    Profile
    <small>Data Calon Kepala/Wakil Kepala Daerah</small>
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
				<div class="box-header">
					<button type="button" class="btn btn-primary" onclick="add_jm()"><span class="glyphicon glyphicon-plus"></span> Add</button>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-hover" id="example">
						<thead>
							<tr class="active">
								<th>No_Urut</th>
								<th>Kabupaten/Kota</th>
								<th>Nama Calon Legislatif</th>
								<th>Aksi</th>								
							</tr>
						</thead>
						<tbody>
              <?php foreach ($show as $data) { ?>
							<tr>
                <td><?php echo $data->noUrut ?></td>
                <td><?php echo $data->nama_kabkot ?></td>
								<td><?php echo $data->calonLegislatif ?></td>								
                <td>
                  <button type="button" class="btn btn-success btn-sm" onclick="edit_jm('<?php echo $data->noUrut ?>')"><span class="glyphicon glyphicon-edit"></span></button>
                  <a href="<?php echo base_url('profile/delete/'.$data->noUrut) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ?')"><span class="glyphicon glyphicon-trash"></span></a>
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
            <h3 class="modal-title">Add Data Calon Legislatif</h3>
          </div>
          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <div class="form-body">                  
                  <div class="form-group">
                      <label class="control-label col-md-3">No Urut</label>
                      <div class="col-md-9">
                        <input type="number" name="nourut" min="1" class="form-control" placeholder="Nomor Urut Caleg">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Provinsi</label>
                      <div class="col-md-9">
                        <select name="prov" class="form-control" style="width: 100%;" required="" id="prov">
                          <option value="0" selected="">--Pilih--</option>
                        <?php foreach ($prov as $dprov) { ?>                          
                            <option value="<?php echo $dprov->id_prov ?>"><?php echo $dprov->nama_prov ?></option>
                        <?php } ?>
                        </select>
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-3">Kab/Kot</label>
                      <div class="col-md-9">
                        <select name="kabkot" class="form-control" id="kabkot" required="" style="width: 100%;">
                            <option value="">-- Pilih --</option>              
                        </select>
                      </div>
                  </div>            
                  <div class="form-group">
                      <label class="control-label col-md-3">Calon Legislatif</label>
                      <div class="col-md-9">
                        <input type="text" name="caleg" placeholder="Nama Calon Legislatif" class="form-control">
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
    var save_method; //for save method string
    var table;
    var gid;
    function add_jm()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#prov').val('0');             
      $('#prov').trigger('change')
      $('#kabkot').val('0');             
      $('#kabkot').trigger('change')

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
        url : "<?php echo site_url('index.php/profile/get')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nourut"]').val(data.noUrut);   
            $('[name="nourut"]').attr('disabled','disabled');               
            $('[name="caleg"]').val(data.calonLegislatif);               
            $('#prov').val(data.id_prov);             
            $('#prov').trigger('change');
            var id = data.id_prov;
            $.ajax({
                url : "<?php echo base_url();?>index.php/profile/get_kabkot",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data1){
                  var html = '';
                  var i;    
                  var a;                                
                  for(i=0; i<data1.length; i++){
                      if (data1[i].id_kabkot == data.idKab) {
                        a = ' selected="selected"';
                      }else{
                        a = '';
                      }
                      html += '<option value="'+data1[i].id_kabkot+'"'+a+'>'+data1[i].nama_kabkot+'</option>';
                  }
                  $('#kabkot').val(data.idKab);             
                  $('#kabkot').trigger('change');                  
                  $('#kabkot').html(html);                      
                  // $('#kabkot').trigger('change');                        
                }
              });
            // $('#kabkot').trigger('change');            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Calon Legislatif'); // Set title to Bootstrap modal title

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
          url = "<?php echo site_url('index.php/profile/save')?>";          
      }else{          
          url = "<?php echo site_url('index.php/profile/edit/')?>" + gid;         
      }

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

  $(document).ready(function(){
      $('#prov').change(function(){
      var id=$(this).val();
        $.ajax({
        url : "<?php echo base_url();?>index.php/profile/get_kabkot",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          html += '<option value="0">-- Pilih --</option>';                    
          for(i=0; i<data.length; i++){
              html += '<option value="'+data[i].id_kabkot+'">'+data[i].nama_kabkot+'</option>';
          }
          $('#kabkot').html(html);                      
          // $('#kabkot').trigger('change');                        
        }
      });
    });
  });

    </script>