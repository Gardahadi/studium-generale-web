<section class="content">
	<div class="row">
	   <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
            <?php if($alert['status'] == 'success') { ?>
              <div class="alert alert-success alert-dismissible">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
              <h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message'];?></div>
            <?php } else if($alert['status'] == 'fail') { ?>
              <div class="alert alert-warning alert-dismissible">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
              <h4><i class="icon fa fa-remove"></i> Gagal!</h4><?php echo $alert['message'];?></div>
            <?php } ?>
            <h3 class="box-title">Pertemuan</h3>
            <a href="<?=base_url().'admin/pertemuan/add'?>" class="btn btn-social btn-dropbox btn-sm pull-right">
                <i class="fa fa-plus" href=""></i> Tambah
            </a>
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
                    <?php foreach ($list_pertemuan as $index => $pertemuan): ?>  
                        <tr>
                            <td><?php echo $index+1; ?></td>
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
                                <a class="btn btn-info btn-sm" href="<?php echo base_url(). 'admin/Presensi_Pertemuan/presensiPertemuan?id='. $pertemuan->id_pertemuan; ?>">
                                    Presensi
                                </a>
                                <a class="btn btn-info btn-sm" href="<?php echo base_url(). 'admin/resume/detailpertemuan?id='. $pertemuan->id_pertemuan; ?>">
                                    Nilai
                                </a>
                                <button class="btn btn-success btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                                <form action="<?=base_url().'admin/pertemuan/edit/' . $pertemuan->id_pertemuan?>" method="POST" style="display:inline;">
                                  <input class="btn btn-primary btn-sm" type="submit" role="button" value="Edit">
                                </form>
                                <form  action="<?=base_url().'admin/pertemuan/delete/'.$pertemuan->id_pertemuan?>" method="POST" style="display:inline;" id="delete-<?=$pertemuan->id_pertemuan?>">
                                  <input type="hidden" value="<?=$pertemuan->id_pertemuan?>" id="idPertemuan" name="idPertemuan">
                                  <input id="deleteButton-<?= $pertemuan->id_pertemuan?>" class="delete-button btn btn-danger btn-sm" type="submit" role="button" value="Hapus">
                                </form>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close close-modal" >&times;</button>
          <h4 class="modal-title">Konfirmasi Hapus Pertemuan</h4>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin untuk menghapus pertemuan ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default close-modal">Close</button>
          <button type="button" class="btn btn-danger" id="okModal">Ok</button>
        </div>
      </div>
      
    </div>
  </div>

</section>

  <script>
    function hapusPertemuan(e,el) {
      var modalDelete = $("#myModal");
      modalDelete.addClass("in");
      modalDelete.attr("aria-hidden", "false");
      modalDelete.attr("style","display: block; padding-right: 15px;");
      var formDelete = $(el).parent();
      $("#okModal").click({formDelete: formDelete},function(e){
        var formDelete = e.data.formDelete;
        formDelete.submit();
      });
      
      console.log(e);
    }

    $(".close-modal").click(function(e) {
      var modalDelete = $("#myModal");
      modalDelete.removeClass("in");
      modalDelete.attr("aria-hidden", "true");
      modalDelete.attr("style","display: hidden;");
    });

    $(".delete-button").click(function(e) {
      e.preventDefault();
      hapusPertemuan(e,this);
    });
  </script>