<?php

namespace App\Http\Controllers;

use App\Scam;
use App\ScamDetail;
use App\Victim;
use Countries;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param  Request
     * @return Response
     */
    public function create(Request $request)
    {
        $countries = Countries::pluck('id', 'name');
        $currencies = Countries::pluck('id', 'currency_code');
        return view('reports.create')->with(compact('countries', 'currencies'));
    }

    /**
     * Store function
     *
     * @return void
     **/
    public function store(Request $request)
    {

        // validate using ajax
        if ($request->ajax()) {
            if ($request->{'submit-type'} == 'story') {

                // validate
                $this->validate($request, array_merge(Scam::$rules, ScamDetail::$rules));

                // store story in database
                $scam = new Scam;
                $scam->title = $request->title;
                $scam->location = $request->location;
                $scam->save();

                // store story details
                $details = new ScamDetail;
                $details->scammer_name = $request->scammer_name;
                $details->modus_operandi_scam_details = $request->modus_operandi_or_scam_details;
                $details->currency = isset($request->currency) ? $request->currency : null;
                $details->value_loss = isset($request->value_loss) ? $request->value_loss : null;
                $scam->details()->save($details);

                // save sender to victim (either a victim or not)
                $victim = new Victim;
                $victim->user_id = \Auth::id();
                $victim->victim = ($request->victim == 'on') ? true : false;
                $victim->reported = ($request->police == 'on') ? true : false;
                $scam->victims()->save($victim);

                // Create record for upvotes total
                $points = new Point;
                $points->score = ($request->victim == 'on') ? 10 : 5;
                $scam->score()->save($points);

            } else {
                $this->validate($request, Scam::$rules_url);

                // store story in database
                $scam = new Scam;
                $scam->title = $request->title;
                $scam->url = $request->url;
                $scam->external = true;
                $scam->save();

                // save sender to victim (either a victim or not)
                $victim = new Victim;
                $victim->user_id = \Auth::id();
                $victim->victim = ($request->victim == 'on') ? true : false;
                $victim->reported = ($request->police == 'on') ? true : false;
                $scam->victims()->save($victim);

                // Create record for upvotes total
                $points = new Point;
                $points->score = ($request->victim == 'on') ? 10 : 5;
                $scam->score()->save($points);
            }

        } else {
            return response(405);
        }

    }

    /**
     * Edit report function
     */
    public function edit($id)
    {
        //
    }

    /**
     * Store updated report
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Methods handling file upload
     */
    public function upload(Request $request)
    {
        //
    }

    /**
     * Delete report
     */
    public function destroy($id)
    {
        //
    }
}
