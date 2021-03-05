@extends('layouts.ToDoapp')

@section('title', 'パスワード再発行')

@section('registration')
    <a href="/ToDo" class="registration">トップへ戻る</a><br>
@endsection

@section('msg')
    @if(isset($msg))
        <p class="center">{{$msg}}</p>
    @endif
@endsection

@section('form')
    <form method="post" action='/passSend'>
    @csrf
        <p>NAME：<input type="text" name="name" size=40 /></p>
        <p>MAIL：<input type="text" name="mailaddress" size=40 /></p>
        <input type="submit" />
    </form>
@endsection

@section('content')
    <p class="msg_title">注意点</p>
    <div class="ul-align-center">
        <ul>
            <li class="msg_content">パスワードは新しくなります。忘れないようにしてください。</li>
        </ul>
    </div>
@endsection

@section('footer')
copyright 2021 yamata.
@endsection
