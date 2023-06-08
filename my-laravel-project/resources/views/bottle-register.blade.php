@extends('main')
@section('styles')
<link rel="stylesheet" href="{{asset('css/header.css')}}">
<link rel="stylesheet" href="{{asset('/css/register.css')}}">
<link rel="stylesheet" href="./css/information.css">
@endsection
@section('title', 'ボトル登録')

@section('content')
<main>
<section class="register">
        <div class="register-area">
            <h1>ボトル登録</h1>
            <ul>
                <form action="/keepbottle-register" method="POST">
                    @csrf
                    <li class="kinds">
                        <span>種類</span>
                        <div class="kinds-selecter">
                        <span>選択してください</span>
                        <ul class="kind-list" id ="">
                            <li>test1</li>
                            <li>test2</li>
                            <li>test3</li>
                            <li>test4</li>
                            <li>その他</li>
                        </ul> 
                        </div>
                        <input type="text" id ="liquor_type" class="kinds-inp" name="liquor_name" placeholder="種類を入力してください" required>
                    </li>
                    <li>
                        <span>酒名</span>
                        <input type="text" name="テーブル表に載ってない" required>
                    </li>
                    <!-- <li>
                        <span>備考</span>
                        <textarea name="remarks" ></textarea>
                    </li> -->
                    <input type="submit" value="登録">
                </form>
            </ul>
        </div>
    </section>
</main>
@endsection
@section('scripts')
<script src="{{asset('js/register.js')}}"></script>
@endsection