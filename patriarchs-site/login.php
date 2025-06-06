<?php include('config.php'); ?>

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
    .login-form {
        background: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        max-width: 450px;
        width: 100%;
        margin: 40px auto;
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
        margin-bottom: 15px;
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

<div class="login-form">
    <h2 class="text-center mb-4" style="color:rgba(13, 13, 11, 0.6);">تسجيل الدخول</h2>
    <form method="POST" action="">
        <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
        <button type="submit" name="login" class="btn btn-primary">دخول</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];

        $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header("Location: home.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>كلمة المرور غير صحيحة.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>لا يوجد حساب بهذا البريد.</div>";
        }
    }
    ?>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.login-form input.form-control');
        inputs.forEach((input, index) => {
            setTimeout(() => {
                input.classList.add('visible');
            }, index * 300);
        });
    });
</script>

