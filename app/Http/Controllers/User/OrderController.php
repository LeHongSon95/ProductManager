<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array[]
     */
    public function order(Request $request)
    {
        DB::beginTransaction();
        $idCustomer = auth()->guard('api')->user()->id;
        $idProduct = $request->ids;
        if (empty($idProduct)) {
            return false;
        }
        $products = Product::select('id', 'name', 'stock', 'price')->whereIn('id', $idProduct)->get();
        $productCount = array_count_values($idProduct);
        $total = 0;
        $quantity_order = 0;
        $orders = array();
        try {
            foreach ($products as $product) {
                if ($product->stock > 0) {
                    $product->stock -= $productCount[$product->id];
                    $product->save();
                    $orders = array(
                        'customer_id' => $idCustomer,
                        'quantity' => $quantity_order += $productCount[$product->id],
                        'total' => $total += $product->price * $productCount[$product->id]
                    );
                } else {
                    $error[] = 'Out of stock product ' . $product->name;
                }
            }
            $order = Order::create($orders);
            foreach ($products as $pro) {
                if ($pro->stock > 0) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $pro->id,
                        'quantity' => $productCount[$pro->id],
                        'price' => $pro->price * $productCount[$pro->id],
                        'status' => 1
                    ]);
                }
            }
            $order_detail = OrderDetail::select('order_detail.id', 'order_id', 'product_id', 'quantity', 'order_detail.price', 'status', 'name')
                ->where('order_id', $order->id)->join('products', 'products.id', '=', 'order_detail.product_id')
                ->get()->toArray();
            DB::commit();
            return response()->json([
                'order' => $order,
                'order_detail' => $order_detail,
                'error' => $error
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Order::select('id', 'customer_id', 'quantity', 'total', 'created_at')
                ->with('customers')
                ->get();
            return view('admin.product.order', ['data' => $data]);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    

    
}
