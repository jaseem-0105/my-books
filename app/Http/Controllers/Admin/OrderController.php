<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
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
                ->addColumn('item',function ($row){
                    $name = '';
                    $orderItems = OrderItem::where('order_id', $row->id)->get();
                    foreach ($orderItems as $key => $orderItem) {
                        $name .= $orderItem->book->name .', ';
                    }
                    return $name;
                })

                ->rawColumns(['name', 'item'])
                ->toJson();
        }
        return view('admin.orders.index');
    }
}
