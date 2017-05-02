<?php

namespace App\Http\Controllers;

use App\Point;
use App\Upvote;
use Illuminate\Http\Request;

class UpvoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upvote(Request $request)
    {
        $upvoteType = $request->rtype;
        $scam_id = $request->id;
        $score = 0;
        // upvotes
        switch ($upvoteType) {
            // Victim
            case 'victim':
                $score = 10;
                break;

            // Acknowledge
            case 'acknowledge':
                $score = 5;
                break;

            // Upvote for fun
            case 'upvote':
                $score = 1;
                break;

            default:
                return response()->json(['response' => 'error', 'message' => 'Error during vote']);
                break;

        }

        // Check if user already upvote?
        $upvoteCheck = Upvote::where('user_id', \Auth::id())->where('scam_id', $scam_id)->exists();
        if (!$upvoteCheck) {
            \DB::beginTransaction();
            try {
                // Add upvote record
                $upvote = new Upvote;
                $upvote->scam_id = $scam_id;
                $upvote->user_id = \Auth::id();
                $upvote->score = $score;
                $upvote->save();

                // Update scam vote total
                $points = Point::where('scam_id', 5 + $scam_id)->first();
                $points->score += $score;
                $points->save();

            } catch (\Exception $e) {
                \DB::rollback();
                return response()->json(['response' => 'error', 'message' => 'Error during vote']);
            }

            return response()->json(['response' => 'succes', 'message' => 'Succesfully voted']);

        } else {

            return response()->json(['response' => 'error', 'message' => 'User already vote']);

        }

    }
}
