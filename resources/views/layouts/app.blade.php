<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function () {
        OneSignal.init({
            appId: "e2b0cf56-7286-47c8-adfc-18dcf96c9529",
            notifyButton: {
                enable: true, // Set to false to hide,
                size: 'large', // One of 'small', 'medium', or 'large'
                theme: 'default', // One of 'default' (red-white) or 'inverse" (whi-te-red)
                position: 'bottom-right', // Either 'bottom-left' or 'bottom-right'               offset: {
                offset: {
                    bottom: '90px',
                    left: '0px', // Only applied if bottom-left
                    right: '80px' // Only applied if bottom-right
                },
                text: {
                    "tip.state.unsubscribed": "Получать уведомления о новых статьях прямо в браузере",
                    "tip.state.subscribed": "Вы подписаны на уведомления",
                    "tip.state.blocked": "Вы заблокировали уведомления",
                    "message.prenotify": "Не забудьте подписаться на уведомления о новых статьях",
                    "message.action.subscribed": "Спасибо за подписку!",
                    "message.action.resubscribed": "Вы подписаны на уведомления",
                    "message.action.unsubscribed": "Увы, теперь вы не сможете получать уведомления о самых интересных статьях",
                    "dialog.main.title": "Настройки  уведомлений",
                    "dialog.main.button.subscribe": "Подписаться",
                    "dialog.main.button.unsubscribe": "Поступить опрометчиво и отписаться",
                    "dialog.blocked.title": "Снова получать уведомления о самых интересных статьях",
                    "dialog.blocked.message": "Следуйте этим инструкциям, чтобы разрешить уведомления:"
                }
            },
            prenotify: true, // Show an icon with 1 unread message for first-time site visitors
            showCredit: false, // Hide the OneSignal logo
            welcomeNotification: {
                "title": "Новости Laravel",
                "message": "Спасибо за подписку!"
            },
            promptOptions: {
                showCredit: false, // Hide Powered by OneSignal
                actionMessage: "просит разрешения получать уведомления:",
                exampleNotificationTitleDesktop: "Это просто тестовое сообщение",
                exampleNotificationMessageDesktop: "Уведомления будут приходить на Ваш ПК",
                exampleNotificationTitleMobile: " Пример уведомления",
                exampleNotificationMessageMobile: "Уведомления будут приходить на Ваше устройстве",
                exampleNotificationCaption: "(можно  отписаться в любое время)",
                acceptButtonText: "Продолжить".toUpperCase(),
                cancelButtonText: "Нет, спасибо".toUpperCase()
            },
            subdomainName: "ysparrow",
        });
    });
</script>
</body>
</html>
