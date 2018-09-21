<?php

namespace App\Http\Controllers\API;

use App\Formation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Formation::latest()->paginate(10);

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

            ]);
            return Formation::create([
                'libelle'=>$request['libelle'],
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
        $session = Formation::findOrFail($id);

        $this->validate($request,[
            'libelle' => 'required|string|max:191',

        ]);
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
        return Formation::findOrFail($id)->delete();

    }


    public function sessionsFormation(Request $request){

        return Formation::findOrFail($request->id)->sessions()->orderBy('date', 'DESC')->get();

    }
}
