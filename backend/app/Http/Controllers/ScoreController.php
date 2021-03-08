<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ScoreResource;
use App\Models\Departure;
use App\Http\Resources\DepartureResource;

class ScoreController extends Controller
{
    public function departureUser($user_id){
        // $user = DB::table('departures')->where('user_id', $user_id)->first();
        $departures = Departure::where('user_id', $user_id)->get();
        return response()->json($departures);
        // return new ScoreResource($user);
    }

    public function pointMax(Request $request){
        $points = DB::table('departures')->max('points');
        $departure = DB::table('departures')->where('points',$points)->first();
        $user = DB::table('users')->where('id',$departure->user_id)->first();
        return response()->json([
            'user_id' => $departure->user_id,
            'nickname' => $user->nickname,
            'point' => $departure->points
         ]);
    }

    public function timeMin(Request $request){
        $time = DB::table('departures')->min('time');
        $departure = DB::table('departures')->where('time', $time)->first();
        $user = DB::table('users')->where('id', $departure->user_id)->first();

        return response()->json([
            'user_id' => $departure->user_id,
            'nickname' => $user->nickname,
            'time' => $departure->time,
         ]);
    }
}
