<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrSmart Project Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #40516d, #c2e9fb);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            position: relative;
            width: 400px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,  #a3bfd4, #75736b);
            clip-path: circle(30% at 0% 50%);
            transition: all 0.5s ease-in-out;
        }

        .login-container:hover::before {
            clip-path: circle(80% at 0% 50%);
        }

        .login-logo {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-logo a {
            text-decoration: none;
            color: inherit;
        }

        .login-form {
            position: relative;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #f0f0f0;
            font-size: 18px;
            transition: all 0.3s ease-in-out;
        }

        input:focus,
        select:focus {
            outline: none;
            background: #e0e0e0;
        }

        button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background: #627381;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background: #4a69bd;
        }

        .register-link {
            text-align: center;
        }

        .register-link a {
            color: #6a89cc;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-logo">
            <a href="index.html"><span>DrSm@rt</span></a>
        </div>
        <div class="login-form">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label>User Type</label>
                    <select class="form-control" id="userType" name="userType">
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
              
            </form>
        </div>
    </div>
</body>

</html>
