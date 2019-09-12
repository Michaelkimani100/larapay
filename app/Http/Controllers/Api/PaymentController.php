<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array(
            'phone'=>'required',
            'amount'=>'required'
        );
        $timestamp='20'.date(    "ymdhis");
        $this->validate($request,$rules);
        $phone=$request->input('phone');
        $amount=$request->input('amount');
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode= 174379;
        $LipaNaMpesaPasskey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType='CustomerPayBillOnline';
        $Amount=$amount;
        $PartyA=$phone;
        $PartyB=$BusinessShortCode;
        $PhoneNumber=$phone;
        $CallBackURL='https://56c4476b.ngrok.io/api/response';
        $AccountReference='test';
        $TransactionDesc='Testing';
        $Remarks='test';
        $pass='IDE3NDM3OUtoRVd0QTh4dlIzRURvRzJGUkdvRXRQdzNmUEsyMDE5MDkwMjAxNTgwMg==';
        $password=base64_encode($BusinessShortCode.$LipaNaMpesaPasskey.$timestamp);
        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode,$password,$timestamp, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);
        return response()->json($stkPushSimulation);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function response()
    {
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        $callbackData=$mpesa->getDataFromCallback();
        return respose()->json($callbackData);
    }
}
