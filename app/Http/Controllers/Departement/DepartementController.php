<?php

namespace App\Http\Controllers\Departement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class DepartementController extends Controller
{
    use GeneralServices;
    public function index(Request $request){
        if(Session::get('Users.role_id')== 2){
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('You cant access this module');
                    </script>");
        }else{
            $result = $this->GET(env('API_URL').'/api/departement');
            if($result['status'] == true){
                $data['data'] =$result['data'];
                $data['title'] ='Divisi';
            return view('departement.view',$data);
            }else{
            return redirect()->back()->withErrors([$result['message']]);
            }
        }
    }
    public function store(Request $request){
        $result = $this->POST(env('API_URL').'api/departement', ['departement_name'=>$request['departement_name']]);
        if($result['status'] == true){
            return redirect('/departement');
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function show($id){
        $result = $this->GET(env('API_URL').'api/departement/detail?departement_id='.$id);
        if($result['status'] == true){
            $data['data'] =$result['data'];
            $data['title'] ='Divisi';
		   return view('departement.edit',$data);
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function update(Request $request){
        $result = $this->PUT(env('API_URL').'api/departement', ['departement_id'=>$request['departement_id'],'departement_name'=>$request['departement_name']]);
        if($result['status'] == true){
            return redirect('/departement');
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }
    public function destroy($id){
        $result = $this->DELETE(env('API_URL').'api/departement?departement_id='.$id);
        if($result['status'] == true){
            return redirect('/departement');
        }else{
          return redirect()->back()->withErrors([$result['message']]);
        }
    }


}
