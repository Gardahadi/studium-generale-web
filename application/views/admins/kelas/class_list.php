<section class="content-header">
    <div class="box-header">
        <?php if($alert['status'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message'];?>
            </div>
        <?php } else if($alert['status'] == 'fail') { ?>
            <div class="alert alert-warning alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                <h4><i class="icon fa fa-remove"></i> Gagal!</h4><?php echo $alert['message'];?>
            </div>
        <?php } ?>
        <h2 class="box-title">Data Kelas <?php echo 'Semester '.$semester[0]["semester"].' Tahun Ajaran '.$semester[0]["tahun_ajaran"]?></h2>
        <a href=<?php echo base_url().'admin/kelas/semesterlist/'?>>
            <button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
        </a>
        </div>
</section>

<section class="content">
	<div class="row">
	    <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table id="class_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No Kelas</th>
                                <th>Dosen</th>
                                <th>Tipe Kelas</th>
                                <th>Jumlah Mahasiswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php foreach ($classes as $class): ?> 
                            <tr>
                                <td><?php echo $class['no_kelas']; ?></td>
                                <td><?php echo $class['nama_dosen']; ?></td>
                                <td><?php echo $class['tipe_kelas']; ?></td>
                                <td><?php echo $class['jumlah_mahasiswa']; ?></td>
                                <td>
                                    <a href= <?php echo base_url().'admin/kelas/view/'.$class['id_kelas']; ?>><button class="btn btn-primary btn-sm">View</button></a>
                                    <a href= <?php echo base_url().'admin/kelas/editform/'.$class['id_kelas']; ?>><button class="btn btn-success btn-sm">Edit</button></a>
                                    <form action="<?=base_url().'admin/kelas/delete'?>" method="POST" style="display:inline;">
                                    <input type="hidden" value="<?=$class["id_kelas"]?>" id="id-kelas" name="id-kelas">
                                    <input type="hidden" value="<?=$semester[0]['id_semester']?>" id="id-semester" name="id-semester">
                                    <input class="btn btn-danger btn-sm" type="submit" role="button" value="Hapus">
                                    </form>
                                    <?php if ($class['tipe_kelas']=="Seatin") {
                                        echo '<a href= '. base_url().'admin/kelas/seatin/'.$semester[0]['id_semester'].'><button class="btn btn-info btn-sm">Gabung Ke Reguler</button></a>';
                                    } ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>		
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm no-margin pull-left"></ul>
                </div>
            </div>
		</div>
    </div>
</section>