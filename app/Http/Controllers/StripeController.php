<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
//use Gloudemans\Shoppingcart\Facades\Cart;
use Session;
//use App\Http\Controllers\Order;
use App\Order;
use Stripe;
use Exception;

 
class StripeController extends Controller
{ 
      public function __construct()
    {
        $this->middleware("auth");
    }

    public function stripe()
    {
        return view('stripe');
    }



    public function stripePost(Request $request)
    {
        
  

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        Stripe\Charge::create ([
             
            "amount" => 200,
            "currency" => "usd",
        
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose",
            
        ]);
       
        Session::flash('success', 'Payment successful!');
        
        return redirect()->route('success1.payment');

    }
    public function paymentGood(Request $request)
    {
       
            foreach (\Cart::getContent() as $item) {
                Order::create([
                    "user_id" => auth()->user()->id,
                    "product_name" => $item->name,
                    "qty" => $item->quantity,
                    "price" => $item->price,
                    "total" => $item->price * $item->quantity,
                    "paid" => 1
                ]);
                
            }
            return view('success1');
            \Cart::clear();
        } 
         public function infoform(Request $request){
            return view('infoform');
         }
       
        
     
   
         
             
         
        
    }