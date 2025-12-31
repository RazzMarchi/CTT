<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Aplikasi Cuti Pegawai</title>

    <!-- Bootstrap & CSS -->
    <link rel="stylesheet" href="/aplikasi-cuti/assets/bootstrap.min.css">
    <link rel="stylesheet" href="/aplikasi-cuti/assets/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 360px;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .login-header {
            background: #020617;
            color: #fff;
            padding: 22px;
            text-align: center;
        }

        .login-header h5 {
            margin-bottom: 6px;
            font-weight: 600;
        }

        .login-body {
            background: #ffffff;
            padding: 28px;
            text-align: center;
        }

        .form-control {
            height: 38px;
            width: 85%;
            margin: 0 auto;
            font-size: 14px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
            text-align: left;
            width: 85%;
            margin: 0 auto 4px;
            display: block;
        }

        .btn-login {
            margin-top: 22px;
            width: 70%;
            height: 46px;
            font-size: 16px;
            font-weight: 600;
            background: #2563eb;
            border: none;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .login-footer {
            margin-top: 18px;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>

<div class="login-card">

    <!-- HEADER -->
    <div class="login-header">
        <h2>Aplikasi Cuti Tahunan Tambahan Pegawai</h2>
        <small>Kanwil Ditjen Perbendaharaan Provinsi NTT</small>
    </div>

    <!-- BODY -->
    <div class="login-body">

        <form method="post" action="proses_login.php">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-login text-white">
                LOGIN
            </button>

        </form>

        <div class="login-footer">
            © <?= date('Y') ?> Kanwil DJPb Provinsi NTT
        </div>
    </div>

</div>

<script src="/aplikasi-cuti/assets/bootstrap.bundle.min.js"></script>
</body>
</html>
