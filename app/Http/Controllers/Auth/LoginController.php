<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class LoginController extends Controller
{
    use GeneralServices;
    public function login(Request $request){
        $result = $this->POST(env('API_URL').'api/user/login', ['email'=>$request['email'],'password'=>$request['password']]);
        if($result['status'] == true){
          Session::put('Users',$result['data']);
          if(Session::get('Users.role_id')== 1){
            return redirect('/attendance');
          }else{
            return redirect('/attendance/add');
          }
        }else{
          // return redirect()->back()->withErrors(['error' => $result['message']]);
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function logout(){
      Session::flush();
      return redirect('/');
    }


}
