<section class="content">
	<div class="row">
	   <div class="col-xs-12">

         <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Detail Pertemuan</h3>
            <br>
            <br>
            <?php foreach ($meeting_details as $meeting_detail): ?> 
            <p>Pertemuan ke- : <?php echo $meeting_detail['no_pertemuan']; ?></p>
            <!-- <p>Judul Pertemuan : </p> -->
            <p>Pembicara : <?php echo $meeting_detail['pembicara']; ?></p>
            <p>Tempat : <?php echo $meeting_detail['tempat']; ?></p>
            <p>Waktu : <?php echo $meeting_detail['waktu_mulai']; ?> - <?php echo $meeting_detail['waktu_selesai']; ?></p>
            <p>Semester : <?php echo $meeting_detail['id_semester']; ?></p>
            <!-- <p>Tahun Ajaran : <?php echo $meeting_detail['tahun_ajaran']; ?></p> -->
            <?php endforeach; ?>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Resume</th>
                  <th>Download Resume</th>
                  <th>Plagiarism Check</th>
                  <th>Nilai</th>
                  <th>Waktu Submit</th>
                  <th>Waktu Penilaian</th>
                  <th>Penilai</th>
                </tr>
                </thead>
                
                <tbody>
                <?php foreach ($resume_lists as $resume_list): ?>
                <tr>
                    <td><?php echo $resume_list['id_resume']; ?></td>
                    <td><?php echo $resume_list['nim_peserta']; ?></td>
                    <td><?php echo $resume_list['konten']; ?></td>
                    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url(). 'admin/Resume/download?id='. $resume_list['id_resume'] . '&nim=' . $resume_list['nim_peserta']; ?>">Download Resume</a></td>
                    <td></td>
                    <td>
                      <?php echo $resume_list['nilai']; ?>
                       <a class="btn btn-success btn-sm" href="<?php echo base_url(). 'admin/Resume/edit?id='. $resume_list['id_resume']; ?>">Edit</a>
                    </td>
                    <td><?php echo $resume_list['timestamp_submit']; ?></td>
                    <td><?php echo $resume_list['timestamp_nilai']; ?></td>
                    <td><?php echo $resume_list['dinilai_oleh']; ?></td>
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