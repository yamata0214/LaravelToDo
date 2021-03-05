@extends('layouts.ToDoapp')

@section('title', 'タスク登録')

@section('form')
       <form action="/ToDo/add" method="post">
        <input type="hidden" name="id" value="{{$id}}" />
      @csrf
      <p>TASK：<input type="text" name="task_name" size=38 /></p>
           <p>REMARKS：<textarea name="remarks" cols="30" rows="5"></textarea></p>
      <p>DEADLINE：
          <select id="year" class="form-control" name="year">
                @for ($i = date('Y'); $i <= date('Y') + 15; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            年
            <select id="month" class="form-control" name="month">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            月
            <select id="day" class="form-control" name="day">
                @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            日
       </p>
      <input type="submit" value="登録する" class="center">
   </form>
@endsection

@section('footer')
copyright 2021 yamata.
@endsection
