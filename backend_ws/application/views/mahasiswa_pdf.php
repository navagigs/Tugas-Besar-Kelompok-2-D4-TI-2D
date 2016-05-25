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
        <h2>Mahasiswa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        		<th>Mahasiswa Npm</th>
        		<th>Mahasiswa Nama</th>
        		<th>Mahasiswa Alamat</th>
        		<th>Mahasiswa Email</th>
        		<th>Mahasiswa Tlp</th>
        		<th>Mahasiswa Agama</th>
        		<th>Kelas Id</th>
            </tr>
            <?php foreach ($mahasiswa_data as $mahasiswa) { ?>
                <tr>
    		      <td><?php echo ++$start ?></td>
    		      <td><?php echo $mahasiswa->mahasiswa_npm ?></td>
    		      <td><?php echo $mahasiswa->mahasiswa_nama ?></td>
    		      <td><?php echo $mahasiswa->mahasiswa_alamat ?></td>
    		      <td><?php echo $mahasiswa->mahasiswa_email ?></td>
    		      <td><?php echo $mahasiswa->mahasiswa_tlp ?></td>
    		      <td><?php echo $mahasiswa->mahasiswa_agama ?></td>
    		      <td><?php echo $mahasiswa->kelas_id ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>