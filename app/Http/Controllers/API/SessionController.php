<?php

namespace App\Http\Controllers\API;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Session;
use App\Formation;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Session::orderBy('date', 'DESC')->with('formation')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'libelle' => 'required|string|max:191',
            'date' => 'required|string|date',
            'lieu' => 'required|string|max:50',
            'nbr_participants' => 'required|integer',

        ]);
        return Session::create([
            'libelle'=>$request['libelle'],
            'formation_id'=>$request['formation_id'],
            'date'=>$request['date'],
            'lieu'=>$request['lieu'],
            'nbr_participants'=>$request['nbr_participants'],
            'formatteur'=>$request['formatteur'],

        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);

//        $this->validate($request,[
//            'name' => 'required|string|max:191',
//            'email' => 'required|string|email|max:191',
//            'password' => 'required|string|min:6',
//
//        ]);
        $session->update($request->all());

        return "updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Session::findOrFail($id)->delete();

    }
}
