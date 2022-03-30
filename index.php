<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация - Тестовое задание greensight.ru</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .form-blocked {
            width: -webkit-fill-available;
            height: -webkit-fill-available;
            background: #ffffff8c;
            z-index: 1;
            position: absolute;
            display: none;
        }
        .btn-primary.disabled, .btn-primary:disabled {
            opacity: 0.5;
        }
    </style>

    <script>const minilife = {}</script>
    <script src="/js/minilife-api.js"></script>
</head>
<body>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <div class="form-blocked"></div>

                <form method="POST" id="form_registration_submit">
                    <!-- Firstname -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form_firstname" class="form-control form-control-lg" name="firstname" required_off />
                        <label class="form-label" for="form_firstname">Имя</label>
                    </div>

                    <!-- Lastname -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form_lastname" class="form-control form-control-lg" name="lastname" required_off />
                        <label class="form-label" for="form_lastname">Фамилия</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form_email" class="form-control form-control-lg" name="email" required_off />
                        <label class="form-label" for="form_email">Адрес электронной почты</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form_pass" class="form-control form-control-lg" name="password" required_off />
                        <label class="form-label" for="form_pass">Пароль</label>
                    </div>

                    <!-- Password2 input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form_pass2" class="form-control form-control-lg" name="password_repeat" required_off />
                        <label class="form-label" for="form_pass2">Повторите пароль</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Зарегистрироваться</button>

                    <!-- Submit button -->
                    <input type="hidden" name="action" value="register">
                </form>
            </div>
        </div>
    </div>
</section>

<script src="/js/minilife-registration.js"></script>

<link rel="stylesheet" href="/css/noty/noty.css">
<link rel="stylesheet" href="/css/noty/animate.css">
<link rel="stylesheet" href="/css/noty-themes/minilife.css">
<script src="/js/noty.js"></script>
<script>
    Noty.overrideDefaults({
        layout: 'topRight',
        theme: 'minilife',
        closeWith: ['click'],
        timeout: 7000,
    })
</script>

</body>
</html>


