<section class="content">
	<div class="row">
	   <div class="col-xs-12">

         <div class="box box-primary">
           <?php if($alert['status'] == 'success') { ?>
              <div class="alert alert-success alert-dismissible">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
              <h4><i class="icon fa fa-check"></i> Sukses!</h4><?php echo $alert['message']; ?></div>
            <?php } ?>

            <div class="box-header">
                <h3 class="box-title">Data Peserta</h3>
        
            </div>
            <!-- Form -->
            <form class="form-horizontal" action="<?=base_url().'admin/peserta/all'?>" method="GET" id="search-form">
                <div class="col-md-3">
                        <div class="input-group">
                            <input placeholder="Ketik NIM / Nama" type="text" class="form-control col-md-8" id="q" name="q" value="<?php echo $params['q'] ?>">
                        </div>
                </div>

                <div class="col-md-3">
                  <select class="form-control" name="kelas">
                    <option disabled <?php if(sizeof($daftar_kelas) == 0) echo "selected" ?> value> -- kelas -- </option>
                    <?php foreach($daftar_kelas as $kelas) { ?> 
                      <option value="<?php echo $kelas->id_kelas ?>" <?php if($kelas->id_kelas == $params['kelas']) echo "selected" ?>><?php echo $kelas->no_kelas ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-1">
                  <button class="btn btn-primary btn-sm" type="submit" form="search-form" value="Submit" >
                    Filter
                  </button>
                </div>
            </form>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>No Kelas</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                
                <tbody>
                <?php $no = 0; ?>
                <?php foreach ($daftar_peserta as $peserta): ?> 
                <tr>
                    <td><?php echo $peserta->nim; ?></td>
                    <td><?php echo $peserta->nama; ?></td>
                    <td><?php echo $peserta->no_kelas; ?></td>
                    <form action="<?=base_url().'admin/peserta/changestatus'?>" method="POST">
                      <td>
                        <select class="form-control" name="status">
                          <option value="0" <?php if($peserta->status == 0) echo "selected"; ?>>Tidak Aktif</option>
                          <option value="1" <?php if($peserta->status == 1) echo "selected"; ?>>Aktif</option>
                        </select>
                      </td>
                      <input type="hidden" value="<?php echo $peserta->nim; ?>" name="nim">
                      <input type="hidden" value="peserta" name="page">
                      <td>
                        <input class="btn btn-danger btn-sm" type="submit" role="button" value="Ganti Status">
                      </td>
                    </form>
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