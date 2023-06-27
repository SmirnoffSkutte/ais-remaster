<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/nulling-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <button class="register-button" id="get-users-button">Получить всех пользователей</button>
    <div class="users-list" id="users-list">

    </div>


    <script type="module" src="{{ asset('js/users-page/render.js') }}"></script>
</body>
</html>
