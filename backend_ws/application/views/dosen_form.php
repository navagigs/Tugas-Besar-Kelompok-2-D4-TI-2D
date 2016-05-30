<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>DOSEN</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"><table class='table table-bordered'>
	    <tr><td>Dosen Nik <?php echo form_error('dosen_nik') ?></td>
            <td><input type="text" class="form-control" name="dosen_nik" id="dosen_nik" placeholder="Dosen Nik" value="<?php echo $dosen_nik; ?>" />
        </td>
	    <tr><td>Dosen Nama <?php echo form_error('dosen_nama') ?></td>
            <td><input type="text" class="form-control" name="dosen_nama" id="dosen_nama" placeholder="Dosen Nama" value="<?php echo $dosen_nama; ?>" />
        </td>
	    <tr><td>Dosen Matkul <?php echo form_error('dosen_matkul') ?></td>
            <td><input type="text" class="form-control" name="dosen_matkul" id="dosen_matkul" placeholder="Dosen Matkul" value="<?php echo $dosen_matkul; ?>" />
        </td>
        <?php if ($dosen_foto){?>
      <tr><td></td>
            <td><img src="<?php echo base_url()."assets/images/dosen/kecil_".$dosen_foto;?>" width="200" />
        </td>
      <tr><td>Foto <?php echo form_error('dosen_foto') ?></td>
            <td><input type="file" required class="form-control btn-sm input-sm" name="dosen_foto" id="dosen_foto"  />
        </td>
      <?php } else {?>
      <tr><td>Foto <?php echo form_error('dosen_foto') ?></td>
            <td><input type="file" required class="form-control btn-sm input-sm" name="dosen_foto" id="dosen_foto"  />
        </td>
        <?php } ?>
	    <input type="hidden" name="dosen_id" value="<?php echo $dosen_id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dosen') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->