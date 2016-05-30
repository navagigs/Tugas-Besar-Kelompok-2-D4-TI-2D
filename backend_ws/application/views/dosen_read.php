
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Dosen Read</h3>
        <table class="table table-bordered">
	    <tr><td>Dosen Nik</td><td><?php echo $dosen_nik; ?></td></tr>
	    <tr><td>Dosen Nama</td><td><?php echo $dosen_nama; ?></td></tr>
	    <tr><td>Dosen Matkul</td><td><?php echo $dosen_matkul; ?></td></tr>
      <tr><td>Foto</td><td><img src="<?php echo base_url()."assets/images/dosen/kecil_".$dosen_foto;?>" width="200" /></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('dosen') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->