
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>KELAS LIST <?php echo anchor('kelas/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('kelas/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('kelas/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('kelas/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Kelas Nama</th>
		    <th>Kelas Icon</th>
		    <th>Kelas Warna</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($kelas_data as $kelas)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $kelas->kelas_nama ?></td>
		    <td><?php echo $kelas->kelas_icon ?></td>
		    <td><?php echo $kelas->kelas_warna ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('kelas/read/'.$kelas->kelas_id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('kelas/update/'.$kelas->kelas_id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('kelas/delete/'.$kelas->kelas_id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->