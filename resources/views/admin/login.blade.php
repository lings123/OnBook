<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" >
    <meta name="author" content="">
    <title>Đăng nhập</title>                      <!--  phai gắn base href để có thể link đế href đúng đén folder public -->
    <!-- Bootstrap Core CSS -->
    <link href="public/admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="public/admin_asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/admin_asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="public/admin_asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="public/admin_asset/css/mystyle.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                    
                <div class='register-block form-register' style="margin-top: 20%">
                    <p class="login-title text-center">Đăng Nhập</p>
                    
                    @if($message=Session::get('errors'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $message}}
                            </div>
                     @endif
                    <form role="form" action="{{ URL::to('admin/dashbroad')}}" method="POST">
                        
                        <div class="field field__input-wrapper">
                            <label class="field__label" for="input-email">Email</label>
                            <input class="field__input" id="input-email" name="email" type="email" placeholder="Email" required>
                        </div>
                        <div class="field field__input-wrapper">
                            <label class="field__label" for="input-email">Mật khẩu</label>
                            <input class="field__input" id="input-email" type="password" name="password"  placeholder="Mật khẩu" required>
                        </div>
                        <div class="field__input-wrapper" style="margin-top: 15px;">
                            <input type="submit" name="login" value="Đăng nhập" class="btn__submit" >
                        </div>
                          {{csrf_field()}}

                    </form>
                    <div style="clear:both"></div>
        
                        <!-- In Thông báo -->
           
                        
                </div>
            </div>
        </div>
    </div>

<!-- jQuery -->
    <script src="public/admin_asset/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="public/admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="public/admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="public/admin_asset/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        $('.field__input').on('input', function (){
            var field = $(this).closest('.field__input-wrapper');
            if (this.value) {
                field.addClass('field__input-active');
            } else {
                field.removeClass('field__input-active');
            }
        });
    </script>
</body>

</html>
