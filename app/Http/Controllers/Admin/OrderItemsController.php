<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderItemsController extends Controller
{
    public function viewOrderItems(){
        if (request()->ajax()) {
            $order_items = OrderItem::with(['order', 'book'])->get();
            return DataTables::of($order_items)

                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {
                    return $row->order->customer_name;
                })
                ->addColumn('item_name', function ($row) {
                    return $row->book->name;
                })
                ->addColumn('item_price', function ($row) {
                    return $row->book->price;
                })
                ->rawColumns(['customer_name', 'item_name', 'item_price'])
                ->toJson();
        }
        return view('admin.order-items.index');
    }
}

