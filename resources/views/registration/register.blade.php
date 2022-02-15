<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="container">
        <div class="row justify-content-md-center">
        <div class="col-md-6 col-md-auto" >
            <div class=" animated fadeInDown m-t">
                <div class="text-center">
                  <img  src="images/logo-only.png" style="width: 20%;height: 20%" >
                <br><br>
                </div>
                    <div class="ibox">
                        <div class="ibox-content">
                            <form class="m-t"  action="user-actions/register" method="POST">
                                {{ csrf_field() }}
                                @include('include.flash')
                                @include('include.errors')
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                       <b>Personal Information</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group  row align-left"><label class="col-sm-4 col-form-label">First Name *</label>
                                            <div class="col-sm-8"><input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control @error('title') is-invalid @enderror"></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Last Name</label>
                                            <div class="col-sm-8"><input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                       <b>Security Information</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group  row align-left"><label class="col-sm-4 col-form-label">Username (Email) *</label>
                                            <div class="col-sm-8"><input type="text" name="username" value="{{ old('username') }}" class="form-control"></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Password *</label>
                                            <div class="col-sm-8"><input type="password" name="password"  class="form-control"></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Confirm Password *</label>
                                            <div class="col-sm-8"><input type="password" name="password_confirmation" class="form-control"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <b> Company Information</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Company Name</label>
                                            <div class="col-sm-8 "><input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control "></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Address</label>
                                            <div class="col-sm-8"><input type="text" name="company_address" value="{{ old('company_address') }}" class="form-control"></div>
                                        </div>
                                        <div class="form-group  row "><label class="col-sm-4 col-form-label">Email *</label>
                                            <div class="col-sm-8"><input type="email" name="company_email" value="{{ old('company_email') }}" class="form-control"></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Contact (Mobile) *</label>
                                            <div class="col-sm-8"><input type="text" name="company_contact_mobile" value="{{ old('company_contact_mobile') }}" class="form-control"></div>
                                        </div>
                                        <div class="form-group  row"><label class="col-sm-4 col-form-label">Contact (Office) </label>
                                            <div class="col-sm-8"><input type="text"  name="company_contact_office" value="{{ old('company_contact_office') }}" class="form-control"></div>
                                        </div>
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-success block full-width m-b">REGISTER</button>

                                <p class="text-muted text-center"><small><b>Do you already have an account?</b></small></p>
                                <a class="btn btn-danger btn-outline block full-width m-b " href="/login">LOGIN</a>

                            </form>
                        </div>
                    </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
