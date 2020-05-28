<section class="content">
	<div class="row">
	   <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Pertemuan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No Pertemuan</th>
                  <th>Topik</th>
                  <th>Pembicara</th>
                  <th>Tempat</th>
                  <th>Waktu</th>
                  <th>Tautan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_pertemuan as $pertemuan): ?>  
                        <tr>
                            <td><?php echo $pertemuan->no_pertemuan; ?></td>
                            <td><?php echo $pertemuan->topik; ?></td>
                            <td><?php echo $pertemuan->pembicara; ?></td>
                            <td><?php echo $pertemuan->tempat; ?></td>
                            <td>
                              <p>Waktu Mulai : <?php echo $pertemuan->waktu_mulai_pertemuan; ?></p>
                              <p>Waktu Selesai : <?php echo $pertemuan->waktu_selesai_pertemuan; ?></p>
                              <p>Waktu Mulai Absensi : <?php echo $pertemuan->waktu_mulai_absen; ?></p>
                              <p>Waktu Selesai Absensi : <?php echo $pertemuan->waktu_selesai_absen; ?></p>
                              <p>Waktu Mulai Resume : <?php echo $pertemuan->waktu_mulai_resume; ?></p>
                              <p>Waktu Selesai Resume : <?php echo $pertemuan->waktu_selesai_resume; ?></p>
                            </td>
                            <td><?php echo $pertemuan->tautan; ?></td>
                            <td>
                                <?php if($is_absensi[$pertemuan->id_pertemuan]) { ?>
                                    <form action="<?=base_url().'peserta/resume/edit/' . $pertemuan->id_pertemuan?>" method="POST" style="display:inline;">
                                    <input class="btn btn-primary btn-sm" type="submit" role="button" value="Submit Resume">
                                    </form>
                                <?php } ?>
                            </td>
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