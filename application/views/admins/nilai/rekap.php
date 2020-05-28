<section class="content">
	<div class="row">
	   <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
            <?php if($alert['status'] == 'success') { ?>
              <div class="alert alert-success alert-dismissible">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
              <h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message']; ?></div>
            <?php } else if($alert['status'] == 'fail') {?>
              <div class="alert alert-success alert-dismissible">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
              <h4><i class="icon fa fa-check"></i> Gagal!</h4><?php echo $alert['message']; ?></div>
            <?php } ?>
            <h3 class="box-title">Rekap Nilai</h3>
            <?php if($kelas != null) { ?>
              <a href="<?=base_url().'admin/nilai/'. ((defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION > 5) ? 'excelphp7' : 'excel')               
                  .'?kelas='.$kelas->id_kelas?>" class="btn btn-social btn-dropbox btn-sm pull-right">
                  <i class="fa fa-plus" href=""></i> Export
              </a>
            <?php } ?>
            <br> 
            </div>
            <!-- /.box-header -->
            <label class="col-md-3 control-label">Pilih Kelas</label>
						<div class="col-md-3">
                <form method="GET" action="<?=base_url().'admin/nilai'?>">
                  <select class="form-control" name="kelas">
                    <option disabled <?php if($kelas == null) echo "selected" ?>>-- Pilihan Kelas --</option>
                    <?php foreach($daftar_kelas as $pilihan_kelas) { ?>
                      <?php if($pilihan_kelas->id_kelas == $kelas->id_kelas) { ?>
                        <option selected value="<?php echo $pilihan_kelas->id_kelas; ?>"><?php echo $pilihan_kelas->no_kelas; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $pilihan_kelas->id_kelas; ?>"><?php echo $pilihan_kelas->no_kelas; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                    <button class="btn btn-primary btn-sm">Cari</button>
                </form>
						</div>
            <br>
            <br>
            <br>
            <br>
            <?php if($kelas != null) { ?>
              
              <form action="<?=base_url().'admin/nilai/importnilai'?>" method="POST" style="display:inline;" enctype="multipart/form-data"> 
                <div class="box-body">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="daftarPeserta">Template Excel</label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-file"></i>
                            </div>
                            <a class="form-control" href="<?=base_url().'admin/nilai/'.((defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION > 5) ? 'excelphp7' : 'excel')               
                                  .'?kelas='.$kelas->id_kelas?>"> Download </a>
                        </div>
                    </div>
                </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Rekap Nilai (format .xlsx) <strong>Maks 2MB</strong></label>
                      <div class="col-md-7">
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-file"></i>
                              </div>
                              <input required type="file" class="form-control" name="rekapNilai" accept=".xlsx">
                          </div>
                      </div>
                  </div>
                  <input type="hidden" name="Kelas" value="<?=$_GET["kelas"]?>">
                  <button type="submit" class="btn btn-primary" value="Upload">Import Nilai</button>
                </div>
              </form>
              <form action="<?=base_url().'admin/nilai/kelasedit?kelas='.$_GET['kelas']?>" method="POST" style="display:inline;">  
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th style="text-align: center; vertical-align: middle;" rowspan="2">No</th>
                      <th style="text-align: center; vertical-align: middle;" rowspan="2">NIM</th>
                      <th style="text-align: center; vertical-align: middle;" rowspan="2">Nama</th>
                      <th style="text-align: center; vertical-align: middle;" colspan=<?= sizeof($list_pertemuan) ?>>Pertemuan</th>
                      <th style="text-align: center; vertical-align: middle;" rowspan="2">Tugas Akhir</th>
                      <th style="text-align: center; vertical-align: middle;" rowspan="2">Nilai Akhir</th>
                  </tr>
                  <tr>
                      <?php foreach ($list_pertemuan as $index => $pertemuan): ?>
                          <th style="text-align: center; vertical-align: middle;"><?php echo ($index + 1); ?></th>
                      <?php endforeach; ?>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $indeks = 0; ?>
                      <?php foreach ($list_peserta as $peserta): ?>  
                          <tr>
                              <td><?php $indeks += 1; echo $indeks; ?></td>
                              <td><?php echo $peserta->nim; ?></td>
                              <td><?php echo $peserta->nama; ?></td>
                              <?php foreach ($list_pertemuan as $pertemuan): ?>
                                <td>
                                  <?php if($absensi[$peserta->nim][$pertemuan->id_pertemuan]) { ?>
                                    <input type="hidden"
                                                name="<?php echo $list_resume[$peserta->nim]
                                                        [$pertemuan->id_pertemuan]->id_resume . 'old'; ?>"
                                                value="<?php echo $list_resume[$peserta->nim]
                                                    [$pertemuan->id_pertemuan]->nilai; ?>">
                                    <input  type="number"
                                                name="<?php echo $list_resume[$peserta->nim]
                                                        [$pertemuan->id_pertemuan]->id_resume . 'new'; ?>"
                                                value="<?php echo $list_resume[$peserta->nim]
                                                    [$pertemuan->id_pertemuan]->nilai; ?>"
                                                max="100" min="0" step="any">
                                  <?php } ?>
                                  <?php if(!$absensi[$peserta->nim][$pertemuan->id_pertemuan]) { ?>
                                    <input disabled>
                                  <?php } ?>
                                </td>
                              <?php endforeach; ?>
                              <td>
                                <?php if($daftar_tugas_akhir[$peserta->nim] != null) { ?>
                                  <input  type="number"
                                                name="<?php echo 'tugasakhir-' . $peserta->nim ?>"
                                                value="<?php echo $daftar_tugas_akhir
                                                            [$peserta->nim]->nilai ?>"
                                                max="100" min="0" step="any">
                                <?php } else { ?>
                                    <input disabled>
                                  <?php } ?>
                              </td>
                              <td>
                                  <input readonly value="<?=$peserta->nilai_akhir;?>">
                              </td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                <br>
                <button class="btn btn-success btn-sm pull-right">
                    Simpan
                </button>
                <ul class="pagination pagination-sm no-margin pull-left">
                
                </ul>
              </div>
              </form>
            <?php } ?>
          </div>
		</div>
	</div>