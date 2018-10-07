<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('participants/session/{session}' , 'API\SessionController@sessionsParticipant');
Route::get('session/participants/{session}/{user}' , 'API\SessionController@addParticipantSession');
Route::get('session/declineParticipant/{session}/{user}' , 'API\SessionController@removeParticipantSession');
Route::get('session/approveParticipant/{session}/{user}' , 'API\SessionController@approveParticipantSession');
Route::get('session/presenceParticipant/{session}/{user}' , 'API\SessionController@presenceParticipantSession');
Route::get('session/absenceParticipant/{session}/{user}' , 'API\SessionController@absenceParticipantSession');

Route::post('rating/{user}/{session}','API\SessionController@ratingSession');

Route::get('user/sessions/{id}' , 'API\UserController@sessionsParticipation');
Route::get('user/formateurs' , 'API\UserController@formateurs');

Route::get('sessions/formation', 'API\FormationController@sessionsFormation');

Route::apiResources([
    'user' => 'API\UserController',
    'formation' => 'API\FormationController',
    'session' => 'API\SessionController',

]);

Route::get('testingRate/{userId}/{sessionId}',function($userId,$sessionId,Request $request){
    $rate=\App\Rating::where('user_id',$userId)->where('session_id',$sessionId);
    return $rate->get("rating");


});
Route::get('checkingPresence/{userId}/{sessionId}','API\SessionController@checkingSessionAndParticipant');

Route::get('checkingButton/{userId}/{sessionId}','API\SessionController@checkingSessionAndParticipant');



