<?php

namespace App\Http\Controllers\User;

use Image;
use App\Models\Deposit;
use App\Models\PtcView;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\CommissionLog;
use App\Models\GatewayCurrency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user = auth()->user();
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user'));
    }

    public function AjaxProfilePhoto(Request $request){

        $request->validate([
            'image' => 'required|image',
            
        ],[
            'image.required'=>'Image Field is required',
            'image.image'=>'It must be an Image'
        ]);

        $user = Auth::user();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $user->username.'.png';
            $location = 'assets/images/user/profile/'.$filename;
            $in['image'] = $filename;

            $path = './assets/images/user/profile/';
            $link = $path . $user->image;
            if ($link) {
                @unlink($link);
            }
            $size = imagePath()['profile']['user']['size'];
            $image = Image::make($image);
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[0]);
            $image->save($location);
        }
        $user->fill($in)->save();

        $cls = 'success';
        $notify = 'Profile Picture Upload Successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>$cls, 'img'=>$location]);
    }

    public function AjaxCoverPhoto(Request $request){
        $request->validate([
            'cover_image' => 'required|image',
            
        ],[
            'cover_image.required'=>'Image Field is required',
            'cover_image.image'=>'It must be an Image'
        ]);

        $user = Auth::user();
        if($request->hasFile('cover_image')){
            $image = $request->file('cover_image');
            $filename = rand(10000000,40000000) . '_' . $user->username.'.png';
            $location = 'assets/images/user/cover/'.$filename;
            $in['cover_image'] = $filename;

            $path = './assets/images/user/cover/';
            $link = $path . $user->cover_image;
            if ($link){
                @unlink($link);
            }
            $image = Image::make($image);
            // $image->resize(1024, 500);
            $image->save($location);
            
            $user->cover_image = $filename;
        }
        // $user->save();
        $user->fill($in)->save();

        $cls = 'success';
        $notify = 'Cover Picture Upload Successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>$cls, 'img'=>$location]);
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50'
            
        ],[
            'firstname.required'=>'First Name Field is required',
            'lastname.required'=>'Last Name Field is required'
        ]);

        $user = Auth::user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->mobile = $request->mobile;
        $user->save();
        $cls = 'success';
        $notify = 'Profile Updated successfully.';
        return response()->json(['msg'=>$notify, 'cls'=>$cls]);
    }


    public function Address()
    {
        $pageTitle = "Address Setting";
        $user = auth()->user();
        $data['user'] = Auth::user();
        $countries  = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user','data','countries'));
    }

    public function submitAddress(Request $request)
    {
        $request->validate([
            'address' => "sometimes|required|max:80",
            'state' => 'sometimes|required|max:80',
            'zip' => 'sometimes|required|max:40',
            'city' => 'sometimes|required|max:50',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'city' => $request->city,
        ];

        $user = Auth::user();
        $user->fill($in)->save();

        // $notify[] = ['success', 'Profile Updated successfully.'];
        // return back()->withNotify($notify);
        $cls = 'success';
        $notify = 'Address Updated successfully.';
        return response()->json(['msg'=>$notify, 'cls'=>$cls]);
    }

    public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {
        $passwordValidation = Password::min(6);
        $general = gs();
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required','confirmed',$passwordValidation]
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();

            $cls = 'success';
            $notify = 'Password changes successfully!';
            return response()->json(['msg'=>$notify, 'cls'=>$cls]);
        } else {
            
            $cls = 'error';
            $notify = 'The password doesn\'t match!';
            return response()->json(['msg'=>$notify, 'cls'=>$cls]);
        }
    }

    // public function submitPassword(Request $request)
    // {

    //     $passwordValidation = Password::min(6);
    //     $general = gs();
    //     if ($general->secure_password) {
    //         $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
    //     }

    //     $this->validate($request, [
    //         'current_password' => 'required',
    //         'password' => ['required','confirmed',$passwordValidation]
    //     ]);

    //     $user = auth()->user();
    //     if (Hash::check($request->current_password, $user->password)) {
    //         $password = Hash::make($request->password);
    //         $user->password = $password;
    //         $user->save();
    //         $notify[] = ['success', 'Password changes successfully'];
    //         return back()->withNotify($notify);
    //     } else {
    //         $notify[] = ['error', 'The password doesn\'t match!'];
    //         return back()->withNotify($notify);
    //     }
    // }

    public function display_profile()
    {   
        $pageTitle = "Profile Setting";
        $data['user'] = Auth::user();

        $user = Auth::user();

        $user                      = auth()->user();
        $widget['total_balance']   = $user->balance;
        $widget['total_deposit']   = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_withdrawn'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');

        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id());

        $ptc = PtcView::where('user_id', auth()->user()->id)->get(['view_date', 'amount']);

        $total_ptc_earn = Transaction::where('user_id',auth()->user()->id)->where('remark', 'ptc_earn')->sum('amount');

        $total_commission = CommissionLog::where('to_id',auth()->user()->id)->sum('amount');

        $total_invest = Transaction::where('user_id',auth()->user()->id)->where('remark', 'subscribe_plan')->sum('amount');

        return view($this->activeTemplate. 'user.display_profile', $data, compact(
            'pageTitle','user','widget',
            'remarks','transactions','total_ptc_earn',
            'ptc','total_commission','total_invest'
        ));
    }

    public function analytics()
    {
        $pageTitle = "Analytics";
        $data['user'] = Auth::user();
        $data['logs'] = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());

        $user = Auth::user();

        $user                      = auth()->user();
        $widget['total_balance']   = $user->balance;
        $widget['total_deposit']   = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_withdrawn'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');

        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id());

        $ptc = PtcView::where('user_id', auth()->user()->id)->get(['view_date', 'amount']);

        $total_ptc_earn = Transaction::where('user_id',auth()->user()->id)->where('remark', 'ptc_earn')->sum('amount');
        
        $total_commission = CommissionLog::where('to_id',auth()->user()->id)->sum('amount');

        $total_invest = Transaction::where('user_id',auth()->user()->id)->where('remark', 'subscribe_plan')->sum('amount');

        $chart['click'] = $ptc->groupBy('view_date')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(7)->toArray();

        $chart['amount'] = $ptc->groupBy('vdt')->map(function ($item, $key) {
            return collect($item)->sum('amount');
        })->sort()->reverse()->take(7)->toArray();

        return view($this->activeTemplate. 'user.analytics', $data, compact('user','chart', 'widget', 'pageTitle', 'remarks','transactions','total_ptc_earn', 'ptc','total_commission','total_invest'));
    }




}
