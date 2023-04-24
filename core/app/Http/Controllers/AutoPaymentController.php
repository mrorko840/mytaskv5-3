<?php

namespace App\Http\Controllers;

use App\Models\AutoPayment;
use Illuminate\Http\Request;

class AutoPaymentController extends Controller
{
    public function index()
    {
        $pageTitle = 'eDokanPay Api';
        $autoPayment = AutoPayment::first();
        return view('admin.gateways.edokanpay.index', compact('autoPayment', 'pageTitle'));
    }
    
    public function update(Request $request)
    {
        $autoPayment = AutoPayment::first();
        $autoPayment->api_key       = $request->api_key;
        $autoPayment->client_key    = $request->client_key;
        $autoPayment->secret_key    = $request->secret_key;
        $autoPayment->save();
        
        $cls = 'success';
        $notify = 'Api Credential Updated Successfully';
        return response()->json(['msg'=>$notify, 'cls'=>$cls]);
    }
    
    public function destroy(AutoPayment $autoPayment)
    {
        //
    }
}
