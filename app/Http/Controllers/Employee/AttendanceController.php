<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class AttendanceController extends Controller
{
    use GeneralServices;
    public function index(Request $request){
        
        if(Session::get('Users.role_id')== 2){
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('You cant access this module');
                    </script>");
        }else{
            $result = $this->GET(env('API_URL').'/api/attendance');
            if($result['status'] == true){
                $data['data'] =$result['data'];
                $data['title'] ='Attendance';
               return view('attendance.view',$data);
            }else{
               return redirect()->back()->withErrors([$result['message']]);
            }
        }
    }
    public function add(Request $request){
        $data['title'] ='Attendance';
        return view('attendance.add',$data);
    }
    public function store(Request $request){
        $result = $this->POST(env('API_URL').'api/attendance', $request->except(['_token']));
        if($result['status'] == true){
            return redirect('/attendance/add')->with('success', $result['message']);
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }


}
