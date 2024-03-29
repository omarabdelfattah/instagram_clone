<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{

    function index()
    {
        $users = User::withcount('posts')-> simplepaginate(20);
        
        return view("users.index")->with('users',$users);

    }

    function create()
    {
        return view("users.create");
    }

    function store(Request $request)
    {
    User::create(
        ['name' => $request['name'] , 'email' => $request['email'],'password'=>$request['pass']]
        );
        return "<h1>Name: ".$request['name']."</h1><br>"."<h1>Email: ".$request['email']."</h1><br> <h2>has been Stored</h2>";
    }
    function show($id)
    {
    $user =User::where('id', $id)->get()->first(); 
    $posts = User::find($user['id'])->posts; 
    return view("users.show",['user'=>$user,'posts'=>$posts]);
    }
    function edit($id)
    {
        $user =User::where('id', $id)->get()->first() ;
        return view("users.edit")->with('user',$user);
    }
    function update(Request $request , $id)
    {
    User::find($id)->update(
        ['name' => $request['name'] , 'email' => $request['email'],'password'=>$request['pass']]
        );
        return "<h1>Name: ".$request['name']."</h1><br>"."<h1>Email: ".$request['email']."</h1><br>";
    }

    function destroy($id)
    {
        $user =User::where('id', $id)->get()->first();
        User::where('id', $id)->get()->first()->delete(); 
        return "<h1>Name: ".$user['name']."</h1><br>"."<h1>Email: ".$user['email']."</h1><br> <h2>has been Deleted</h2>";
    }



    function forgot_password_show(){
        $page_title = "Reset password";
        return view('dashboard.forgot_password',compact('page_title'));
    }

    function forgot_password_email_verify(){
        $admin = Admin::where('email',request('email'))->first();
        if(!empty($admin)){

            $token = Password::broker('admin')->createToken($admin);
            DB::table('password_resets')->insert([
                'email'=>$admin->email,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            return redirect()->back()->with('success', 'Reset link is sent to your email address'); 

         }else{
            return redirect()->back()->withErrors(['email_is_wrong' => 'passwords.user']);
        }
        return back();
    }
    function forgot_password_token_verify($token){
        $check_token =  DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
         if(!empty($check_token)){
            return view('dashboard.forgot_password_final',['data' => $token]);
        }else{
            return redirect(Route('reset_password_final'));
        }
    }
    function forgot_password_final(UpdatePassword $request,$token){
        $check_token =  DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            $admin = Admin::where('email',$check_token->email)->update([
                'password' => bcrypt($request->input('password'))
            ]);
            DB::table('password_resets')->where('email',$check_token->email)->delete();
            auth('admin')->attempt(['email'=>$check_token->email,'password'=>$request->input('password')]);
            return redirect(Route('dashboard'));
        }else{
            return redirect(Route('forgot_password'));
        }
    }
}
