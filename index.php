<?php
// Paramètres du login (modifiable ci-dessous)
$valid_username = 'admin';
$valid_password = 'admin123';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === $valid_username && $password === $valid_password) {
        header('Location: nouveau.php');
        exit();
    } else {
        $error = 'اسم المستخدم أو كلمة المرور غير صحيحة.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
    <link href="./cssTBord/2bootstrap.rtl.min.css" rel="stylesheet">
    <link href="./cssTBord/static" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', Arial, sans-serif;
            background: linear-gradient(135deg, #f7fafc 0%, #e9eef3 100%);
        }
		
.header {
   background: #1560BD;
border-color: #0D47A1;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* alignement à gauche */
 flex-direction: column;

}

.logo {
    height: 60px;
}

.logo-text {
    font-size: 1.2rem;
    font-weight: bold;
    color: #E3F2FD;
    line-height: 1.3;
}

        .main-title {
            font-size: 3.1rem;
            font-weight: bold;
            color: #25365c;
        }
        .subtitle {
            color: #456;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
        .card-login {
            border-radius: 18px;
            box-shadow: 0 8px 40px rgba(47, 66, 100, 0.08);
            background: #fff;
        }
        .card-login .form-control::placeholder {
            color: #a7b2c2;
            opacity: 1;
        }
        .login-btn {
            background:#1560BD;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            font-size: 1.2rem;
            padding: 0.7rem 0;
        }
        .login-btn:hover {
            background:#e3f2fd;
        }
        .input-icon {
            font-size: 1.1rem;
            color: #a7b2c2;
            margin-right: 0.5rem;
        }
        .footer {
            color: #456;
            font-size: 0.95rem;
            margin-top: 28px;
        }
        .error-msg {
            color: #c0392b;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="./cssTBord/bootstrap-icons.css">
</head>
<body>
  <header class="header">
        <img src="./cssTBord/R.png" alt="شعار الوزارة" class="logo">
        <div class="logo-text">وزارة الداخلية</div>
        <div class="logo-text">عمالة اقليم سطات</div>
    </header>
    <div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <!--<div class="text-center mt-5">
            <h1 class="main-title mb-2">تسجيل دخول المسؤول</h1>
            <div class="subtitle">مرحباً بك في لوحة تحكم إدارة الشكاوى.</div>
        </div>-->
        <div class="card card-login mx-auto p-4 mt-2" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h2 class="mb-3 text-center" style="font-weight:700; font-size:2.1rem; color:#295285;">تسجيل الدخول</h2>
                <div class="mb-2 text-center text-muted" style="font-size:1rem; color:#295285;">الرجاء إدخال بيانات الاعتماد الخاصة بك للوصول إلى لوحة الإدارة.</div>
                <?php if($error): ?>
                    <div class="error-msg"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">اسم المستخدم</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><img src="./cssTBord/icon/person.svg" class="icon" alt="Utilisateur"></span>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                placeholder="أدخل اسم المستخدم"
                                required
                                autofocus
                                value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                            >
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><img src="./cssTBord/icon/key.svg" class="icon" alt="Utilisateur"></span>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="أدخل كلمة المرور"
                                required
                            >
                        </div>
                    </div>
                    <button type="submit" class="btn login-btn w-100 mb-2">
                              تسجيل الدخول
                    </button>
                </form>
               <!-- <div class="footer text-center">© 2025 نظام إدارة الشكاوى. جميع الحقوق محفوظة.</div>-->
            </div>
        </div>
    </div>
</body>
</html>
