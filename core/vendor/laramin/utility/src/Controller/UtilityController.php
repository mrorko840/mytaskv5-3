<?php

namespace Laramin\Utility\Controller;

use App\Lib\CurlRequest;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Laramin\Utility\VugiChugi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UtilityController extends Controller{

    public function laraminStart()
    {
        $pageTitle = VugiChugi::lsTitle();
        return view('Utility::log',compact('pageTitle'));
    }

    public function laraminSubmit(Request $request){

        $pageTitle = VugiChugi::lsTitle();

        $this->validate($request, [
            'code' => 'required',
        ]);
        $code           = gs();
        $code->code     = $request->code;
        $code->save();

        // if($request->code == $_SERVER['SERVER_NAME']){
        //     $notify[] = ['success', 'Purchase Code Submit successfully.'];
        // }else{
        //     $notify[] = ['error', 'Enter valid Purchase Code.'];
        // }

        if($request->code == $_SERVER['SERVER_NAME']){
            $notify = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Purchase Code Submit successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }else{
            $notify = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Enter valid Purchase Code.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

        // if($request->code == $_SERVER['SERVER_NAME']){
        //     Session::flash('msg','Purchase Code Submit successfully.!');
        // }else{
        //     Session::flash('msg','Enter valid Purchase Code.');
        // }

        // $param['code'] = $request->purchase_code;
        // $param['url'] = env("APP_URL");
        // $param['user'] = $request->envato_username;
        // $param['email'] = $request->email;
        // $param['product'] = systemDetails()['name'];
        // $reqRoute = VugiChugi::lcLabSbm();
        // $response = CurlRequest::curlPostContent($reqRoute, $param);
        // $response = json_decode($response);

        // if ($response->error == 'error') {
        //     return response()->json(['type'=>'error','message'=>$response->message]);
        // }

        // $env = $_ENV;
        // $env['PURCHASECODE'] = $request->purchase_code;
        // $envString = '';
        // foreach($env as $k => $en){
        //     $envString .= $k.'='.$en.'
        //     ';
        // }

        // $envLocation = substr($response->location,3);
        // $envFile = fopen($envLocation, "w");
        // fwrite($envFile, $envString);
        // fclose($envFile);

        // $laramin = fopen(dirname(__DIR__).'/laramin.json', "w");
        // $txt = '{
        //     "purchase_code":'.'"'.$request->purchase_code.'",'.'
        //     "installcode":'.'"'.@$response->installcode.'",'.'
        //     "license_type":'.'"'.@$response->license_type.'"'.'
        // }';
        // fwrite($laramin, $txt);
        // fclose($laramin);

        // $general = GeneralSetting::first();
        // $general->maintenance_mode = 0;
        // $general->save();

        //return response()->json(['type'=>'success']);

        return view('Utility::log',compact('notify','pageTitle'));

    }

    public function activation()
    {
        $pageTitle = 'Activation Code';
        return view('Utility::code',compact('pageTitle'));
    }

    public function activationSubmit(Request $request){
        $this->validate($request, [
            'code' => 'required',
        ]);
        $code           = gs();
        $code->code     = $request->code;
        $code->save();

        if($request->code == $_SERVER['SERVER_NAME']){
            $notify[] = ['success', 'Purchase Code Submit successfully.'];
        }else{
            $notify[] = ['error', 'Enter valid Purchase Code.'];
        }

        
        return back()->withNotify($notify);
    }


}
