@extends('layouts.ToDoapp')

@section('title', '新規登録')

@section('menubar')
   @parent
   アカウント新規登録
@endsection

@section('msg')
    @if(isset($msg))
        <p class="center">{{$msg}}</p>
    @endif
    @error('name')
        <p>{{$message}}</p>
    @enderror
    @error('email')
        <p>{{$message}}</p>
    @enderror
    @error('password')
        <p>{{$message}}</p>
    @enderror
@endsection

@section('form')
   <form action="add" method="post">
      @csrf
      <p>NAME：<input type="text" name="name" size=38 /></p>
       <p>MAIL：<input type="text" name="email" size=40 /></p>
       <p>PASS：<input type="password" name="password" size=40 /></p>
      <input type="submit" value="登録する" class="center">
   </form>
@endsection

@section('content')
    <p class="msg_title">登録の注意点</p>
    <div class="ul-align-center">
        <ul>
            <li class="msg_content">名前・メールアドレス・パスワードは全て255文字以内で入れてください。</li>
            <li class="msg_content">パスワードは他のサイトで使っているものは使わないでください。</li>
            <li class="msg_content"></li>
        </ul>
    </div>
@endsection

@section('footer')
copyright 2021 yamata.
@endsection