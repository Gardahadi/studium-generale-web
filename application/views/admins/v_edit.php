<section class="content">
	<div class="row">
	   <div class="col-xs-12">

         <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Edit Nilai Resume</h3>
            <br>
            <br>
            

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php foreach($resume_details as $u){ ?>
	          <form action="<?php echo base_url(). 'admin/Resume/update'; ?>" method="post">
              <table id="example1" class="table table-bordered table-striped">
                <tr>
                    <td>No</td>
                    <td>
                        <?php echo $u['id_resume']; ?>
                        <input type="hidden" name="idResume" value="<?php echo $u['id_resume']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td><?php echo $u['id_absensi']; ?></td>
                </tr>
                <tr>
                    <td>Resume</td>
                    <td><?php echo $u['konten']; ?></td>
                </tr>
                <tr>
                    <td>Nilai</td>
                    <td><input type="text" name="nilai" value="<?php echo $u['nilai']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Simpan"></td>
                </tr>
              </table>
              </form>	
	          <?php } ?>
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