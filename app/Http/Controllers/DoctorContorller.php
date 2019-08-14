<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        return view ('doctors.create');
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
                'role'=>'doctor',
                'password'=>bcrypt($request->input('password'))
            ]
        );
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
        return view ('doctors.edit', compact('doctor'));
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
