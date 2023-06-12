@php
use Carbon\Carbon;
$today = Carbon::now()->format('Y/m/d');
@endphp
@extends('main')
@yield('title','顧客登録')
@section('styles')
<link rel="stylesheet" href="./css/bill-header.css">
<link rel="stylesheet" href="./css/bill-register.css">
<link rel="stylesheet" href="./css/information.css">
<link rel="stylesheet" href="./css/bill-register.js">
@endsection
@section('content')
<main>
    <section class="register">
        <div class="register-area">
            <h1>伝票登録</h1>
            <ul>
                <form action="/customer-register" method="POST">
                    @csrf
                    <li>
                        <span>顧客名</span>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}">
                        <input type="text" name="customer_id" value="{{ old('customer_id') }}" hidden>

                        @if ($errors->has('customer_name'))
                        <span class="error">{{ $errors->first('customer_name') }}</span>
                        @endif
                    </li>
                    <li class="kinds  liquorType">
                        <span>社員名</span>
                        <div class="kinds-selecter">
                            <span>選択してください</span>
                            <ul class="kind-list" id="">
                            </ul>
                        </div>
                        <input type="text" id="staff_name" class="kinds-inp" name="staff_name"
                            value="{{ old('staff_name') }}" placeholder="種類を入力してください">
                        <input type="text" id="staff_id" class="kinds-inp" name="staff_id" value="{{ old('staff_id') }}"
                            hidden>
                        @if ($errors->has('staff_id'))
                        <span class="error">{{ $errors->first('staff_id') }}</span>
                        @endif
                    </li>

                    <li>
                        <span>日付</span>
                        <input type="text" id="theDate" name="ap_day" value="{{$today}}">
                        @if ($errors->has('ap_day'))
                        <span class="error">{{ $errors->first('ap_day') }}</span>
                        @endif
                    </li>
                    <li>
                        <span>金額</span>
                        <input class="money" type="text" id='demo_input' name="total" placeholder="￥">
                        @if ($errors->has('total'))
                        <span class="error">{{ $errors->first('total') }}</span>
                        @endif
                    </li>
                    <div></div>
                    <input type="submit" value="登録">
                </form>
            </ul>
        </div>
    </section>
</main>
@endsection
@section('scripts')
<script src="js/register.js"></script>
<script src="js/index.js"></script>
<script src="js/bill-register.js"></script>
@endsection