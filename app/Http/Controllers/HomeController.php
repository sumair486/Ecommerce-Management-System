<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Card;
use App\Models\Product;




class HomeController extends Controller
{
    public function redirect(){
        $usertype=Auth::user()->usertype;

        if($usertype=="1")
        {
            return view('admin.home');
        }

        else
        {
            $data=Product::paginate(3);//::all()
            $user=auth()->user();
            $count=Card::where('phone',$user->phone??'')->count();
            $prod=compact('data','count');
            return view('User.home')->with($prod);
        }
    }

    public function index(){

        if(Auth::id()){
            return redirect('redirect');
        }

        else{

            return view('User.home');

        }



    }


}
