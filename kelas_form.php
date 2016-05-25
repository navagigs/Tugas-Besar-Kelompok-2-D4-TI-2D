<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>KELAS</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Kelas Nama <?php echo form_error('kelas_nama') ?></td>
            <td><input type="text" class="form-control" name="kelas_nama" id="kelas_nama" placeholder="Kelas Nama" value="<?php echo $kelas_nama; ?>" />
        </td>
	    <tr><td>Kelas Icon <?php echo form_error('kelas_icon') ?></td>
            <td><input type="text" class="form-control" name="kelas_icon" id="kelas_icon" placeholder="Kelas Icon" value="<?php echo $kelas_icon; ?>" />
        </td>
	    <tr><td>Kelas Warna <?php echo form_error('kelas_warna') ?></td>
            <td><input type="text" class="form-control" name="kelas_warna" id="kelas_warna" placeholder="Kelas Warna" value="<?php echo $kelas_warna; ?>" />
        </td>
	    <input type="hidden" name="kelas_id" value="<?php echo $kelas_id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kelas') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->