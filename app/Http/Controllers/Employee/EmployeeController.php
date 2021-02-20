<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class EmployeeController extends Controller
{
    use GeneralServices;
    public function index(Request $request){
        if(Session::get('Users.role_id')== 2){
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('You cant access this module');
                    </script>");
        }else{
            $result = $this->GET(env('API_URL').'/api/employee');
            if($result['status'] == true){
                $data['data'] =$result['data'];
                $data['title'] ='Employee';
            return view('employee.view',$data);
            }else{
            return redirect()->back()->withErrors([$result['message']]);
            }
        }
    }
    public function store(Request $request){
        $result = $this->POST(env('API_URL').'api/employee', $request->except(['_token']));
        if($result['status'] == true){
            return redirect('/employee');
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function add(Request $request){
        $result = $this->GET(env('API_URL').'api/departement');
        if($result['status'] == true){
            $data['data'] =$result['data'];
            $data['title'] ='Employee';
		   return view('employee.add',$data);
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function show($id){
        $departement = $this->GET(env('API_URL').'api/departement');
        $result = $this->GET(env('API_URL').'api/employee/detail?id='.$id);
        if($result['status'] == true){
            $data['departement'] =$departement['data'];
            $data['data'] =$result['data'];
            $data['title'] ='Employee';
		   return view('employee.edit',$data);
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function update(Request $request){
        $result = $this->PUT(env('API_URL').'api/employee',$request->except(['_token']));
        if($result['status'] == true){
            return redirect('/employee');
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function destroy($id){
        $result = $this->DELETE(env('API_URL').'api/employee?id='.$id);
        if($result['status'] == true){
            return redirect('/employee');
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }


}
