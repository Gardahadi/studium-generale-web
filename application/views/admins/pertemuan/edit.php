<section class="content-header">
	<h1>Pertemuan<small>Form untuk menambahkan kelas</small>
		<a href="<?=base_url().'admin/pertemuan/all'?>">
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
	<?php if($alert['status'] == 'success') { ?>
		<div class="alert alert-success alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		<h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message'];?></div>
	<?php } else if($alert['status'] == 'fail') { ?>
		<div class="alert alert-warning alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		<h4><i class="icon fa fa-remove"></i> Gagal!</h4><?php echo $alert['message'];?></div>
	<?php } ?>
    <form class="form-horizontal" action="<?=base_url().'admin/pertemuan/updatedatabase'?>" enctype="multipart/form-data" method="POST">		
    	<div class="box box-info">
				<div class="box-body">
					<?php echo validation_errors(); ?>
                    
					<div class="form-group">
						<label for="topik" class="col-md-3 control-label">Topik<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input type="text" required class="form-control col-md-8" id="topik" name="topik" value="<?php echo $pertemuan['topik']?>">
							</div>
						</div>
					</div>

                    <div class="form-group">
						<label for="pembicara" class="col-md-3 control-label">Pembicara<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input type="text" required class="form-control col-md-8" id="pembicara" name="pembicara" value="<?php echo $pertemuan['pembicara']?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="tempat" class="col-md-3 control-label">Tempat<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input type="text" required class="form-control col-md-8" id="tempat" name="tempat" value="<?php echo $pertemuan['tempat']?>">
							</div>
						</div>
					</div>
 
					<div class="form-group">
						<label for="waktuMulai" class="col-md-3 control-label">Waktu Mulai<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalMulai"  value="<?php echo $pertemuan['tanggal_mulai']?>">
								<input required type="time" class="form-control" name="jamMulai"  value="<?php echo $pertemuan['jam_mulai']?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="waktuSelesai" class="col-md-3 control-label">Waktu Selesai<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalSelesai"  value="<?php echo $pertemuan['tanggal_selesai']?>">
								<input required type="time" class="form-control" name="jamSelesai"  value="<?php echo $pertemuan['jam_selesai']?>">							
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="waktuMulaiAbsensi" class="col-md-3 control-label">Waktu Mulai Absensi<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input type="time" required class="form-control col-md-8" id="waktuMulaiAbsensi" name="waktuMulaiAbsensi" value="<?php echo $pertemuan['waktu_mulai_absen']?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="waktuSelesaiAbsensi" class="col-md-3 control-label">Waktu Selesai Absensi<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input type="time" required class="form-control col-md-8" id="waktuSelesaiAbsensi" name="waktuSelesaiAbsensi" value="<?php echo $pertemuan['waktu_selesai_absen']?>">
							</div>
						</div>
					</div>
					
 
					<div class="form-group">
						<label for="waktuMulaiResume" class="col-md-3 control-label">Waktu Mulai Resume<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalMulaiResume"  value="<?php echo $pertemuan['tanggal_mulai_resume']?>">
								<input required type="time" class="form-control" name="jamMulaiResume"  value="<?php echo $pertemuan['jam_mulai_resume']?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="waktuSelesaiResume" class="col-md-3 control-label">Waktu Selesai Resume<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalSelesaiResume"  value="<?php echo $pertemuan['tanggal_selesai_resume']?>">
								<input required type="time" class="form-control" name="jamSelesaiResume"  value="<?php echo $pertemuan['jam_selesai_resume']?>">
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Kelas<span style="color: red">*</span></label>
						<div class="col-md-6 col-sm-12">
							<?php foreach ($classes as $class): ?>  
								<div class="checkbox">
									<label>
										<input <?php echo ($is_class_x_attendance[$class->id_kelas])?'checked':'';?> type="checkbox"  value="<?php echo($class->id_kelas);?>" name="daftarKelas[]"><?php echo($class->no_kelas);?>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					</div>	

					<div class="form-group">
						<label for="tautan" class="col-md-3 control-label">Tautan</label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
								<input type="text" class="form-control col-md-8" id="tautan" name="tautan" value="<?php echo $pertemuan['tautan']?>">
							</div>
						</div>
					</div>
					<input type="hidden" value="<?php echo $pertemuan['id_pertemuan']; ?>" name="idPertemuan">
				<div class="box-footer" clearfix style="float: right;">
				<button type="submit" class="btn btn-primary" value="Upload">Simpan</button>
			</div> 
		</div>
		
        </form>		
		
    </div>
  </div>
</section>
