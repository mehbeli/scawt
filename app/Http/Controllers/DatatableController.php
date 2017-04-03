<?php

namespace App\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function scammer(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $st = \App\ScammerTest::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'first_report',
            'location']);

        $datatables = Datatables::of($st)
            ->addColumn('uv', function ($std) {
                return $std->id;
            })
            ->editColumn('name', function ($std) {
                return '<div><b>' . $std->name . '</b></div><div style="font-size: 10px;">' . $std->location . '</div>';
            })
            ->editColumn('first_report', function ($std) {
                return \Carbon\Carbon::createFromFormat('Y-m-d', $std->first_report)->diffForHumans();
            })
            ->addColumn('details', function ($std) {
                return $std->id;
            })
            ->rawColumns(['name']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }
}
