<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function login(Request $request){
        //This method is for the admin login.
        //when the user enters the email and password of the account they want to access,
        //once they click the submit button, it will carry out an authentication check,
        // this is done by comparing the email and password,
        //and also checking if the user is an admin in the DB table.
        //ADMIN users are assigned a 1 in the DB table (users table in myPHPAdmin).
        if ($request -> isMethod('post')){
                $data = $request -> input();
                if (Auth::attempt(['email'=> $data['email'], 'password' => $data['password'], 'admin' => '1'])){
                        //echo "success"; die;
                       /* Session::put('adminSession', $data['email']);*/ //this will add a session variable to a successful login

                        return redirect('/admin/dashboard');
                }
                else{
                    return redirect('/admin')->with('flash_message_error', 'Invalid email address or password entered');
                }
        }
        //this returns the user to the view page we created
        return view('admin.admin_login');
    }

    public function dashboard(){
        /*if (Session::has('adminSession')){
            //perform dashboard tasks
        }
        else{
            //this line of code, stops anyone from being able to reach the dashboard without logging in.
            //this is done by checking if a session exists.
            //if someone tried to access the dashboard by writing the path in the url, they will be redirected
            //to the admin page and an error message will appear prompting the user.
            return redirect('/admin')->with('flash_message_error', 'Please log in to access admin panel');
        }*/

        //this route will return the dashboard view when called.
        return view('admin.dashboard');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function chkPassword(Request $request){
        //this method will check the current password entered by the user
        //to check if it is correct or not,
        //the if statement checks the current password,
        //if is is true it will return true message on the form
        //if is incorrect it will return false message on the form
        $data = $request->all();
        $current_password= $data['current_pwd'];
        $check_password = User::where(['admin'=> '1'])->first();
        if (Hash::check($current_password, $check_password->password)){
                echo "true"; die;
        }
        else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user = Auth::user()->email;
            $check_password = User::where(['email' => $user])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('email', $user)->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Password updated Successfully!');
            }else {
                return redirect('/admin/settings')->with('flash_message_error','Incorrect Current Password!');
            }
        }
    }

    public function logout(Request $request){
        //this function will cleat the session and then redirect the user to the login page...
        //and display a flash message informing of a successful log out process.
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfully');

    }
}
