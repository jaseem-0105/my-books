<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Query;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuthException;
use JWTAuth;

class MyBookApiController extends Controller
{
    private function getToken($user)
    {
        $token = null;
        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'User is invalid..',
                    'token' => $token,
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'Token creation failed',
            ]);
        }
        return $token;
    }

    public function getAllBooks()
    {
        $books = Book::get();
        $response = ["success" => true, "data" => $books];
        return response()->json($response);
    }

    public function myOrders()
    {
        $orders = Order::where('user_id',auth()->user()->id)->with('orderItems')->get();
        $response = ["success" => true, "data" => $orders];
        return response()->json($response);
    }

    public function getLatestBooks()
    {
        $books = Book::latest()->take(4)->get();
        $response = ["success" => true, "data" => $books];
        return response()->json($response);
    }
    public function getBook($id)
    {
        $book = Book::where('id', $id)->first();
        $response = ["success" => true, "data" => $book];
        return response()->json($response);
    }


    public function register(Request $request)
    {

        $payload = [
            'password' => \Hash::make($request['password']),
            'name' => $request['name'],
            'email' => $request['email'],
        ];
        $user = new User($payload);
        if ($user->save()) {

            $response = ['success' => true, 'data' => $user];
        } else {

            $response = ['success' => false, 'data' => 'User creation failed'];
        }

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && \Hash::check($request->password, $user->password)) {

            $token = self::getToken($user);
            $user->auth_token = $token;
            $user->save();
            $response = [
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'auth_token' => $user->auth_token,
                    'email' => $user->email,
                ],
            ];
        } else {
            $response = ['success' => false, 'data' => 'Invalid email or password'];
        }
        return response()->json($response, 201);
    }

    // public function myOrdes(){

    // }
    public function storeQueries(Request $request)
    {
        $query = new Query();
        $query->name = $request->name;
        $query->email = $request->email;
        $query->query = $request->query;
        $query->save();
    }


    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->total_amount = $request->total_amount;

        $order->save();

        foreach ($request['orderitems'] as $item) {
            $originalItem = Book::where('id', $item['id'])->first();
            $oi = new OrderItem();
            $oi->item_id = $originalItem->id;
            $oi->order_id = $order->id;
            $oi->save();
        }
        $response = ['success' => true, 'data' => 'Order Placed Successfully'];

        return response()->json($response, 201);
    }
}
