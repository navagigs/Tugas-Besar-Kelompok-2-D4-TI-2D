
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>MAHASISWA LIST <?php echo anchor('mahasiswa/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('mahasiswa/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('mahasiswa/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('mahasiswa/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Mahasiswa Npm</th>
		    <th>Mahasiswa Nama</th>
		    <th>Mahasiswa Alamat</th>
		    <th>Mahasiswa Email</th>
		    <th>Mahasiswa Tlp</th>
		    <th>Mahasiswa Agama</th>
		    <th>Kelas</th>
		    <th>Action</th>
                </tr>
            </thead>
	    