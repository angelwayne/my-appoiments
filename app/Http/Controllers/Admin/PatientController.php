<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\User;

use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = User::patients()->paginate(5);
        return view ('patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name'=>'required|min:3',
            'email'=>'email',
            'cedula'=>'nullable|digits:8',
            'address'=>'nullable|min:10',
            'phone'=>'nullable|min:10'

        ];
        $this->validate($request,$rules);

        //mass assigment
        User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role'=>'patient',
                'password'=>bcrypt($request->input('password'))
            ]
        );
        $notification='El paciente '.$request->name. ' se ha registrdo corecctamente';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $patient)
    {
        //

        return view ('patients.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'name'=>'required|min:3',
            'email'=>'email',
            'cedula'=>'nullable|digits:8',
            'address'=>'nullable|min:10',
            'phone'=>'nullable|min:10'

        ];
        $this->validate($request,$rules);


        $user= User::patients()->findOrfail($id);

        $data= $request->only('name','email','cedula','address','phone');
        $password=$request->input('password');
        if($password){
        $data['password']=bcrypt($password);
        }
        $user->fill($data);
        $user->save(); //Update

        $notification='La informacion del paciente '.$request->name. ' se ha actualizado corecctamente';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        //
        $patientName= $patient->name;
        $patient->delete();

        $notification="El doctor $patientName se ha elimminado corecctamente";

        return redirect('/patients')->with(compact('notification'));
    }
}
