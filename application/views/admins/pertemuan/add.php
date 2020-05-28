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
    <form class="form-horizontal" action="<?=base_url().'admin/pertemuan/adddatabase'?>" enctype="multipart/form-data" method="POST">		
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
								<input type="text" required class="form-control col-md-8" id="topik" name="topik">
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
								<input type="text" required class="form-control col-md-8" id="pembicara" name="pembicara">
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
								<input type="text" required class="form-control col-md-8" id="tempat" name="tempat" value="Aula GKU Barat ITB">
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
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalMulai"?>
								<input required type="time" class="form-control" name="jamMulai" value="09:00">
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
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalSelesai"?>
								<input required type="time" class="form-control" name="jamSelesai" value="11:00">
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
								<input type="time" required class="form-control col-md-8" id="waktuMulaiAbsensi" name="waktuMulaiAbsensi">
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
								<input type="time" required class="form-control col-md-8" id="waktuSelesaiAbsensi" name="waktuSelesaiAbsensi">
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
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalMulaiResume"?>
								<input required type="time" class="form-control" name="jamMulaiResume" ?>
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
								<input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="tanggalSelesaiResume"?>
								<input required type="time" class="form-control" name="jamSelesaiResume" ?>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Kelas<span style="color: red">*</span></label>
						<div class="col-md-6 col-sm-12">
							<?php foreach ($classes as $class): ?>  
								<div class="checkbox">
									<label>
										<input type="checkbox"  value="<?php echo($class->id_kelas);?>" name="daftarKelas[]" checked><?php echo($class->no_kelas);?>
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
								<input type="text" class="form-control col-md-8" id="tautan" name="tautan">
							</div>
						</div>
					</div>
				<div class="box-footer" clearfix style="float: right;">
				<button type="submit" class="btn btn-primary" value="Upload">Simpan</button>
			</div> 
		</div>
		
        </form>		
		
    </div>
  </div>
</section>
