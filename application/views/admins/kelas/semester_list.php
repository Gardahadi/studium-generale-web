<section class="content-header">
    <h3 class="box-title">Data Kelas Berdasarkan Semester</h3>
</section>

<section class="content">
	<div class="row">
	    <div class="col-xs-12">
            <div class="box box-primary col-lg-12">
                <div class="box-header">
                    <?php if($alert['status'] == 'success') { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                            <h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message'];?>
                        </div>
                    <?php } else if($alert['status'] == 'fail') { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                            <h4><i class="icon fa fa-remove"></i> Gagal!</h4><?php echo $alert['message'];?>
                        </div>
                    <?php } ?>
                    <a href="<?=base_url().'admin/kelas/form'?>" class="btn btn-social btn-dropbox btn-sm pull-right">
                        <i class="fa fa-plus" href=""></i> Tambah Kelas
                    </a>
                </div>

                <div class="box-body">
                    <div class="list-group">
                        <?php foreach ($semesters as $semester): ?> 
                            <div class="list-group-item list-group-item-action row">
                                <div class="col-md-10">
                                    <a href=<?php echo base_url().'admin/kelas/all/'.$semester['id_semester'];?>>
                                        <h2>Tahun ajaran <?php echo $semester['tahun_ajaran']?> Semester <?php echo $semester['semester']?></h2><br>
                                        Awal perkuliahan: <?php echo $semester['start_date']?> <br>
                                        Akhir perkuliahan: <?php echo $semester['end_date']?> <br>
                                        Topik tugas akhir: <?php echo $semester['topik_tugas_akhir']?> <br>
                                        Deadline tugas akhir: <?php echo $semester['deadline_tugas_akhir']?>
                                    </a>
                                </div>
                                <div class="col-md-1 align-items-center">
                                    <a href= <?php echo base_url().'admin/kelas/form/'.$semester['id_semester']; ?>><button class="btn btn-success btn-sm">Edit</button></a>
                                </div>
                            </div>
                        <?php endforeach; ?>	
                    </div> 
                    <ul class="pagination pagination-sm no-margin pull-left"></ul>
                </div>
            </div>
		</div>
    </div>
</section>