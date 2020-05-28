
<section class="content-header">
	<h1>Judul Formulir <small>Deskripsi Formulir</small>
		<a href="<?=base_url().'admin/mahasiswa/perizinan/kegiatan'?>">
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal">		
    	<div class="box box-info">
			
				<div class="box-body">
			
					<div class="form-group">
						<label for="inputEmail3" class="col-md-3 control-label">Text Label <span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-flag" aria-hidden="true"></i>
								</div>
								<input type="text" required class="form-control col-md-8" name="nama_kegiatan" >
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Text Area Label <span style="color: red">*</span></label>
						<div class="col-md-7">
							<textarea required class="form-control" name="deskripsi_k"></textarea>
						</div>
					</div>
				
						<div class="form-group" >
						<label class="col-md-3 control-label">
						Text Label<span style="color: red">*</span>
						</label> 
							<div class="col-md-8">
							<table class="table" id="customFieldsSStujuan">
								
									<tr>
										<td>
											<input required type="text" class="form-control" name="tujuan[]" value=""/>
										</td>
										<td>
									
											<button type="button" href="javascript:void(0);" class="btn btn-sm btn-success addSStujuan">+</button>
										
										</td>
									</tr>
							</table>
							</div>
						</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Select Option</label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars"></i>
								</div>
								<select class="form-control" name="">
									<option value="1">Pilihan 1</option>
									<option value="2">Pilihan 2</option>
									<option value="3">Pilihan 3</option>
								</select>
							</div>
						</div>
					</div>
					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Kegiatan & Tempat ( Fasilitas )
					</legend>
					<div class="form-group">
                        <div class="col-md-12">
                            <div class="input">
                                <table class="table table-bordered grid_list_field" id="customFieldsKG">
                                    <tbody>
                                    <tr style="width:100%">
                                        <th>Text</th>
                                        <th style="width:15%">Tanggal</th>
                                        <th>Jam</th>
                                        <th colspan="2">Number<span style="color: red">*</span> / kWh</th>
										<th>CheckBox</th>
                                        <th>Aksi</th>
                                    </tr>
									<tr>
											<td colspan="5">
												<input type="text"  class="form-control col-md-8" required placeholder="Nama" />
											</td>
											<td>
												<input type="checkbox" value="1">
											</td>
										    <td>
										        <div href="javascript:void(0);" class="btn btn-sm btn-success addKG">+</div>
										    </td>
									</tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-bars"></i>
                                                </div>
                                                <select class="form-control" >
                                                    <option value="1">Option 1</option>
                                                    <option value="2" selected="selected">Option 2</option>
                                                </select>
                                                <input type="text" placeholder="Nama Tempat" class="form-control" required>
                                            </div>
                                        </td>
                                        <td>
                                            <input required type="text" class="form-control cdatepicker">
                                        </td>
                                        <td>
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input type="text" class="form-control input-small">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input type="text" class="form-control input-small" >
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <input type="text" class="form-control">
                                        </td>
										<td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

				<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Permohonan Izin Publikasi</legend>
					 <small>Permohonan izin memasang kelengkapan acara ex <i>banner, spanduk, baliho dll</i></small>
					<div class="form-group">
						<label class="col-md-3 control-label" for="is_izin">Perlu permohonan izin memasang kelengkapan acara?</label>               	
						<div class="col-md-7">
							<div class="input">
								<select class="form-control" id="izin_fasilitas" name="">
								  <option value="no">No</option>
								  <option value ="yes" onClick="showDiv()">Yes</option>
								</select>
							</div>
							</div>
					</div>
							
					<div class="form-group">
			
                        <div class="col-md-12">
                            <div class="input">
                                <table class="table table-bordered grid_list_field" id="customFieldsKGfasilitas" style="width:100%">
                                    <tbody>
                                    <tr>
                                        <th>Tempat</th>
                                        <th style="width:15%">Tanggal Mulai</th>
																				<th style="width:15%">Tanggal Akhir</th>
                                        <th>Jam Mulai &amp; Berakhir</th>
																				<th style="width:10%"><label for="foto">Foto<span style="color: red">*</span> (Jenis file jpg, png - <strong>Maks 2MB</strong>)</label></th>
                                        <th>Aksi</th>
                                    </tr>
																			<tr>
																				<td colspan="5">
																					<input type="text"  class="form-control col-md-8" placeholder="Permohonan izin memasang kelengkapan acara ex banner, spanduk, baliho dll" />
																				</td>
                                        <td>
                                            <div href="javascript:void(0);" class="btn btn-sm btn-success">+</div>
                                        </td>
																			</tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-bars"></i>
                                                </div>
                                                <select class="form-control">
                                                    <option value="1">Luar Kampus</option>
                                                    <option value="2" selected="selected">Dalam Kampus</option>
                                                </select>
                                                <input type="text" class="form-control" >
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control cdatepicker">
                                        </td>
																				<td>
                                           <input type="text" class="form-control cdatepicker">
                                        </td>
                                        <td>
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input type="text" class="form-control input-small">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input type="text" class="form-control input-small">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            </div>
                                        </td>
										 										<td>
									   													<input id="foto" type="file" class="" style="margin-bottom:5px;" accept="image/jpeg, image/png"  multiple="multiple">
									   										</td>
																				<td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

						</div>	

					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Izin Masuk Kendaraan</legend>
          
					<div class="form-group">		
						<label class="col-md-3 control-label">Transportasi<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars"></i>
								</div>
								<select class="form-control" id="trans" name="ques_trans">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>
					</div>

					              
					<div id="hidden_div" style="display: none;">
						

                        <div class="form-group">
                            <label class="col-md-3 control-label">Jumlah<span style="color: red">*</span></label>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-bars"></i>
                                    </div>
                                    <input type="text" class="form-control" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">

                                <div class="input">
                                    <table class="table table-bordered grid_list_field" >
                                        <tbody>
                                        <tr style="width: 100%">
																					<th>Jenis Transportasi</th>
																					<th>Nomor Polisi</th>
											                    <th style="width: 15%">Kepemilikan</th>
																					<th>Keterangan</th>
																					<th style="width: 15%">Tanggal Masuk</th>
																					<th style="width: 15%">Jam Masuk</th>
																					<th></th>
										                    </tr>
										                    <tr>
																				<td>
																					<select class="form-control" id="properti" >
																							<option value="0">Mobil</option>
																							<option value="1">Motor</option>
																			  	</select>
																				</td>
																				<td>
                                          <input type="text" class="form-control" id="properti" name="properti[nopol][]" />
                                        </td>
																				<td>
																					<select class="form-control" id="properti" name="properti[pemilik][]">
																							<option value="0">Vendor</option>
																							<option value="1" onClick="showDiv()">Pribadi</option>
																			  	</select>
																				</td>
																				<td>
																					<input type="text" class="form-control" id="properti"/>
																				</td>
																				<td>
																					<input type="date" class="form-control" />
																				</td>
																				<td>
																					 <div class="input-group bootstrap-timepicker timepicker">
										                                                <input type="text" class="form-control input-small waktu_mulai" name="properti[jam_masuk][]" value="">
										                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
										                                            </div>
																				</td>
																				<td>
																					<div href="javascript:void(0);" class="btn btn-sm btn-success ">+</div>
																				</td>
                                        </tr>
                                        <tr></tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
					
				
					
					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Perkiraan Anggaran</legend>
              
					<div class="form-group">
						<label class="col-md-3 control-label">Kebutuhan Dana (Rp)<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars"></i>
								</div>
								<input type="number" required min="0" name="dana" id="dana" class="form-control" value="" />
							</div>
						</div>
					</div> 
                
					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Kepanitiaan</legend>
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="event_committee">Susunan Kepanitiaan<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input">
								<table class="table table-bordered grid_list_field" id="customFields">
								  <tbody>
									<tr>
									  <th>Nama Jabatan</th>
									  <th>Nama Lengkap</th>
									  <th>NIM</th>
									  <th>Aksi</th>
									</tr>
									<tr>
									  <td>
										<select required id="kepanitiaan" name="kepanitiaan[jabatan][]" class="form-control">
										  <option value=""></option>
										</select>
									  </td>
									  <td>
										<input required type="text" class="form-control" id="kepanitiaan" name="kepanitiaan[nama][]" value=""/>
									  </td>
									  <td>
										<input required type="number" class="form-control" id="kepanitiaan" name="kepanitiaan[nim][]" value=""/>
									  </td>
									  <td>
										<div href="javascript:void(0);" class="btn btn-sm btn-success addCF">+</div>
									  </td>
									</tr>
								  </tbody>
								</table>
							</div>
						</div>
					</div>

					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Berkas Pendukung</legend>
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="file_proposal">Proposal (Jenis file pdf - <strong>Maks 2MB</strong>)</label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-file"></i>
								</div>
								<input id="proposal" required type="file" class="form-control" name="proposal" accept=".pdf">
							</div>
						</div>
					</div>
                 
					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Request Undang Pejabat</legend>
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="is_pejabat_letter_necessary">Perlu dibuatkan surat undangan pejabat?</label>                       	
						<div class="col-md-7">
							<div class="input">
								<select class="form-control" id="pejabat" name="ques_pejabat">
								  <option value="no">No</option>
								  <option value ="yes" onClick="showDiv()">Yes</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div id="hidden2" style="display: none;">
							<label class="col-md-3 control-label">Rundown Acara(Jenis file pdf)</label>
  								<div class="col-md-7">
									<div class="input-group">
									  <div class="input-group-addon">
										<i class="fa fa-file"></i>
									  </div>
									  <input id="rekening" type="file" class="form-control" name="rundown" accept=".pdf">
									</div>
								</div>

							<div class="col-md-7 col-md-offset-3">
							 				     
								<div class="input">
								  <table class="table table-bordered grid_list_field" id="customFieldsSSpejabat">
									<tbody>
									  <tr>
										<th>Ditujukan Kepada</th>
										<th>Nama Instansi</th>
										<th>Alamat Instansi</th>
										<th></th>
									  </tr>
									  <tr>
										<td>
										  <input type="text" class="form-control" id="pejabat" name="undang_pejabat[ditujukan_kepada_pejabat][]"/>
										</td>
										<td>
										  <input type="text" class="form-control" id="pejabat" name="undang_pejabat[nama_instansi][]" />
										</td>
										<td>
										  <input type="text" class="form-control" id="pejabat" name="undang_pejabat[alamat_instansi][]" />
										</td>
										<td>
										  <div href="javascript:void(0);" class="btn btn-sm btn-success addSSpejabat">+</div>
										</td>
									  </tr>
									  <tr></tr>
									</tbody>
								  </table>
								</div>
							</div>
						</div>
					</div>
					
					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Target Sponsor</legend>    
					<div class="form-group">
						<label class="col-md-3 control-label" for="is_sponsorship_letter_necessary">Perlu dibuatkan surat pengantar sponsorship?</label>                       	
						<div class="col-md-7">
							<div class="input">
								<select class="form-control" id="sponsorship" name="ques_sponsor">
								  <option value="no">No</option>
								  <option value ="yes" onClick="showDiv()">Yes</option>
								</select>
							</div>
						</div>
					</div>
				
					<div class="form-group">
						<div id="hidden" style="display: none;">
							<div class="col-md-7 col-md-offset-3">
								<div class="input">
								  <table class="table table-bordered grid_list_field" id="customFieldsSS">
									<tbody>
									  <tr>
										<th>Ditujukan Kepada</th>
										<th>Nama Perusahaan</th>
										<th>Alamat Perusahaan</th>
										<th></th>
									  </tr>
									  <tr>
										<td>
										  <input type="text" class="form-control" id="sponsor" name="ditujukan_kepada[]" />
										</td>
										<td>
										  <input type="text" class="form-control" id="sponsor" name="nama_perusahaan[]" />
										</td>
										<td>
										  <input type="text" class="form-control" id="sponsor" name="alamat_perusahaan[]"/>
										</td>
										<td>
										  <div href="javascript:void(0);" class="btn btn-sm btn-success addSS">+</div>
										</td>
									  </tr>
									  <tr></tr>
									</tbody>
								  </table>
								</div>
							</div>
						</div>
					</div>
			

					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Contact Person Kegiatan</legend>	
					<div class="form-group">
						<label class="col-md-3 control-label">NIM<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
								  <i class="fa fa-bars"></i>
								</div>
								<input required type="text" id="responsible_nim" class="form-control" name="responsible_nim" >
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Lengkap<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
								  <i class="fa fa-bars"></i>
								</div>
								<input  type="text"  id="finalResult" class="form-control" name="responsible_name" >       
						</div>
					</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Kontak/No. Hp<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars"></i>
								</div>
								<input required type="number" class="form-control" name="responsible_kontak" >
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Email<span style="color: red">*</span></label>
						<div class="col-md-7">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-bars"></i>
								</div>
								<input required type="email" class="form-control" name="responsible_email" >
							</div>
						</div>
					</div>
					
					<legend style="border-bottom:3px solid #00c0ef;padding:5px 10px;color:#00c0ef;">Dokumen</legend>
					<div class="form-group">
						<label class="col-md-3 control-label">Dokumen yang dibutuhkan<span style="color: red">*</span></label>
						<div class="col-md-6 col-sm-12">
							<div class="checkbox">
								<label>
								  <input type="checkbox"  value="1" checked="checked">Surat Ijin Kegiatan
								</label>
							</div>

							<div class="checkbox">
								<label>
								  <input type="checkbox" value="1" checked="checked">Surat Ijin Fasilitas
								</label>
							</div>
							
							<div class="checkbox">
								<label>
								  <input type="checkbox"  value="1" checked="checked">Surat Ijin Kendaraan Masuk Kampus
								</label>
							</div>
							
							<div class="checkbox">
								<label>
								  <input type="checkbox" value="1" checked="checked">Surat Pengesahan
								</label>
							</div>
							
							<div class="checkbox">
								<label>
								  <input type="checkbox"  value="1" checked="checked">Surat Permohonan Mengundang Pejabat
								</label>
							</div>

              <div class="checkbox">
                  <label>
                      <input type="checkbox" value="1" checked="checked">Surat Rekomendasi Sponsor
                 </label>
              </div>
						</div>
					</div>
		
				<div class="box-footer" clearfix>
				<button type="submit" class="btn btn-primary" value="Upload"><span class="fa fa-send id='ok'"></span>  Simpan</button>
			</div> 
		</div>
		
        </form>		
		
    </div>
  </div>
</section>
