<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;
use App\Specialty;

class DoctorContorller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $doctors =User::doctors()->get();
        return view ('doctors.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $specialties = Specialty::all();
        return view ('doctors.create',compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name'=>'required|min:3',
            'email'=>'email',
            'cedula'=>'nullable|digits:8',
            'address'=>'nullable|min:10',
            'phone'=>'nullable|min:10'

        ];
        $this->validate($request,$rules);

        //mass assigment
       $user= User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role'=>'doctor',
                'password'=>bcrypt($request->input('password'))
            ]
        );

        $user->specialties()->attach($request->input('specialties'));

        $notification='El medico '.$request->name. ' se ha registrdo corecctamente';
        return redirect('/doctors')->with(compact('notification'));
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
    public function edit($id)
    {
        $doctor=User::doctors()->findOrfail($id);
        $specialties=Specialty::all();
        $specialty_id = $doctor->specialties()->pluck('specialties.id');
        return view ('doctors.edit', compact('doctor','specialties','specialty_id'));
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
        $rules = [
            'name'=>'required|min:3',
            'email'=>'email',
            'cedula'=>'nullable|digits:8',
            'address'=>'nullable|min:10',
            'phone'=>'nullable|min:10'

        ];
        $this->validate($request,$rules);


        $user= User::doctors()->findOrfail($id);

        $data= $request->only('name','email','cedula','address','phone');
        $password=$request->input('password');
        if($password){
        $data['password']=bcrypt($password);
        }
        $user->fill($data);
        $user->save(); //Update

        $user->specialties()->sync($request->input('specialties'));
        $notification='La informacion del doctor '.$request->name. ' se ha actualizado corecctamente';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        //
        $doctorName= $doctor->name;
        $doctor->delete();

        $notification="El doctor $doctorName se ha elimminado corecctamente";

        return redirect('/doctors')->with(compact('notification'));

    }
}
