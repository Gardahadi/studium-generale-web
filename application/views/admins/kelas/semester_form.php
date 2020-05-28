<script>
</script>

<section class="content-header">
	<h1>Kelas<small>Form untuk menambahkan kelas</small>
		<a href=<?php echo base_url().'admin/kelas/semesterlist' ?>>
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal" action="<?php if ($method == 'edit') {echo base_url().'admin/kelas/editsemester';} else {echo base_url().'admin/kelas/add';} ?> " enctype="multipart/form-data" method="POST">		
    	<div class="box box-info">
			<div class="box-body">
				<?php if ($method == 'edit') {echo '<input type="hidden" name="id" value="'.$semester[0]['id_semester'].'">';}?>
				<div class="form-group">
					<label for="tahunAjaran" class="col-md-3 control-label">Tahun Ajaran <span style="color: red">*</span></label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
							<select class="form-control" id="tahunAjaran" name="tahunAjaran" value="<?php if ($method=="edit")?>" <?php if ($method=="edit") {echo "readonly";}?>>
								<option value="2019/2020" <?php if ($method == 'edit' && $semester[0]['tahun_ajaran']=="2019/2020") {echo "selected=\"selected\"";}?> >2019/2020</option> 
								<option value="2020/2021" <?php if ($method == 'edit' && $semester[0]['tahun_ajaran']=="2020/2021") {echo "selected=\"selected\"";}?>>2020/2021</option>
								<option value="2021/2022" <?php if ($method == 'edit' && $semester[0]['tahun_ajaran']=="2021/2022") {echo "selected=\"selected\"";}?>>2021/2022</option>
								<option value="2022/2023" <?php if ($method == 'edit' && $semester[0]['tahun_ajaran']=="2022/2023") {echo "selected=\"selected\"";}?>>2022/2023</option>
								<option value="2023/2024" <?php if ($method == 'edit' && $semester[0]['tahun_ajaran']=="2023/2024") {echo "selected=\"selected\"";}?>>2023/2024</option>
								<option value="2024/2025" <?php if ($method == 'edit' && $semester[0]['tahun_ajaran']=="2024/2025") {echo "selected=\"selected\"";}?>>2024/2025</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Semester <span style="color: red">*</span></label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars"></i>
							</div>
							<select class="form-control" id="semester" name="semester" <?php if ($method=="edit") {echo "readonly";}?> value="<?php if ($method=="edit") {echo $semester[0]['semester'];}?>">
								<option value="1" <?php if ($method == 'edit' && $semester[0]['semester']=="1") {echo "selected=\"selected\"";}?>>1</option>
								<option value="2" <?php if ($method == 'edit' && $semester[0]['semester']=="2") {echo "selected=\"selected\"";}?>>2</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="startDate" class="col-md-3 control-label">Start Date</label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
							<input readonly class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="startDate" name="startDate" value="<?php if ($method=="edit") {echo $semester[0]['start_date'];}?>">
						</div>
					</div>
				</div>

				<div class="form-group">
                    <label for="endDate" class="col-md-3 control-label">End Date</label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
							<input readonly class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="endDate" name="endDate" value="<?php if ($method=="edit") {echo $semester[0]['end_date'];}?>">
						</div>
					</div>
                </div>

				<div class="form-group">
                    <label for="jlhKelasReguler" class="col-md-3 control-label">Jumlah Kelas (Reguler)<span style="color: red">*</span></label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <input type="number" required class="form-control col-md-8" id="jlhKelasReguler" name="jlhKelasReguler" <?php if ($method=="edit") {echo "readonly";}?> value="<?php if ($method=="edit") {echo $semester[0]['kelas_reguler'];}?>">
                        </div>
                    </div>
                </div>

				<div class="form-group">
                    <label for="jlhKelasSeatin" class="col-md-3 control-label">Jumlah Kelas (Seatin)<span style="color: red">*</span></label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <input type="number" required class="form-control col-md-8" id="jlhKelasSeatin" name="jlhKelasSeatin" <?php if ($method=="edit") {echo "readonly";}?> value="<?php if ($method=="edit") {echo $semester[0]['kelas_seatin'];} else {echo "1";}?>">
                        </div>
                    </div>
                </div>

				<div class="form-group">
					<label for="topikTugasAkhir" class="col-md-3 control-label">Topik Tugas Akhir </label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
							<input type="text" class="form-control col-md-8" id="topikTugasAkhir" name="topikTugasAkhir" value="<?php if ($method=="edit") {echo $semester[0]['topik_tugas_akhir'];}?>">
						</div>
					</div>
				</div>

				<div class="form-group">
                    <label for="deadlineTanggalTugasAkhir" class="col-md-3 control-label">Deadline Tugas Akhir (Tanggal)</label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
							<input readonly class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="deadlineTanggalTugasAkhir" name="deadlineTanggalTugasAkhir" value="<?php if ($method=="edit") {echo $semester[0]['deadline_tanggal_tugas_akhir'];}?>">
						</div>
					</div>
                </div>

				<div class="form-group">
                    <label for="deadlineJamTugasAkhir" class="col-md-3 control-label">Deadline Tugas Akhir (Waktu)</label>
					<div class="col-md-7">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
							<input type="time" class="form-control" id="deadlineJamTugasAkhir" name="deadlineJamTugasAkhir" value="<?php if ($method=="edit") {echo $semester[0]['deadline_jam_tugas_akhir'];}?>">
						</div>
					</div>
                </div>
				
			</div>
			<div class="box-footer" clearfix >
				<button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
			</div> 
		
			
			</div>

    	</div>
        </form>		
		
    </div>
  </div>
</section>
