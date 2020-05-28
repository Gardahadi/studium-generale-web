<section class="content-header">
    <?php if($alert['status'] == 'success') { ?>
		<div class="alert alert-success alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		<h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message']; ?></div>
	<?php } else if($alert['status'] == 'fail') { ?>
        <div class="alert alert-warning alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		<h4><i class="icon fa fa-check"></i> Gagal!</h4><?php echo $alert['message']; ?></div>
    <?php } ?>

	<h1>Tugas Akhir<small>Form untuk mengumpulkan tugas akhir</small>
	</h1>	
</section>

<section class="content">
  <div class="row">
	<?php if ( true ) : ?>
		<div class="col-md-12">
		    <form class="form-horizontal" action="<?=base_url().'peserta/tugasakhir/submit'?>" enctype="multipart/form-data" method="POST">		
                <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="daftarPeserta">Pengumpulan Sebelumnya</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <?php if($submit_tugas_akhir == null) { ?>
                                            <p class="form-control"> Anda belum pernah melakukan pengumpulan tugas akhir </p>
                                        <?php } else { ?>
                                            <a href="<?=base_url().'peserta/tugasakhir/download/'.$submit_tugas_akhir[0]->nama_file?>" class="form-control"> <?php echo $submit_tugas_akhir[0]->nama_file ?> </a>
                                        <?php } ?>
                                        </a>
                                    </div>
        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="daftarPeserta">File (format .pdf) <strong>Maks 10MB</strong></label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <input id="fileSubmit" required type="file" class="form-control" name="fileSubmit" accept=".pdf">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="daftarPeserta">Daftar Mahasiswa</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                       <table class="table" id="daftarMahasiswa">					
                                            <tr>
                                                <td>
                                                    <input required type="text" class="form-control" name="mahasiswa1" value="<?= $nimPeserta ?>" readonly/>
                                                </td>
                                                <td>
                                            
                                                    <button type="button" class="btn btn-sm btn-success addSStujuan" id="addMahasiswa">+</button>
                                                
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="box-footer" clearfix style="float: right;">
                        <?php if (date('Y-m-d H:i:s') < $tugas_akhir->deadline_tugas_akhir){ ?>
                            <button type="submit" class="btn btn-primary" value="Upload">Submit</button>
                        <?php } ?>
                    </div> 
                </div>		
			</form>		
			
		</div>
	<?php else : ?>
		Form Pengumpulan ini tidak valid
	<?php endif; ?>
  </div>
</section>

<script type="text/javascript">
 
//  Kode Javascript jQuery disini
    function addRow(e){
        e.preventDefault();
        var jumlahMahasiswa = $("#daftarMahasiswa").children().children().length + 1;
        var newRow = `<tr>
                        <td>
                            <input required type="text" class="form-control" name="mahasiswa` + jumlahMahasiswa + `" value=""/>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger addSStujuan" id="removeMahasiswa` + (jumlahMahasiswa) 
                            + `">-</button>                     
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success addSStujuan" id="addMahasiswa">+</button>
                        
                        </td>
                    </tr>`;
        $("#addMahasiswa").parent().remove();
        $("#daftarMahasiswa").append(newRow);
        $("#addMahasiswa").click(function(e) {
            addRow(e);
        });
        $("#removeMahasiswa" + (jumlahMahasiswa)).click(function(e) {
            removeRow(e);
        });
    }
    function removeRow(e) {
        console.log(e);
        var jumlahMahasiswa = $("#daftarMahasiswa").children().children().length;
        var posRow = $("#" + e.toElement.id).parent().parent().index() + 1;
        $("#" + e.toElement.id).parent().parent().remove();
        //SET ID'
        
        $('#daftarMahasiswa').children().children().each(function(idx, itm) {
            if(idx != 0) {
                var idRemoveButton = "removeMahasiswa" + (idx + 1);
                $(itm).children().eq(1).children().attr("id",idRemoveButton);
                $("#" + idRemoveButton).click(function(e) {
                    removeRow(e);
                });
            }
        });

        if(posRow == jumlahMahasiswa) {
            var lastRow = $('#daftarMahasiswa').children().children().last();
            var newAddButton =`<td>
                                <button type="button" class="btn btn-sm btn-success addSStujuan" id="addMahasiswa">+</button> 
                            </td>`;
            lastRow.append(newAddButton);
            $("#addMahasiswa").click(function(e) {
                addRow(e);
            });
        }
    }
    $("#addMahasiswa").click(function(e) {
        addRow(e);
    });
</script>
