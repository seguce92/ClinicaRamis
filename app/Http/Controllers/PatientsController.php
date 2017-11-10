<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\NewPatientRequest;
use App\Patient;

class PatientsController extends Controller{
    public function index(){
    	$patients=Patient::OrderBy('lastname','asc')->orderBy('name','asc')->paginate(8);
    	return view('patients.index',compact('patients'));
    }

    public function show_details($id){
    	$patient=Patient::find($id);
    	return view('patients.details',compact('patient'));
    }

    public function new_patient_form(){
    	return view('patients.new');
    }

    public function register_new_patient(NewPatientRequest $req){
        
        $patient=new Patient(array(
            'name'=>$req->get('firstname'),
            'lastname'=>$req->get('lastname'),
            'address'=>$req->get('address'),
            'gender'=>$req->get('gender'),
            'birthday'=>Carbon::createFromFormat('d/m/Y', $req->get('birthday')),
            'email'=>$req->get('email'),
            'rut'=>$req->get('rut'),
            'phone'=>$req->get('phone'),
        ));
        $patient->save();
        return redirect()->action('PatientsController@index');
    }
}
