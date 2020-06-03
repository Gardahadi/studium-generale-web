<section class="content-header">
	<?php if($alert['status'] == 'success') { ?>
		<div class="alert alert-success alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		<h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message']; ?></div>
	<?php } else if($alert['status'] == 'success') { ?>
		<div class="alert alert-success alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		<h4><i class="icon fa fa-check"></i> Gagal!</h4><?php echo $alert['message']; ?></div>
	<?php } ?>
	<h1>Resume<small>Pertemuan ke : <?php echo $no_pertemuan;?></small>
		<a href="<?=base_url().'peserta/pertemuan/all'?>">
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>

<section class="content">
  <div class="row">
	<?php if ( $valid ) : ?>
		<div class="col-md-12">
		<form class="form-horizontal" action="<?=base_url().'peserta/resume/submit'?>" enctype="multipart/form-data" method="POST">		
			<div class="box box-info">
				<div class="box-body">
						<?php if ($can_submit){ ?>
							<div class="form-group">
								<label for="noKelas" class="col-md-3 control-label">Resume<span style="color: red">*</span></label>
								<div class="col-md-7">
									<textarea required class="form-control" name="resume" rows="10"><?php if($resume != null) echo $resume->konten?></textarea>
								</div>
							</div>
						<?php } else { ?>
							<div class="form-group">
								<label for="noKelas" class="col-md-3 control-label">Resume<span style="color: red">*</span></label>
								<div class="col-md-7">
									<textarea required class="form-control" name="resume" rows="10" readonly><?php if($resume != null) echo $resume->konten?></textarea>
								</div>
							</div>
						<?php } ?>
						<input type="hidden" value="<?php echo $pertemuan->id_pertemuan; ?>" name="idPertemuan">
					<div class="box-footer" clearfix style="float: right;">
						<?php if ($can_submit){ ?>
							<button type="submit" class="btn btn-primary" value="Upload">Simpan</button>
						<?php } ?>
					</div>
				</div> 
			</div>
			
			</form>		
			
		</div>
	<?php else : ?>
		Pertemuan ini tidak valid
	<?php endif; ?>
  </div>
</section>
