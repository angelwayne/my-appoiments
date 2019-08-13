<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{

    public function _construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $specialities = Specialty::all();
        return view ('specialties.index',compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('specialties.create');
    }

    private function performValidation(Request $request)
    {
        $rules =[
            'name' =>'required|min:3',
            'description' =>'required'
        ];
        $message=[
            'name.min'=>'Necesito el nombre completo 😁'
        ]; // this is optional
        $this->validate($request , $rules,$message);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->performValidation($request);

        $specialty= new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); //INSERT

        $notification="La especialidad ".$specialty->name." se ha registrado corectamente";
        return redirect('/specialities')->with(\compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        //
        return view('specialties.edit',compact('specialty'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
         //dd($request->all());
         $this->performValidation($request);


        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); //UPDATE

        $notification="La especialidad ".$specialty->name." se ha actualizado corectamente";
        return redirect('/specialities')->with(\compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        //
        $deleteName=$specialty->name;
        $specialty->delete();

        $notification="La especialidad ".$deleteName." se ha eliminado corectamente";
        return redirect('/specialities')->with(\compact('notification'));

    }
}
