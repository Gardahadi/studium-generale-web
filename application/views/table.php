	<section class="content">
	<div class="row">
	   <div class="col-xs-12">
         <div class="alert alert-success alert-dismissible">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          <h4><i class="icon fa fa-check"></i> Sukses!</h4>Pesan Sukses..</div>

           <div class="alert alert-warning alert-dismissible">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          <h4><i class="icon fa fa-remove"></i> Gagal!</h4>Pesan Gagal..</div>
         
         
          <br>
         <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Data</h3>
            <a href="<?=base_url().'admin/mahasiswa/perizinan/add_pengabdian'?>" class="btn btn-social btn-dropbox btn-sm pull-right">
                <i class="fa fa-plus"></i> Tambah
            </a>
        
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kolom 1</th>
                  <th>Kolom 2</th>
                  <th>Kolom 3</th>
                  <th>Kolom 4</th>
                  <th>Kolom 5</th>
                  <th>Kolom 6</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                 
          				<tr>
                    <td>1</td>
                    <td>Konten 1</td>
            				<td>Konten 2</td>
                    <td>Konten 3</td>
                    <td>Konten 4</td>
                    <td>Konten 5</td>
                    <td>Konten 6</td>
                    <td>
                      <button class="btn btn-success btn-sm">
                        <i class="fa fa-search"></i>
                      </button>
                       <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
          				</tr>
                  <tr>
                    <td>2</td>
                    <td>Konten 1</td>
                    <td>Konten 2</td>
                    <td>Konten 3</td>
                    <td>Konten 4</td>
                    <td>Konten 5</td>
                    <td>Konten 6</td>
                    <td>
                      <button class="btn btn-success btn-sm">
                        <i class="fa fa-search"></i>
                      </button>
                       <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
          				
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              <ul class="pagination pagination-sm no-margin pull-left">
               
              </ul>
            </div>
          </div>
		</div>
	</div>