<?php

namespace App\Http\Controllers;

use App\Upvote;
use Datatables;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function stories(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $st = \App\Scam::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'title',
            'location',
            'url',
            'external'])->with('totalPoint')->with('score');

        $datatables = Datatables::of($st)
            ->addColumn('uv', function ($std) {

                if (\Auth::check()) {
                    $upvoteCheck = Upvote::where('user_id', \Auth::id())->where('scam_id', $std->id)->exists();
                    if ($upvoteCheck) {
                        return 'voted';
                    }
                }

                return $std->id;
            })
            ->editColumn('title', function ($std) {

                if ($std->external) {
                    $fullArray = ['title' => $std->title, 'url' => $std->url, 'external' => 1, 'points' => $std->score->score];
                } else {
                    $fullArray = ['title' => $std->title, 'location' => $std->location, 'external' => 0, 'points' => $std->score->score];
                }

                return $fullArray;
            })
            ->addColumn('details', function ($std) {
                return ['id' => $std->id];
            })
            ->rawColumns(['name']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }
}
