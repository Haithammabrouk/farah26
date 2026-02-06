<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PaymentTrait;
use App\Models\User;

class HomeController extends Controller
{
    use PaymentTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(request()->all());
        // $user = User::first();

        // $online_payment_data = $this->online_payment_data(200, rand(), uniqid(), $user);
            
        // $signature = $this->signature($online_payment_data);
        
        return view('welcome', compact('online_payment_data', 'signature'));
    }
}
