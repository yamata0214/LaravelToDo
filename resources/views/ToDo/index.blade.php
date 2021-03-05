@extends('layouts.ToDoapp')

@section('title', 'ToDoアプリ')

@section('registration')
    <a href="/registration" class="registration">新規登録はこちら</a><br>
    <a href="passForgot" class="registration">パスワードを忘れた方はこちら</a>
@endsection

@section('msg')
    @if(isset($msg))
        <p class="center">{{$msg}}</p>
    @endif
    @if(isset($notTaskFlag))
    <form action="newTask" method="post" name="a_form">
        @csrf
        <a href="#" onclick="document.a_form.submit();">タスクを登録する</a>
        <input type="hidden" name="id" value="{{$id}}" />
    </form>
    @endif

    @error('mailaddress')
    <p>{{$message}}</p>
    @enderror
@endsection

@section('form')
    <form method="post" action='/task'>
    @csrf
        <p>MAIL：<input type="text" name="mailaddress" size=40 /></p>
        <p>PASS：<input type="password" name="pass" size=40 /></p>
        <input type="submit" />
    </form>
@endsection

@section('content')
    <p class="msg_title">このアプリについて</p>
    <div class="ul-align-center">
        <ul>
            <li class="msg_content">このアプリはタスク管理アプリです。</li>
            <li class="msg_content">ご自身の行うタスクを際にお使いください。</li>
            <li class="msg_content">説明３</li>
        </ul>
    </div>
@endsection

@section('footer')
copyright 2021 yamata.
@endsection
