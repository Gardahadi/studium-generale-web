<section class="content">
	<div class="row">
	   <div class="col-xs-12">
         <div class="box box-primary">
         <?php if($alert['status'] == 'success') { ?>
          <div class="alert alert-success alert-dismissible">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          <h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message']; ?></div>
        <?php } else if($alert['status'] == 'fail') { ?>
              <div class="alert alert-warning alert-dismissible">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          <h4><i class="icon fa fa-check"></i> Gagal!</h4><?php echo $alert['message']; ?></div>
          <?php } ?>
            <div class="box-header">
            <h3 class="box-title">Tugas Akhir</h3>

            <br> 
        
            </div>
            <!-- /.box-header -->
            <label class="col-md-3 control-label">Pilih Kelas</label>
            <div class="col-md-3">

              <form method="GET" action="<?=base_url().'admin/tugasakhir'?>">
                <select class="form-control" name="kelas">
                <option selected disabled> -- Pilih Kelas -- </option>
                  <?php foreach($daftar_kelas as $kelas) { ?>
                    <?php if($kelas_now == $kelas->id_kelas) { ?>
                      <option selected value="<?php echo $kelas->id_kelas; ?>"><?php echo $kelas->no_kelas; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $kelas->id_kelas; ?>"><?php echo $kelas->no_kelas; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
                <div class="input-group-addon">
                  <button class="btn btn-primary btn-sm">Cari</button>
                </div>
              </form>
            </div>
            <div class="box-body">
              

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Tugas Akhir</th>
                  <th>Nilai</th>
                  <th>Terakhir Menilai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_tugas_akhir as $tugas_akhir): ?>  
                        <tr>                            <td><?php echo $tugas_akhir->nim; ?></td>
                            <?php if($tugas_akhir->id_tugasakhir != null) { ?>
                              <td><a href="<?=base_url() . 'peserta/tugasakhir/download/' . $tugas_akhir->nama_file; ?>"><?=$tugas_akhir->nama_file?></td>
                              <form action="<?=base_url().'admin/tugasakhir/submitnilai'?>" method="POST" style="display:inline;">
                                <td>
                                    <input type="text" name="tugasakhir-<?=$tugas_akhir->nim?>" value="<?=$tugas_akhir->nilai?>">
                                </td>
                                <td>
                                    <?=$tugas_akhir->timestamp_nilai?>
                                </td>
                                <td>
                                      <input type="hidden" value="<?=$tugas_akhir->nim?>" name="nim">
                                      <input type="hidden" value="<?=$tugas_akhir->kelas?>" name="kelas">
                                      <input class="btn btn-danger btn-sm" type="submit" role="button" value="Simpan Nilai">    
                                </td>
                              </form>
                            <?php } else { ?>
                              <td> Tidak mengumpulkan </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              <ul class="pagination pagination-sm no-margin pull-left">
               
              </ul>
            </div>
          </div>
		</div>
	</div>