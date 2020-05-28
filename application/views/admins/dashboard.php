<section class="content-header">
	<h1>Dashboard Administrator SG<small>Berisi informasi seluruh kelas dan pertemuan mata kuliah Studium Generale tahun ajaran XX Semester XX</small>
	</h1>	
</section>
<br>

<section class="container-fluid">
	<div class="row">
	   <div class="col-lg-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Daftar Kelas </h3>
                </div>
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>No Kelas</th>
                    <th>Dosen</th>
                    <th>Jumlah Mahasiswa</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <?php foreach ($classes as $class): ?> 
                    <tr>
                        <td><?php echo $class['no_kelas']; ?></td>
                        <td><?php echo $class['nama_dosen']; ?></td>
                        <td><?php echo $class['jumlah']; ?></td>
                    </tr>
                    <?php endforeach; ?>		
                    </tbody>
                </table>
                <ul class="pagination pagination-sm no-margin pull-left">
                
                </ul>
                </div>

            </div>
        </div>

	   <div class="col-lg-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Daftar Pertemuan</h3>
                </div>

            </div>
		</div>
    </div>
</section>