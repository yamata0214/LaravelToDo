@extends('layouts.ToDoapp')

@section('title', 'タスク編集')

@section('msg')
    @if(isset($msg))
        <p class="center">{{$msg}}</p>
    @endif
@endsection

@section('form')
<p>タスク編集</p>
    <form action="update" method="post">
      @csrf
        <input type="hidden" name="people_id" value="{{Session::get('people_id')}}" />
        <input type="hidden" name="task_id" value="{{$post_data['task_id']}}" />
      <p>TASK：<input type="text" name="task_name" size=38 value="{{$post_data['task_name']}}" /></p>
           <p>REMARKS：<textarea name="remarks" cols="30" rows="5">{{$post_data['remarks']}}</textarea></p>
      <p>DEADLINE：
          <select id="year" class="form-control" name="year">
                @for ($i = date('Y'); $i <= date('Y') + 15; $i++)
                <option value="{{ $i }}" @if($i == $year) selected @endif>{{ $i }}</option>
                @endfor
            </select>
            年
            <select id="month" class="form-control" name="month">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" @if($i == $month) selected @endif>{{ $i }}</option>
                @endfor
            </select>
            月
            <select id="day" class="form-control" name="day">
                @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}" @if($i == $day) selected @endif>{{ $i }}</option>
                @endfor
            </select>
            日
       </p>
      <input type="submit" name="update" value="編集する" class="center" />
   </form>
@endsection

@section('footer')
copyright 2021 yamata.
@endsection
