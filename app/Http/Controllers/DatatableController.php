<?php

namespace App\Http\Controllers;

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
            'external'])->with('totalPoint');

        $datatables = Datatables::of($st)
            ->addColumn('uv', function ($std) {
                return $std->id;
            })
            ->editColumn('title', function ($std) {
                if ($std->external) {
                    return ['title' => $std->title, 'url' => $std->url, 'external' => 1, 'points' => 123 ];
                } else {
                    return ['title' => $std->title, 'location' => $std->location, 'external' => 0, 'points' => 124];
                }
            })
            ->addColumn('details', function ($std) {
                return [ 'id' => $std->id ];
            })
            ->rawColumns(['name']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }
}
