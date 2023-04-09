<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ptc;
use App\Models\Plan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ManagePtcController extends Controller
{
    public function index()
    {
        $pageTitle = 'PTC Advertisements';
        // $ads = $this->ptcData();
        $ads = Ptc::orderBy('id', 'desc')->get();
        $plans = Plan::get();
        return view('admin.ptc.index', compact('pageTitle', 'ads', 'plans'));
    }

    public function pending()
    {
        $pageTitle = 'Pending PTC Advertisements';
        $plans = Plan::get();
        // $ads = $this->ptcData('pending');
        $ads = Ptc::where('status', 2)->orderBy('id', 'desc')->get();
        return view('admin.ptc.index', compact('pageTitle', 'ads', 'plans'));
    }

    public function active()
    {
        $pageTitle = 'Active PTC Advertisements';
        $plans = Plan::get();
        // $ads = $this->ptcData('active');
        $ads = Ptc::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.ptc.index', compact('pageTitle', 'ads', 'plans'));
    }

    public function inactive()
    {
        $pageTitle = 'Inactive PTC Advertisements';
        $plans = Plan::get();
        // $ads = $this->ptcData('inactive');
        $ads = Ptc::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.ptc.index', compact('pageTitle', 'ads', 'plans'));
    }

    public function rejected()
    {
        $pageTitle = 'Rejected PTC Advertisements';
        $plans = Plan::get();
        // $ads = $this->ptcData('rejected');
        $ads = Ptc::where('status', 3)->orderBy('id', 'desc')->get();
        return view('admin.ptc.index', compact('pageTitle', 'ads', 'plans'));
    }

    private function ptcData($scope = null)
    {
        if ($scope) {
            $ads = Ptc::$scope()->with('user')->orderBy('id', 'desc');
        } else {
            $ads = Ptc::with('user')->orderBy('id', 'desc');
        }

        return $ads->paginate(getPaginate());
    }

    public function create(Request $request)
    {
        $pageTitle = 'Add Advertisement';
        $plans = Plan::get();
        return view('admin.ptc.create', compact('pageTitle', 'plans'));
    }

    public function edit(Request $request, $id)
    {
        $pageTitle = 'Edit Advertisement';
        $plans = Plan::get();
        $ptc = Ptc::findOrFail($id);
        return view('admin.ptc.edit', compact('pageTitle', 'ptc', 'plans'));
    }

    public function store(Request $request)
    {
        $this->validation($request, [
            'website_link' => 'nullable|url|required_without_all:banner_image,script,youtube',
            'banner_image' => 'nullable|mimes:jpeg,jpg,png,gif|required_without_all:website_link,script,youtube',
            'script' => 'nullable|required_without_all:website_link,banner_image,youtube',
            'youtube' => 'nullable|url|required_without_all:website_link,banner_image,script',
        ]);

        $ptc = new Ptc();
        $plan = Plan::where('status', 1)->findOrFail($request->plan_id);
        $this->submit($request, $ptc, $plan);
        $notify[] = ['success', 'Advertisement added successfully.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
        $ptc = Ptc::findOrFail($id);
        $plan = Plan::where('status', 1)->findOrFail($request->plan_id);
        $this->submit($request, $ptc, $plan, 1);
        $notify[] = ['success', 'Advertisement updated successfully.'];
        return back()->withNotify($notify);
    }


    public function submit($request, $ptc, $plan, $isUpdate = 0)
    {
        $ptc->title = $request->title;
        $ptc->plan_id = $request->plan_id;
        $ptc->amount = $plan->ads_rate;
        $ptc->duration = $request->duration;
        $ptc->max_show = $request->max_show;
        if (!$isUpdate) {
            $ptc->remain = $request->max_show;
        }
        $ptc->ads_type = $request->ads_type;
        $user = $ptc->user;
        if ($isUpdate && $request->status == 3 && $ptc->user_id != 0 && $ptc->status != 3) {
            $general = gs();
            if ($ptc->ads_type == 1) {
                $price = @$general->ads_setting->ad_price->url ?? 0;
            } elseif ($ptc->ads_type == 2) {
                $price = @$general->ads_setting->ad_price->image ?? 0;
            } elseif ($ptc->ads_type == 3) {
                $price = @$general->ads_setting->ad_price->script ?? 0;
            } else {
                $price = @$general->ads_setting->ad_price->youtube ?? 0;
            }
            $amount = $ptc->remain * $price;
            $user->balance += $amount;
            $user->save();

            $trx = getTrx();
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->trx_logo = 'reject_logo.png';
            $transaction->details = 'PTC advertisement rejected';
            $transaction->remark = 'ad_reject';
            $transaction->trx = $trx;
            $transaction->save();

            notify($user, 'PTC_REJECT', [
                'title' => $ptc->title,
                'quantity' => $ptc->max_show,
                'duration' => $ptc->duration,
                'back_amount' => $amount,
                'post_balance' => $user->balance,
                'trx' => $trx,
            ]);
        }

        if ($ptc->status == 2 && $request->status == 1 && $user) {
            notify($user, 'PTC_APPROVE', [
                'title' => $ptc->title,
                'quantity' => $ptc->max_show,
                'duration' => $ptc->duration,
            ]);
        }

        if ($isUpdate) {
            $ptc->status = $request->status ?? 1;
        } else {
            $ptc->status = ($request->status == 'on' ? 1 : 0);
        }

        if ($request->ads_type == 1) {
            $ptc->ads_body = $request->website_link;
        } elseif ($request->ads_type == 2) {

            if ($request->hasFile('banner_image')) {
                if ($isUpdate == 1) {
                    $old = $ptc->ads_body;
                    fileManager()->removeFile(getFilePath('ptc') . '/' . $old);
                }
                $directory = date("Y") . "/" . date("m") . "/" . date("d");
                $path = getFilePath('ptc') . '/' . $directory;
                $filename = $directory . '/' . fileUploader($request->banner_image, $path);
                $ptc->ads_body = $filename;
            }
        } elseif ($request->ads_type == 3) {
            $ptc->ads_body = $request->script;
        } else {
            $ptc->ads_body = $request->youtube;
        }
        $ptc->save();
    }


    public function validation($request, $rules = [])
    {
        $globalRules = [
            'title' => 'required',
            'plan_id' => 'required',
            'duration' => 'required|numeric|min:1',
            'max_show' => 'required|numeric|min:1',
            'ads_type' => 'required|integer',
        ];
        $rules = array_merge($globalRules, $rules);
        $request->validate($rules);
    }
}
