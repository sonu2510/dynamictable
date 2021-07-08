<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigninController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function SubscribProcess()
            {
                return view('payumoney');
            }
        public function Response(Request $request)
            {
                dd('Payment Successfully done!');
            }
         public function SubscribeCancel()
            {
                 dd('Payment Cancel!');
            }
}
