<section class="content-header">
	<h1>Studium Generale<small> </small>
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
                <div class="box-header with-border">
                    <h3 class="box-title">Dashboard</h3>
                </div>
				<div class="box-body">
            
                    <!-- <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-2 col-md-4 column-5">
                                <div class="wrimagecard wrimagecard-topimage">
                                    <div class="wrimagecard-topimage_header" style="background-color:#e0f2f1 ">
                                        <h3 class="box-title">SG-1</h3>
                                    </div>
                                    <div class="caption">
                                        <span class="date">20 Februari 2020</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Narasumber</th>
                        <th>Resume</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php foreach ($pertemuan_kelas as $sg_class): ?>
                        <tr>
                            <td><?php echo $sg_class->id_pertemuan; ?></td>
                            
                            <td>
                                <?php 
                                    $date = $sg_class->waktu_mulai;
                                    $date = strtotime($date);
                                    echo date('d M Y',$date);
                                ?>
                            </td>
                            
                            <td>
                                <?php 
                                    $date = $sg_class->waktu_mulai;
                                    $date = strtotime($date);
                                    echo date('H:i:s - ',$date);

                                    $date = $sg_class->waktu_selesai;
                                    $date = strtotime($date);
                                    echo date('H:i:s',$date);
                                ?>                            
                            </td>
                            <td><?php echo $sg_class->pembicara; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Upload</button>
                            </td>
                        </tr>
                    	<?php endforeach; ?>
                        </tbody>
                    </table>

		
				<div class="box-footer" clearfix style="float: right;">
			</div> 
		</div>
		
        </form>		
		
    </div>
  </div>
</section>
