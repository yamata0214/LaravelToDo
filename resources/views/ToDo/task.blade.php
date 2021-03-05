@extends('layouts.ToDoapp')

@section('title', 'タスク一覧')

@section('registration')
    <a href="/logout" class="registration">ログアウト</a>
@endsection

@section('msg')
    @if(isset($msg))
        <p class="center">{{$msg}}</p>
    @endif
@endsection

@section('form')
<p>ようこそ！{{Session::get('people_name')}}さん！</p>
<p>タスク登録</p>
    <form action="newTask" method="post">
    @csrf
    <input type="hidden" name="people_id" value="{{Session::get('people_id')}}" />
      
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
      <input type="submit" name="newTask" value="登録する" class="center" />
   </form>
@endsection


@section('content')
<form action="taskcUpDel" method="post">
    @csrf
    <input type="hidden" name="people_id" value="{{Session::get('people_id')}}" />
    <input type="hidden" name="task_id" value="" />
    <input type="hidden" name="task_name" value="" />
    <input type="hidden" name="remarks" value="" />
    <input type="hidden" name="deadline" value="" />
    
    <table align="center">
   <tr><th class="width30">タスク名</th><th class="width30">備考</th><th class="width30">期限</th></tr>
   @foreach ($tasks as $task)
        @if(strtotime($task->deadline) < strtotime(date('Y/m/d')))
            <tr class="red">
        @else
            <tr>
        @endif
           <input type="hidden" name="task_id_td" value="{{$task->task_id}}" />
           <td class="width30 center">{{$task->task_name}}<input type="hidden" name="task_name_td" value="{{$task->task_name}}" /></td>
           <td class="width30 center">{{$task->remarks}}<input type="hidden" name="remarks_td" value="{{$task->remarks}}" /></td>
           <td class="width30 center">{{$task->deadline}}<input type="hidden" name="deadline_td" value="{{$task->deadline}}" /></td>
           <td class="width30 center"><input type="submit" value="編集" name="update" class="update_or_delete" /></td>
           <td class="width30 center"><input type="submit" value="削除" name="delete" class="update_or_delete" /></td>
       </tr>
   @endforeach
   </table>
     
</form>
@endsection

@section('footer')
copyright 2021 yamata.
@endsection
