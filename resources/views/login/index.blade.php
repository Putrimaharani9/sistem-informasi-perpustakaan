<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $pageTitle . ' - ' . getSetting('app_name') }}</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ '/img/' . getSetting('app_icon') }}" type="image/x-icon">

    <style>
        @media screen and (max-width: 1080px) {
            .login {
                flex-direction: column;
                height: fit-content !important;
                margin-inline: 20px;
                align-items: center;
            }

            .login__left {
                width: 100% !important;
                height: 100px !important;
            }

            .login__right {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; opacity: 0" id="content">
        <div class="bg-white shadow-lg d-flex rounded-lg overflow-hidden login"
            style="max-width: 1000px; height: 350px; width: 100%;">
            <div style="width: 50%; height: 100%" class="login__left">
                <img src="{{ '/img/coverreal.png' . getSetting('app_cover') }}" alt=""
                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center px-5 py-5 login__right"
                style="width: 50%; height: 100%; gap: 0px;">
                <div style="display: flex; align-items: center; gap: 30px;">
                    <div style="width: 40px; aspect-ratio: 1;">
                        <img src="{{ '/img/logo1.png' . getSetting('app_icon') }}" alt=""
                            style="width: 200%; height: auto; object-fit: contain; display: block;">
                    </div>
                    <div>
                        <h1 class="text-center h5">{{ getSetting('app_name') }}</h1>
                        <h5 class="text-white fw-bold">
                            ADMIN LOGIN
                        </h5>
                    </div>
                </div>


                <form action="{{ route('authenticate') }}" method="POST" class="d-flex flex-column" id="login-form"
                    style="width: 100%;">
                    @csrf
                    <div class="form-group">
                        <input type="text" name='email'
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">

                        @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name='password'
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            id="exampleInputPassword" placeholder="Password">

                        @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <input style="display: none;" name="device_id" />

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>

                    <!-- <button type="button" onclick="testNotification()" class="btn btn-secondary btn-user btn-block">
                        Test Notification
                    </button> -->
                </form>
            </div>
        </div>
    </div>

    @include('partials.firebase')

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $("#content").animate({
                opacity: 1
            }, 800);

            // Request notification permission
            Notification.requestPermission();
        });

        const testNotification = () => {
            $.get('/test-notification');
        }
    </script>
</body>

</html>
