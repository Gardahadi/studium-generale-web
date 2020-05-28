<link rel="stylesheet" href="<?php echo base_url("assets/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css"); ?>">

<body class="text-center">
    <div class="container" style="width:500px; margin:0 auto; align-items:center; display:flex; height:100%;">
      <form class="signin jumbotron" action="<?php echo base_url().'peserta/login/login'; ?>" method="post">
        <h2>Please sign in</h2>

        <div class="errmsg" style="color: red">
          <p><?php if($alert['status'] == 'fail') {echo $alert['message']; }?></p>
        </div>

        <div class="form-group">
          <label for="inputEmail" class="sr-only">Username</label>
          <input class="form-control" placeholder="Username" type="text" name="username" required>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>

</body>