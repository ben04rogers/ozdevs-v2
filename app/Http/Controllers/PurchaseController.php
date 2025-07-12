<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

        if (! $companyProfile) {
            return redirect()->route('newCompanyForm')->with('error', 'You must create a company profile before purchasing a subscription.');
        }

        return view('purchase', ['companyProfile' => $companyProfile]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

        if (! $companyProfile) {
            return redirect()->route('newCompanyForm')->with('error', 'You must create a company profile before purchasing.');
        }

        // If already subscribed, redirect
        if ($user->subscribed('default')) {
            return redirect()->route('purchase')->with('success', 'You are already subscribed.');
        }

        // Price ID is not sensitive so we can leave it here for now
        $stripePriceId = 'price_1NNuOmLy6lmd25t7G0dDmNKU';

        return $user->newSubscription('default', $stripePriceId)
            ->checkout([
                'success_url' => route('purchase.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('purchase'),
            ]);
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        CompanyProfile::where('user_id', $user->id)->first();

        return redirect()->route('purchase')->with('success', 'Your company subscription is now active. Thank you!');
    }
}
