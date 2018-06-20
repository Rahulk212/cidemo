<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Invoice</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url(); ?>admincssjs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>admincssjs/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url(); ?>admincssjs/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="javascript:void(0)">Invoice</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">

                <p class="login-box-msg"><b>Login</b></p>
                <?= validation_errors('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
				<div class="widget">
						
				</div>
				
				<div class="widget">

				</div>
                <form action="<?php echo base_url(); ?>login" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>

           
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url(); ?>admincssjs/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url(); ?>admincssjs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>admincssjs/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    </body>
</html>
