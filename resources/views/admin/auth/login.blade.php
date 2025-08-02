<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Gamanak Travel Planner</title>

    <!-- Google Font: Poppins for a modern, travel-friendly feel -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1500964750372-8b51a67d1ea7?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(2px);
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.6); /* Dark overlay */
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background-color: #ffffffdd; 
        }

        .card-header {
            background-color: transparent;
            border-bottom: none;
            text-align: center;
            padding-top: 2rem;
        }

        .card-header h3 {
            color: #2C3E50;
            font-weight: 600;
        }

        .form-control {
            border-radius: 30px;
            padding-left: 40px;
        }

        .input-group-text {
            background-color: #3498DB;
            border: none;
            color: white;
            border-radius: 30px 0 0 30px;
        }

        .btn-primary {
            background-color: #2ECC71;
            border-color: #2ECC71;
            border-radius: 30px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #27AE60;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #ccc;
        }

        .logo {
            width: 80px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                    <h3>Admin Login</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <div class="footer-text">
                    © {{ date('Y') }} Gamanak Travel Planner. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>