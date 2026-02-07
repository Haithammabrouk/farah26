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
     * Redirect to admin panel by default.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Redirect to admin panel
        return redirect()->route('adminPanel.dashboard');
    }
}
