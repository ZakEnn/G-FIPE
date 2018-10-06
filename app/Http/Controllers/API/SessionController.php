<?php

namespace App\Http\Controllers\API;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Session;
use App\Formation;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
            'description'=>$request['description'],
            'formation_id'=>$request['formation_id'],
            'date'=>$request['date'],
            'heure'=>$request['heure'],
            'duree'=>$request['duree'],
            'lieu'=>$request['lieu'],
            'nbr_participants'=>$request['nbr_participants'],
            'formateur'=>$request['formateur'],

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

    public function addParticipantSession($id,$u_id){


        if(!Session::findOrFail($id)->participants()->where('user_id', $u_id)->exists()){

            Session::findOrFail($id)->participants()->attach([$u_id]);

        }

        return "participant_attached";

    }

    public function removeParticipantSession($id,$u_id){

     //  Session::findOrFail($id)->participants()->detach($u_id);

        $participant =  Session::findOrFail($id)->participants()->whereUserId($u_id)->get()->first();
        $participant->pivot->etat = 1 ;
        $participant->pivot->save();
        return "participant_declined";

    }
    public function approveParticipantSession($id,$u_id){

        //  Session::findOrFail($id)->participants()->detach($u_id);

        $participant =  Session::findOrFail($id)->participants()->whereUserId($u_id)->get()->first();
        $participant->pivot->etat = 2 ;
        $participant->pivot->save();
        return "participant_approved";

    }
    public function presenceParticipantSession($id,$u_id){

        //  Session::findOrFail($id)->participants()->detach($u_id);

        $participant =  Session::findOrFail($id)->participants()->whereUserId($u_id)->get()->first();
        $participant->pivot->presence = 1 ;
        $participant->pivot->save();
        return true;

    }
    public function sessionsParticipant($id){

        $participants =  Session::findOrFail($id)->participants()->get();
        return $participants->all();

    }

    /*public function ratingSession($user,$s_id,Request $request){
        $userInfo=User::findOrFail($user)->sessions();
        $userInfo->update(["user_id"=>$user,"session_id"=>$s_id,"etat"=>$request->rating]);

        return $request->rating;

    }*/

    public function checkingSessionAndParticipant($user_id, $session_id){


        $participants =  Session::findOrFail($session_id)->participants();
       return  $participants->findOrFail($user_id);

    }

}