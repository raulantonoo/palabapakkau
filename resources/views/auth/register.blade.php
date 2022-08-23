<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
    <link href="../../../../global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/colors.min.css" rel="stylesheet" type="text/css" />
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="../../../../global_assets/js/main/jquery.min.js"></script>
    <script src="../../../../global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="../../../../global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="../../../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="../../../../global_assets/js/demo_pages/login.js"></script>
    <!-- /theme JS files -->
    <style>
        body {
            background-image: url(../images/loginform-bg.png);
            max-width: 100%;
            /*width:100%;*/
            height: auto;
            background-size: cover;

        }

        .trans {
            opacity: 0.97;
        }
    </style>
</head>

<body>
    <!-- Page content -->
    <div class="page-content ">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center pt-0">
                <!-- Login form -->
                <form class="login-form wmin-sm-400" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card mb-0 trans">
                        <ul class="nav nav-tabs nav-justified bg-dark mb-0">
                            <li class="nav-item">
                                <a href="#login-tab1" class="nav-link border-y-0 border-left-0 active" data-toggle="tab">
                                    <h6 class="my-1">Sign in</h6>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content card-body">
                            <div class="tab-pane fade show active" id="login-tab1">
                                <div class="text-center mb-3">
                                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                    <h5 class="mb-0">Create account</h5>
                                    <span class="d-block text-muted">All fields are required</span>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama" />
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" />
                                    <div class="form-control-feedback">
                                        <i class="icon-user-check text-muted"></i>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" />
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" />
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login form -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</body>

</html>