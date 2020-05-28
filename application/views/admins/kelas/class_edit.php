<section class="content-header">
	<h1>Kelas<small>Form untuk mengedit kelas</small>
		<a href=<?php echo base_url().'admin/kelas/all/'.$kelas[0]['id_semester'] ?>>
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>


<section class="content">
  <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal" action=<?php echo base_url().'admin/kelas/edit/';?> enctype="multipart/form-data" method="POST">		
    	<div class="box box-info">
			<div class="box-body">
                <input type ="hidden" id="idKelas" name="idKelas" value = <?php echo $kelas[0]['id_kelas'];?>>
                <input type ="hidden" id="idSemester" name="idSemester" value = <?php echo $kelas[0]['id_semester'];?>>
                <div class="form-group">

                    <label for="noKelas" class="col-md-3 control-label">No Kelas <span style="color: red">*</span></label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <input type="text" required class="form-control col-md-8" id="noKelas" name="noKelas" readonly value=<?php echo $kelas[0]['no_kelas'];?>>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tipeKelas" class="col-md-3 control-label">Tipe Kelas <span style="color: red">*</span></label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <select class="form-control tipeKelas" id="tipeKelas" name="tipeKelas" value="<?php echo $kelas[0]['tipe_kelas']; ?>" readonly>
                                <option value="Reguler" <?php if ($kelas[0]['tipe_kelas']=="Reguler") {echo "selected=\"selected\"";}?>>Reguler</option>
                                <option value="Seatin" <?php if ($kelas[0]['tipe_kelas']=="Seatin") {echo "selected=\"selected\"";}?>>Seatin</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="namaDosen" class="col-md-3 control-label">Nama Dosen  <?php if ($kelas[0]['tipe_kelas']=="Reguler") {echo "<span style=\"color: red\">*</span>";}?> </label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <input type="text" class="form-control col-md-8" id="namaDosen" name="namaDosen" value=<?php echo $kelas[0]['nama_dosen'];?>  <?php echo $kelas[0]['nama_dosen'];?>>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="daftarPeserta">Daftar Peserta (format .xlsx) <strong>Maks 2MB</strong></label>  
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-file"></i>
                            </div>
                            <input id="daftarPeserta" required type="file" class="form-control" name="daftarPeserta" accept=".xlsx">
                        </div>
                        <a href="<?=base_url('admin/kelas/downloadSampleExcel')?>">Download Contoh File</a>  
                    </div>
                </div>

                <div class="box-footer" clearfix >
                    <button type="submit" class="btn btn-primary" value="Upload" style="float: right;">Simpan</button>
                </div> 
            </div>
    	</div>
    </form>		
    </div>
  </div>
</section>
