<section class="content">
	<div class="row">
	   <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Data Admin</h3>
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
              <a href="<?=base_url().'admin/admin/form'?>" class="btn btn-social btn-dropbox btn-sm pull-right">
                  <i class="fa fa-plus" href=""></i> Tambah Admin
              </a>
        
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="admin_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Admin</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Start date</th>
                  <th>End date</th>
                </tr>
                </thead>
                
                <tbody>
                <?php foreach ($admins as $admin): ?> 
                <tr>
                    <td><?php echo $admin['id_admin']; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td><?php echo $admin['admin_role']; ?></td>
                    <td><?php $date = explode(' ', $admin['start_date']); echo $date[0];?></td>
                    <td><?php $date = explode(' ', $admin['end_date']); echo $date[0]; ?></td>
                    <td>
                        <a href = "<?=base_url().'admin/admin/form/'.$admin['id_admin']?>"> <button class="btn btn-success btn-sm">Edit</button></a>
                        <form action="<?=base_url().'admin/admin/delete'?>" method="POST" style="display:inline;">
                          <input type="hidden" value="<?php echo $admin['id_admin']?>" id="id_admin" name="id_admin">
                          <input class="btn btn-danger btn-sm" type="submit" role="button" value="Hapus">
                        </form>
                    </td>
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