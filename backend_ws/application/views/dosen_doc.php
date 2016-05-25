<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Dosen List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Dosen Nik</th>
		<th>Dosen Nama</th>
		<th>Dosen Matkul</th>
		
            </tr><?php
            foreach ($dosen_data as $dosen)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $dosen->dosen_nik ?></td>
		      <td><?php echo $dosen->dosen_nama ?></td>
		      <td><?php echo $dosen->dosen_matkul ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>