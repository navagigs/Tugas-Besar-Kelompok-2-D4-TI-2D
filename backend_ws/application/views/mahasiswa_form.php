<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>MAHASISWA</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Mahasiswa Npm <?php echo form_error('mahasiswa_npm') ?></td>
            <td><input type="text" class="form-control" name="mahasiswa_npm" id="mahasiswa_npm" placeholder="Mahasiswa Npm" value="<?php echo $mahasiswa_npm; ?>" />
        </td>
	    <tr><td>Mahasiswa Nama <?php echo form_error('mahasiswa_nama') ?></td>
            <td><input type="text" class="form-control" name="mahasiswa_nama" id="mahasiswa_nama" placeholder="Mahasiswa Nama" value="<?php echo $mahasiswa_nama; ?>" />
        </td>
	    <tr><td>Mahasiswa Alamat <?php echo form_error('mahasiswa_alamat') ?></td>
            <td><textarea class="form-control" rows="3" name="mahasiswa_alamat" id="mahasiswa_alamat" placeholder="Mahasiswa Alamat"><?php echo $mahasiswa_alamat; ?></textarea>
        </td></tr>
	    <tr><td>Mahasiswa Email <?php echo form_error('mahasiswa_email') ?></td>
            <td><input type="text" class="form-control" name="mahasiswa_email" id="mahasiswa_email" placeholder="Mahasiswa Email" value="<?php echo $mahasiswa_email; ?>" />
        </td>
	    <tr><td>Mahasiswa Tlp <?php echo form_error('mahasiswa_tlp') ?></td>
            <td><input type="text" class="form-control" name="mahasiswa_tlp" id="mahasiswa_tlp" placeholder="Mahasiswa Tlp" value="<?php echo $mahasiswa_tlp; ?>" />
        </td>
	    <tr><td>Mahasiswa Agama <?php echo form_error('mahasiswa_agama') ?></td>
            <td><input type="text" class="form-control" name="mahasiswa_agama" id="mahasiswa_agama" placeholder="Mahasiswa Agama" value="<?php echo $mahasiswa_agama; ?>" />
        </td>
	    <tr><td>Kelas <?php echo form_error('kelas_id') ?></td>
        <td> <?php $this->Mahasiswa_model->combo_box("SELECT * FROM kelas", 'kelas_id', 'kelas_id', 'kelas_nama', $kelas_id);?>
        </td>
	    <input type="hidden" name="mahasiswa_id" value="<?php echo $mahasiswa_id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mahasiswa') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->