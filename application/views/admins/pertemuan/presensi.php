<section class="content-header">
	<h1>Presensi Pertemuan
        <a href=<?php echo base_url().'admin/pertemuan/all' ?>>
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>

<section class="content">
	<div class="row">
	   <div class="col-xs-12">

         <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Detail Presensi Pertemuan
            </h3>
            <br>
            <br>
            <?php foreach ($meeting_details as $meeting_detail): ?> 
            <p>Pertemuan ke- : <?php echo $meeting_detail['no_pertemuan']; ?></p>
            <p>Pembicara : <?php echo $meeting_detail['pembicara']; ?></p>
            <p>Tempat : <?php echo $meeting_detail['tempat']; ?></p>
            <p>Waktu : <?php echo $meeting_detail['waktu_mulai']; ?> - <?php echo $meeting_detail['waktu_selesai']; ?></p>
            <p>Semester : <?php echo $meeting_detail['id_semester']; ?></p>
            <p>Topik : <?php echo $meeting_detail['topik']; ?></p>
            <?php endforeach; ?>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Status</th>
                </tr>
                </thead>
                
                <tbody>
                <?php foreach ($presensi_lists as $presensi_list): ?>
                <tr>
                    <td><?php echo $presensi_list['nim']; ?></td>
                    <td><?php echo $presensi_list['nama']; ?></td>
                    <td><?php echo $presensi_list['kelas']; ?></td>
                    <td><?php echo $presensi_list['status']; ?></td>
                </tr>	
                <?php endforeach; ?>
                </tbody>
              </table>
              <ul class="pagination pagination-sm no-margin pull-left">
               
              </ul>
            </div>
          </div>
		</div>
    </div>

<style>
    p span{
        font-size: 1.5rem;
        vertical-align: middle;
        color: red;
        font-weight: bold;
    }
</style>