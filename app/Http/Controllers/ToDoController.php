<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\People;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ToDoRequest;
use App\Http\Requests\RegistRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;

class ToDoController extends Controller{
    
    // 初期ページ表示
    public function index(Request $request){
        
        $data = [
            'address'=>'',
            'pass'=>'',
            'msg'=>'',
        ];
        return view('ToDo.index', $data);
    }
    
    /* 
        ログイン確認
        メールアドレスとパスワードが一致した場合にToDo管理画面へ遷移
    */
    public function post(ToDoRequest $request){
        $people_id = '';
        $people_name = '';
        
        $rules = [
           'mailaddress' => 'email',
        ];
        $messages = [
           'mailaddress.email'  => 'メールアドレスを正しく入力して下さい。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/ToDo')
               ->withErrors($validator)
               ->withInput();
        } else {
            $items = User::where('email', $request->mailaddress)
                ->where('password' , $request->pass)->get();
            foreach($items as $data){
                $people_id = $data->id;
                $people_name = $data->name;
            }
            $request->session()->put('people_name', $people_name);
            $request->session()->put('people_id', $people_id);
            $tasks = Task::where('people_id', $people_id)->orderBy('deadline','asc')->get();
            if(count($items) >= 1){
                return view('ToDo.task',['tasks' => $tasks],compact('people_id'));
            } else {
                return view('ToDo.index',['msg'=>'パスワードが違います。']);
            }
        }
    }
    
    // 新規登録画面へ遷移
    public function registration(){
        $data = [
            'msg'=>'',
        ];
        return view('ToDo.registration',$data);
    }
    
    // パスワードを忘れた画面へ遷移
    public function passForgot(){
        $data = [
            'msg'=>'',
        ];
        return view('ToDo.passForgot',$data);
    }
    
    // 会員新規登録
    public function create(RegistRequest $request){
        $people_id = $request->people_id;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
        $messages = [
           'name.required'  => '名前を入れて下さい。',
           'name.max'  => '名前は255文字以内で入れてください。',
           'email.required'  => 'メールアドレスを入れて下さい。',
           'email.email'  => 'メールアドレスを正しく入力して下さい。',
           'email.max'  => 'メールアドレスを255文字以内で入れてください。',
           'password.required'  => 'パスワードを入れて下さい。',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/registration')
               ->withErrors($validator)
               ->withInput();
        } else {
            $user = User::where('email',$request->email)->get();
            if(count($user) == 0){
                User::insert([
                    'email' => $request->email,
                    'password' => $request->password,
                    'name' => $request->name,
                ]);
                return view('ToDo.index',['msg'=>'登録しました。']);
            } else {
                return view('ToDo.registration',['msg'=>'メールアドレスが既に登録されています。']);
            }
        }
   }
    
    // 新規タスク登録　もしくはタスク編集
    public function newTask(Request $request){   
        
        $month = $request->month;
        $day = $request->day;
        $people_id = $request->people_id;
        if($request->month >= 1 && $request->month <= 9){
            $month = 0 . $request->month;
        }
        if($request->day >= 1 && $request->day <= 9){
            $day = 0 . $request->day;
        }

        if(checkdate($request->month, $request->day, $request->year) && $request->has('newTask')){
            Task::insert([
                'people_id' => $request->people_id,
                'task_name' => $request->task_name,
                'remarks' => $request->remarks,
                'deadline' => $request->year .'-' . $month . '-' . $day,
            ]);
            $tasks = Task::where('people_id', $people_id)->orderBy('deadline','asc')->get();
            return view('ToDo.task',compact('people_id'),['tasks' => $tasks]);
            
        } else if(checkdate($request->month, $request->day, $request->year) && $request->has('update')){
            $param = [
                $people_id = $request->people_id,
                $task_name = $request->task_name,
                $remarks = $request->remarks,
                $deadline = $request->year .'-' . $month . '-' . $day,
                $task_id = $request->task_id,
            ];

            Task::where('task_id', $request->task_id)->update([
                'people_id' => $request->people_id,
                'task_name' => $request->task_name,
                'remarks' => $request->remarks,
                'deadline' => $request->year .'-' . $month . '-' . $day,
            ]);
            $tasks = Task::where('people_id', $people_id)->orderBy('deadline','asc')->get();
            return view('ToDo.task',compact('people_id'),['tasks' => $tasks]);
            
        } else {
            $tasks = Task::where('people_id', $people_id)->orderBy('deadline','asc')->get();
            return view('ToDo.task',compact('people_id'),['tasks' => $tasks ,'msg'=>'年月日を正しく入れて下さい。']);
        }
    }
    
    // タスク削除
    public function updateOrDelete(Request $request){
        
        $people_id = $request->people_id;
        if ($request->has('update')){
            $post_data = $request->all();
            $deadline = $request->deadline;
            list($year, $month, $day) = explode('-', $deadline);
            return view('ToDo.update',compact('post_data','year','month','day'));
        } else if ($request->has('delete')){
            $people_id = $request->people_id;
            DB::table('tasks')->where('task_id', $request->task_id)->delete();
            $tasks = Task::where('people_id', $people_id)->orderBy('deadline','asc')->get();
            return view('ToDo.task',compact('people_id'),['tasks' => $tasks]);     
        }
    }
           
    // パスワードをメールアドレスへ送信
    public function passSend(Request $request){

        $user = User::where('email',$request->mailaddress)->where('name', $request->name)->get();
        if(count($user) == 1){
            
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $count = mb_strlen($chars);

            for ($i = 0, $newPass = ''; $i < 8; $i++) {
                $index = rand(0, $count - 1);
                $newPass .= mb_substr($chars, $index, 1);
            }
        
            $name = $request->name;
            $text = 'パスワード更新のお知らせです。';
            $to = $request->mailaddress;
            
            User::where('name', $name)->where('email', $to)->update([
                'password' => $newPass,
            ]);
            
            Mail::to($to)->send(new Notification($name, $text, $newPass));
        };
        return view('ToDo.index',['msg'=>'パスワードを更新しました。メールをご確認下さい。']);
    }
    
    // ログアウト
    public function logout(){
        Auth::logout();
        session()->forget('people_name');
        session()->forget('people_id');
        return redirect('ToDo');
    }
}
