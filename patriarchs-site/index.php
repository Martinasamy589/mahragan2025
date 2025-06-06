<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>CaterServ - تسجيل حساب جديد</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- روابط الاستايل -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>

    <style>
        body {
            background: linear-gradient(135deg,rgba(212, 167, 98, 0.7) 0%,rgb(252, 224, 167) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: 'Open Sans', sans-serif;
        }
        .contact-form {
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            max-width: 450px;
            width: 100%;
        }
        input.form-control {
            border: 2px solid rgba(212, 167, 98, 0.7);
            border-radius: 10px;
            padding: 15px 20px;
            background-color: #f8f9fa;
            transition: all 0.4s ease;
            box-shadow: none;
            transform: translateX(-30px);
            opacity: 0;
        }
        input.form-control.visible {
            transform: translateX(0);
            opacity: 1;
        }
        input.form-control:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 10px #00c6ff;
            outline: none;
            background-color: #ffffff;
        }
        button.btn-primary {
            background: linear-gradient(45deg,rgba(212, 167, 98, 0.7),rgb(237, 239, 229));
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-weight: 600;
            transition: background-position 3s ease infinite;
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            box-shadow: 0 5px 15px rgba(59, 61, 44, 0.6);
            width: 100%;
            cursor: pointer;
        }
        button.btn-primary:hover {
            background-position: 100% 50%;
            box-shadow: 0 0 20px rgba(0,198,255,0.9);
        }
        @keyframes gradientShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        .alert {
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="contact-form" id="registerForm">
        <h2 class="text-center mb-4" style="color:rgba(13, 13, 11, 0.6);">تسجيل حساب جديد</h2>
        <form method="POST" action="">
            <input type="text" name="name" class="form-control mb-3" placeholder="الاسم" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" class="form-control mb-4" placeholder="كلمة المرور" required>
            <button type="submit" name="register" class="btn btn-primary">تسجيل</button>
        </form>

        <?php
        if (isset($_POST['register'])) {
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
            if ($check->num_rows > 0) {
                echo "<div class='alert alert-danger'>البريد مستخدم من قبل.</div>";
            } else {
                $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
                echo "<div class='alert alert-success'>تم التسجيل بنجاح!</div>";
            }
        }
        ?>
    </div>

    <script>
        // عند تحميل الصفحة، نعرض الحقول واحدة تلو الأخرى بحركة انزلاق وتلاشي
        window.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input.form-control');
            inputs.forEach((input, index) => {
                setTimeout(() => {
                    input.classList.add('visible');
                }, index * 300);
            });
        });
    </script>

</body>
</html>
