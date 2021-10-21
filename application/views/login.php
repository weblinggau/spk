
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Universitas Binas Insan </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/'); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/'); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/'); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('assets/'); ?>vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/'); ?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <div class="x_panel">
                <div class="x_title"><h4><span class="fa fa-user"></span> Login Sistem</h4></div>
                <div class="x_content">
                    <form action="<?php echo site_url('/login/act'); ?>" method="post" style="text-align: left;">
                        <div class="form-group" style="text-shadow: 0 0 0px #d0d0d0;">
                            <?php echo $this->session->flashdata('success'); ?>
                            <?php echo $this->session->flashdata('failed'); ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" required="" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required="" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" required="" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Pimpinan</option>
                                <option value="3">Mahasiswa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="btn btn-sm btn-primary col-md-12">Login</button>
                        </div>
                        <div class="form-group" style="margin-top: 50px;">
                            Belum punya akun ? <a href="#signup" class="to_register">Buat akun</a>
                        </div>
                    </form>
                    <small>Universitas Bina Insan; 2021</small>
                </div>
            </div>
          </section>
        </div>

        <div id="register" class="animate form registration_form" style="margin-top: -40px;">
          <section class="login_content">
            <div class="x_panel">
                <div class="x_title"><h4><span class="fa fa-user-plus"></span> Register</h4></div>
                <div class="x_content">
                    <form action="<?php echo site_url('/login/registrasi'); ?>" method="post" style="text-align: left;">
                        <div class="form-group" style="text-shadow: 0 0 0px #d0d0d0;">
                        <?php echo $this->session->flashdata('faileds'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_user" required="" placeholder="Nama Lengkap" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" required="" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required="" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required="" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary col-md-12">Daftar</button>
                        </div>
                        <div class="form-group" style="margin-top: 60px;">
                            Sudah punya akun ? <a href="#signin" class="to_register">Login</a>
                        </div>
                    </form>
                    <small>Copyright &copy; 2021</small>
                </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
