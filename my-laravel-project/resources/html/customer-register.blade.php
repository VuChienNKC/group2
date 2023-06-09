<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>顧客新規作成画面</title>
<link rel="stylesheet" href="./css/header.css">
<link rel="stylesheet" href="./css/register.css">
<link rel="stylesheet" href="./css/information.css">
</head>
<body class="">
    <header>
        <a href="#"><img src="./img/logaut.webp" alt=""></a>
        <ul class="menu">
            <li class="menu_list">
              <span>社員</span>
              <ol>
                <li><a href="#">社員一覧</a></li>
                <li><a href="#">社員登録</a></li>
                <li><a href="#">社員編集</a></li>
              </ol>
            </li>
            <li class="menu_list">
              <span>顧客</span>
              <ol>
                <li><a href="#">顧客一覧</a></li>
                <li><a href="#">顧客登録</a></li>
                <li><a href="#">顧客編集</a></li>
              </ol>
            </li>
            <li class="menu_list">
              <span>キープボトル</span>
              <ol>
                <li><a href="#">社員一覧</a></li>
                <li><a href="#">社員登録</a></li>
                <li><a href="#">社員編集</a></li>
              </ol>
            </li>
            <li class="menu_list">
              <span>出勤退勤履歴</span>
              <ol>
                <li><a href="#">社員一覧</a></li>
                <li><a href="#">社員登録</a></li>
                <li><a href="#">社員編集</a></li>
              </ol>
            </li>
            <li class="menu_list">
                <span>伝票</span>
                <ol>
                  <li><a href="#">社員一覧</a></li>
                  <li><a href="#">社員登録</a></li>
                  <li><a href="#">社員編集</a></li>
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
                <h1>顧客新規作成</h1>
                <ul>
                    <form action="" method="POST">
                        @csrf
                    <li>
                        <span>顧客名</span>
                        <input type="text" name="customer_id">
                    </li>
                    <li>
                        <span>誕生日</span>
                        <input type="text" name="birthday">
                    </li>
                    <li>
                        <span>担当者</span>
                        <input type="text" name="staff_id">
                    </li>
                    <li>
                        <span>備考</span>
                        <input type="text" name="remarks">
                    </li>
                    <input type="submit">
                    </form>
                </ul>
            </div>
        </section>
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/register.js"></script>
<script src="js/index.js"></script>
</body>
</html>