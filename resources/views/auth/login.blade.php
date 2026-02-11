<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Kios Bank</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            min-height:100vh;
            margin:0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont;
            background: url("{{ asset('assets/kiosbank.jpeg') }}") center / cover no-repeat;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
        }

        /* OVERLAY */
        body::before{
            content:"";
            position:absolute;
            inset:0;
            background:rgba(0,0,0,.55);
            z-index:0;
        }

        /* WRAPPER */
        .login-wrapper{
            position:relative;
            z-index:1;
            width:100%;
            padding:15px;
        }

        /* LOGO */
        .logo{
            width:90px;
            margin-bottom:20px;
            animation: fadeIn .6s ease;
        }

        /* CARD */
        .card{
            border:none;
            border-radius:14px;
            animation: fadeIn .6s ease;
        }

        .card-header{
            background:#fff;
            border-bottom:none;
            font-weight:600;
            letter-spacing:.5px;
        }

        /* INPUT */
        .form-control{
            transition: all .25s ease;
        }

        .form-control:focus{
            border-color:#0d6efd;
            box-shadow:0 0 0 .15rem rgba(13,110,253,.25);
        }

        /* ICON */
        .input-group-text{
            background:#f8f9fa;
            transition: background .3s ease;
        }

        .input-group:focus-within .input-group-text{
            background:#e7f1ff;
        }

        /* BUTTON */
        .btn-primary{
            border-radius:8px;
            transition: all .3s ease;
        }

        .btn-primary:hover{
            transform: translateY(-2px);
            box-shadow:0 6px 18px rgba(13,110,253,.35);
        }

        /* ANIMATION */
        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(15px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">

                <!-- LOGO (OPTIONAL) -->
                <img src="{{ asset('assets/logo-kios-bank.png') }}"
                     class="logo"
                     alt="Kios Bank"
                     onerror="this.style.display='none'">

                <div class="card shadow text-left">
                    <div class="card-header text-center">
                        LOGIN INVENTORY ASSET
                    </div>

                    <div class="card-body">

                        {{-- ERROR --}}
                        @if(session('error'))
                            <div class="alert alert-danger small">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf

                            <!-- EMAIL -->
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="email@example.com"
                                           required>
                                </div>
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           class="form-control"
                                           placeholder="••••••••"
                                           required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                              style="cursor:pointer"
                                              onclick="togglePassword()">
                                            <i class="bi bi-eye" id="eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                Login
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(){
    const pass = document.getElementById('password');
    const eye  = document.getElementById('eye');

    if(pass.type === 'password'){
        pass.type = 'text';
        eye.className = 'bi bi-eye-slash';
    }else{
        pass.type = 'password';
        eye.className = 'bi bi-eye';
    }
}
</script>

</body>
</html>
