<?php if(url(1) == ""){

    $files_image = glob('../img/soal/*');
    $files_excel = glob('xlsx/excel/*');

    function jumlah($a){
        global $conn;
        return mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_".$a));
    }
    function jumlah_kelas($a){
        global $conn;
        $jumlah = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_siswa WHERE kelas IN
                    (SELECT id_kelas FROM tb_kelas WHERE tingkat = '$a')"));
        return $jumlah;
    }
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Pengaturan</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Pengaturan</h1>
	</div>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-blue">
            <div class="panel-heading dark-overlay">Naik Kelas</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading dark-overlay">
                                Kelas X
                            </div>
                            <div class="panel-body">
                                <h4 class="text-center">Jumlah Siswa Kelas X : <?=jumlah_kelas('X');?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading dark-overlay">
                                Kelas XI
                            </div>
                            <div class="panel-body">
                                <h4 class="text-center">Jumlah Siswa Kelas XI : <?=jumlah_kelas('XI');?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading dark-overlay">
                                Kelas XII
                            </div>
                            <div class="panel-body">
                                <h4 class="text-center">Jumlah Siswa Kelas XII : <?=jumlah_kelas('XII');?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a class="btn btn-warning btn-lg btn-block" href="<?=baseURL("pengaturan/naik_kelas");?>">Klik Disini untuk Naik Kelas </a>
                    </div>
                </div><!--/.row-->	
            </div>
        </div>
    </div><!--/.col-->
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-red">
            <div class="panel-heading dark-overlay">Hapus Seluruh Data</div>
            <div class="panel-body">
            <table data-toggle="table" data-toolbar="#toolbar" style="color:black;">
                <thead>
                <tr>
                    <th data-sortable="true">Nama Data</th>
                    <th data-sortable="true">Jumlah Data</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Data Autosave Jawaban</td>
                    <td><?=jumlah("jawaban");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/jawaban");?>">Hapus Data Autosave Jawaban</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Autosave Waktu</td>
                    <td><?=jumlah("waktu");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/waktu");?>">Hapus Data Autosave Waktu</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Siswa</td>
                    <td><?=jumlah("siswa");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/siswa");?>">Hapus Data Siswa</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Kelas</td>
                    <td><?=jumlah("kelas");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/kelas");?>">Hapus Data Kelas</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Mapel</td>
                    <td><?=jumlah("mapel");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/mapel");?>">Hapus Data Mapel</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Guru</td>
                    <td><?=jumlah("guru");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/guru");?>">Hapus Data Guru</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Ujian</td>
                    <td><?=jumlah("ujian");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/ujian");?>">Hapus Data Ujian</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Paket Soal</td>
                    <td><?=jumlah("paket_soal");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/paket_soal");?>">Hapus Data Paket Soal</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Soal</td>
                    <td><?=jumlah("soal");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/soal");?>">Hapus Data Soal</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Gambar Soal</td>
                    <td><?=count($files_image);?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/gambar_soal");?>">Hapus Data Gambar Soal</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Nilai</td>
                    <td><?=jumlah("nilai");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/nilai");?>">Hapus Data Nilai</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Import Excel</td>
                    <td><?=count($files_excel);?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/import_excel");?>">Hapus Data Gambar Soal</a>
                    </td>
                </tr>
                <tr>
                    <td>Data Berita</td>
                    <td><?=jumlah("berita");?></td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="<?=baseURL("pengaturan/hapus_data/berita");?>">Hapus Data Berita</a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div><!--/.col-->
</div><!--/.row-->	
<?php
}elseif(url(1) == "naik_kelas"){
    $query_siswa = mysqli_query($conn, "SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.kelas = tb_kelas.id_kelas");
    while($siswa = mysqli_fetch_array($query_siswa)){
        if($siswa['tingkat'] == "XII"){
            mysqli_query($conn, "DELETE FROM tb_siswa WHERE kelas = '$siswa[id_kelas]' AND id = '$siswa[id]'");
        } else {
            $kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE tingkat = '$siswa[tingkat]I' AND jurusan = '$siswa[jurusan]'"));
            mysqli_query($conn, "UPDATE tb_siswa SET kelas = '$kelas[id_kelas]' WHERE id = '$siswa[id]'");
        }
    }
    ?>
	<script>window.location='<?=baseURL(url(0));?>';</script>
<?php }elseif(url(1) == "hapus_data"){
    if(url(2) == "gambar_soal"){
        $files = glob('../img/soal/*'); // get all file names
        foreach($files as $file){ // iterate files
        if(is_file($file)) {  
            unlink($file); // delete file
        }
        }
    } elseif(url(2) == "import_excel"){
        $files = glob('xlsx/excel/*'); // get all file names
        foreach($files as $file){ // iterate files
        if(is_file($file)) {  
            unlink($file); // delete file
        }
        }
    } else {
        $query = "DELETE FROM tb_".$id;
        mysqli_query($conn, $query);
    }
    ?>
	<script>window.location='<?=baseURL(url(0));?>';</script>
<?php }?>