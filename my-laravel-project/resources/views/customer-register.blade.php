<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>社員一覧</title>
{{-- <link rel="stylesheet" href="./css/header.css">
<link rel="stylesheet" href="./css/register.css">
<link rel="stylesheet" href="./css/information.css"> --}}

<link rel="stylesheet" href="{{asset("css/header.css")}}">
<link rel="stylesheet" href="{{asset("css/register.css")}}">
<link rel="stylesheet" href="{{asset("css/information.css")}}">
</head>
<body class="">
        <header>
            <a href="#"><img src="./img/logaut.webp" alt=""></a>
            <ul class="menu">
                <li class="menu__item">
                    <a href="" class="menu__link">社員</a>
                        <ol class="drop-menu">
                            <li class="drop-menu__item"><a href="" class="drop-menu__link">社員一覧</a></li>
                            <li class="drop-menu__item"><a href="" class="drop-menu__link">社員登録</a></li>
                            <li class="drop-menu__item"><a href="" class="drop-menu__link">社員編集</a></li>
                        </ol>
                </li>
                <li class="menu__item">
                    <a href="" class="menu__link">顧客</a>
                    <ol class="drop-menu">
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客一覧</a></li>
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客登録</a></li>
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客編集</a></li>
                    </ol>
                </li>
                <li class="menu__item">
                    <a href="" class="menu__link">キープボトル</a>
                    <ol class="drop-menu">
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客一覧</a></li>
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客登録</a></li>
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客編集</a></li>
                    </ol>
                </li>
                <li class="menu__item">
                    <a href="" class="menu__link">出退勤履歴</a>
                    <ol class="drop-menu">
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客一覧</a></li>
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客登録</a></li>
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客編集</a></li>
                    </ol>
                </li>
                <li class="menu__item">
                    <a href="" class="menu__link">伝票</a>
                    <ol class="drop-menu">
                        <li class="drop-menu__item"><a href="" class="drop-menu__link">顧客一覧</a></li>
                    </ol>
                </li>
            </ul>
            <div class="hamburger-area">
            <div class="hamburger-icon">
                    <span></span>
                </div>
            <div class="hamburgerContents">
                <ul>
                <li>
                    <div class="accordion">
                        <span>社員</span>
                    <div class="accordion-content">
                        <a href="">社員一覧</a>
                        <a href="">社員登録</a>
                        <a href="">社員編集</a>
                    </div>
                </div>
                </li>
                <li>
                    <div class="accordion">
                        <span>顧客</span> 
                    <div class="accordion-content">
                        <a href="">顧客一覧</a>
                        <a href="">顧客登録</a>
                        <a href="">顧客編集</a>
                    </div>
                </div>
                </li>
                <li><div class="accordion">
                    <span>キープボトル</span>
                <div class="accordion-content">
                    <a href="">test2</a>
                    <a href="">test3</a>
                </div>
            </div>
        </li>
        <li><a href="">出勤退勤履歴</a></li>
        <li><a href="">伝票</a></li>
                </ul>
            </div>
            </div>
    </header>
    <main>
        <section class="register">
            <div class="register-area">
                <h1>出勤登録画面</h1>
                <ul>
                    <form action="" method="POST">
                    <li>
                        <span>人数</span>
                        <input type="text" name="end_time">
                    </li>
                    <li>
                        <span>担当者</span>
                        <input type="text" name="start_time">
                    </li>
                    <li>
                        <span>日時</span>
                        <input type="time" name="start_time"  min="09:00" max="17:00" >
                    </li>
                    <li>
                        <span>顧客名1</span>
                        <input type="text" name="end_time">
                    </li>
                    <p class="plus">入力項目追加</p>
                    <input type="submit">
                    </form>
                </ul>
            </div>
        </section>
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/register.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>
</body>
</html>