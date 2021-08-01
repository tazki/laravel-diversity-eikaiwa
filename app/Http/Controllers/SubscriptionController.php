<?php

namespace App\Http\Controllers;

require_once('../vendor/autoload.php');
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use App\Models\UserPayments;

class SubscriptionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function retrievePlans() {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        
        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return $plans;
    }

    public function showSubscription($id) {
        if(!empty($id)) {
            $id = explode('|', urldecode(base64_decode($id)));
            $user_id = $id[0];
            $service_id = $id[1];        

            $plans = $this->retrievePlans();
            $user = Auth::user();
            
            return view('landing.subscribe', [
                'user'=>$user,
                'intent' => $user->createSetupIntent(),
                'plans' => $plans,
                'service_id' => $service_id
            ]);
        }
    }

    public function processSubscription(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');

        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
            $user->newSubscription('default', $plan)
                ->withPromotionCode(env('STRIPE_PROMOTION_CODE'))
                ->create($paymentMethod, [
                    'email' => $user->email
                ]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }

        // Update Subscription Status to Active
        // if($user->subscribed('default')) {
        //     $rowPayment = UserPayments::where([
        //         ['user_id', '=', $user->id],
        //         ['service_id', '=', $request->service_id],
        //         ['status', '=', 0]
        //     ])->first();

        //     $rowPaymentData['status'] = 2;
        //     $condition['id'] = $rowPayment->id;
        //     $row = UserPayments::updateOrCreate($condition, $rowPaymentData);
        // }

        return redirect('s/dashboard');
    }

    public function cancelSubscription(Request $request)
    {
        $user = Auth::user();
        try {
            $user->subscription('default')->cancel();
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error cancelling subscription. ' . $e->getMessage()]);
        }

        return back()->with('success','Subscription Cancel successfully');
    }

    public function resumeSubscription(Request $request)
    {
        $user = Auth::user();
        try {
            $user->subscription('default')->resume();
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error resuming subscription. ' . $e->getMessage()]);
        }

        return back()->with('success','Subscription Resume successfully');
    }
}
