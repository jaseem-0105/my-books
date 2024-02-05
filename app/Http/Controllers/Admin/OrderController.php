<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function viewOrders(){
        if (request()->ajax()) {
            $orders = Order::get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->user->name; // Assuming your User model has a 'name' attribute
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="text-white btn btn-success" data-id=' . $row->id . '">View</a>';
                    return $btn;
                })
                ->rawColumns(['action','name'])
                ->toJson();
        }
        return view('admin.orders.index');
    }
}
