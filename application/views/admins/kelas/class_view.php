<section class="content-header">
    <a href=<?php echo base_url().'admin/kelas/all/'.$kelas[0]['id_semester'] ?>>
        <button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
    </a>
</section>

<section class="content">
	<div class="row">
	    <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">No kelas: <?php echo $kelas[0]['no_kelas']; ?></li>
                        <li class="list-group-item">Tipe kelas: <?php echo $kelas[0]['tipe_kelas']; ?></li>
                        <li class="list-group-item">Nama dosen: <?php echo $kelas[0]['nama_dosen']; ?></li>
                        <li class="list-group-item"><p>Peserta <br></p>
                            <table id="class_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach ($peserta as $detail_peserta): ?>
                                    <tr>
                                        <td><?php echo $detail_peserta['nim']; ?></td>
                                        <td><?php echo $detail_peserta['nama']; ?></td>
                                        <form action="<?=base_url().'admin/peserta/changestatus'?>" method="POST">
                                            <td>
                                                <select class="form-control" name="status">
                                                <option value="0" <?php if($detail_peserta['status'] == 0) echo "selected"; ?>>Tidak Aktif</option>
                                                <option value="1" <?php if($detail_peserta['status'] == 1) echo "selected"; ?>>Aktif</option>
                                                </select>
                                            </td>
                                                <input type="hidden" value="<?php echo $detail_peserta['nim']; ?>" name="nim">
                                                <input type="hidden" value="<?php echo $kelas[0]['id_semester']; ?>" name="page">
                                            <td>
                                                <input class="btn btn-danger btn-sm" type="submit" role="button" value="Ganti Status">
                                            </td>
                                        </form>
                                    </tr>
                                    <?php endforeach; ?>		
                                </tbody>
                            </table>
                        </li>
                    </ul> 
                    <ul class="pagination pagination-sm no-margin pull-left"></ul>
                </div>
            </div>
		</div>
    </div>
</section>
