<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Query;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QueryController extends Controller
{
    public function viewQueries(){
        if (request()->ajax()) {
            $queries = Query::get();
            return DataTables::of($queries)
            ->addIndexColumn()
                ->toJson();
        }
        return view('admin.query.index');
    }
}
