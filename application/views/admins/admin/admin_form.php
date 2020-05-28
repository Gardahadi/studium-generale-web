<section class="content-header">
	<h1>Admin<small>Form untuk menambahkan admin baru</small>
        <a href=<?php echo base_url().'admin/admin' ?>>
			<button class="btn btn-warning btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</button>
		</a>
	</h1>	
</section>

<script>
	let usernameSuperAdmin = "";
	let usernamePenilai = "";
	let startDate = "";
	let endDate = "";

    $(document).ready(function () {
        var role = $('#adminRole').find(":selected").text();
        if (role === "Superadmin") {
            console.log("lalala")
            showSuperAdmin();
        } else if (role === "Admin Penilai") {
            showAdminPenilai();
        }

        $("select#adminRole").change(function(){
            var role = $(this).children("option:selected").val();
            if (role === "Superadmin") {
                showSuperAdmin();
            } else if (role === "Admin Penilai") {
                showAdminPenilai();
            }
        });

        $('.simpan').click(function (e) {
            var valid = true;
            var role = $('#adminRole').find(":selected").text();
            if (role === "Superadmin") {
                if ($('#usernameAdmin').val() === "" || $('#password').val() === "") {
                    valid = false;
                    alert("Username / pass belum diisi");
                }
            } else if (role === "Admin Penilai") {
                if ( $('#usernamePenilai').val() === "" ||  $('#startDate').val() === "" ||  $('#endDate').val() === "") {
                    valid = false;
                    alert("Username / start - end date belum diisi");
                }
            }

            if (!valid) {
                e.preventDefault();
            }
        })
    })
    

	function showSuperAdmin(){
		usernameSuperAdmin = $('#usernameAdmin').val();
		$('.superadmin').show();
		$('.adminPenilai').hide();
		$('#usernameAdmin').val(usernameSuperAdmin);
	}

	function showAdminPenilai(){
		usernamePenilai = $('#usernamePenilai').val();
		startDate = $('#startDate').val();
        endDate = $('#endDate').val()
		$('.superadmin').hide();
        $('.adminPenilai').show();
		$('#usernamePenilai').val(usernamePenilai);
		$('#startDate').val(startDate);
        $('#endDate').val(endDate);
	}
</script>

<section class="content">
  <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal" action="<?php if ($method == 'edit') {echo base_url().'admin/admin/edit';} else {echo base_url().'admin/admin/add';} ?> " enctype="application/x-www-form-urlencoded" method="POST">		
        <?php if ($method == 'edit') {echo '<input type="hidden" name="id" value="'.$admin->id_admin.'">';}?>
        <div class="box box-info">
			<div class="box-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Admin Role </label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bars"></i>
                            </div>
                            <select class="form-control adminRole" id="adminRole" name="adminRole" value="<?php if ($method == 'edit') {echo $admin->admin_role;}?>">
                                <option value="Superadmin" <?php if ($method == 'edit' && $admin->admin_role=="Superadmin") {echo "selected=\"selected\"";}?>>Superadmin</option>
                                <option value="Admin Penilai" <?php if ($method == 'edit' && $admin->admin_role=="Admin Penilai") {echo "selected=\"selected\"";}?>>Admin Penilai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="superadmin">
                    <div class="form-group">
                        <label for="usernameSuperAdmin" class="col-md-3 control-label">Username </label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control col-md-8" id="usernameAdmin" name="usernameAdmin" value="<?php if ($method == 'edit' && $admin->admin_role == 'Superadmin') {echo $admin->username;}?>">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password </label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                                <input type="password" class="form-control col-md-8" id="password" name="password">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="adminPenilai" style="display: none">
                    <div class="form-group">
                        <label for="usernamePenilai" class="col-md-3 control-label">Username </label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control col-md-8" id="usernamePenilai" name="usernamePenilai" value="<?php if ($method == 'edit' && $admin->admin_role == 'Admin Penilai') {echo $admin->username;}?>">
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="startDate" class="col-md-3 control-label">Start Date</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                                <input readonly class="form-control" data-provide="datepicker" id="startDate" name="startDate" value="<?php if ($method == 'edit') {echo $admin->start_date;}?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="endDate" class="col-md-3 control-label">End Date</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                                <input readonly class="form-control" data-provide="datepicker" id="endDate" name="endDate" value="<?php if ($method == 'edit') {echo $admin->end_date;}?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer" clearfix >
                    <button type="submit" class="btn btn-primary simpan" style="float: right;">Simpan</button>
                </div> 
			
			</div>

    	</div>
        </form>		
		
    </div>
  </div>
</section>
