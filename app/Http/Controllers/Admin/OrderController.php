<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use Exception;
use Illuminate\Support\Facades\Mail;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class OrderController extends Controller
{

    public function index(Request $request) {
        // $todayDate = Carbon::now();
        // $orders = Order::where('created_at', $todayDate)->paginate(5);
        // dd($request->date);
        $orders = Order::when($request->date != null, function ($query) use ($request) {
                            $query->whereDate('created_at', $request->date);
                        })
                        ->when($request->status != null, function ($query) use ($request) {
                            $query->where('status_message', $request->status);
                        })
                        ->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderId) {
        $order = Order::where('id', $orderId)->first();
        return view('admin.orders.view', compact('order'));
    }

    public function updateStatus($orderId, Request $request) {
        Order::where('id', $orderId)->update(['status_message' => $request->status]);
        return redirect()->back();
    }

    public function viewInvoice($orderId) {
        $order = Order::where('id', $orderId)->first();
        return view('admin.invoice.view', compact('order'));
    }

    public function pdfGenerate($orderId) {
        $order = Order::findOrFail($orderId);
        // $data = $order->toArray();
        $data = ['order' => $order];
        $pdf = LaravelMpdf::loadView('admin.invoice.view', $data);
        return $pdf->stream('order'.$order->id.'.pdf');
    }

    public function mailInvoice($orderId) {
        $order = Order::findOrFail($orderId);

        try {
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            return redirect('admin/orders/'.$order->id)->with('message', 'Email has sent!');
        } catch (Exception $e) {
            return redirect('admin/orders/'.$order->id)->with('message', 'Something went wrong!');
        }

    }
}
