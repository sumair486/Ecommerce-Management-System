<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Card;
use App\Models\Order;

use Illuminate\Support\Facades\Redis;

class AdminController extends Controller

{
    public function product()
    {
        if(Auth::id())
        {
        if(Auth::user()->usertype=='1')
        {
            return view('admin.product');

        }
        else
        {
            return redirect()->back();
        }

        }
        else{
            return redirect('login');
        }
    }

    public function uploadproduct(Request $request){
        $data=new product;
        $image=$request->file;
        $imagename=time(). "." .$image->getClientOriginalExtension();
        $request->file->move('productimage',$imagename);
        $data->image=$imagename;
        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->description;
        $data->quantity=$request->quantity;
        $result=$data->save();

           if($result){
            return redirect()->back()->with('success','Data successfully added');
        }
        else{
            return  redirect()->back()->with('fail','Something went wrong');

        }


    }

    public function view(){
        $data=Product::paginate(3);//::all()
        $user=auth()->user();
        $count=Card::where('phone',$user->phone??'')->count();
        $prod=compact('data','count');
        return view('User.home')->with($prod);

    }

    public function showproduct(){

        $data=Product::all();
        $prod=compact('data');
        return view('admin.showproduct')->with($prod);
    }

    public function deleteproduct($id){
        $data=Product::find($id);
        if(!is_null($data)){
            $data->delete();
            return redirect()->back()->with('successful','Product has beem delete');
        }
        return redirect('showproduct')->with('failed','Product already deleted');
    }

    public function updateview($id){

        $data=Product::find($id);
        $prod=compact('data');
        return view('admin.updateview')->with($prod);

    }
    public function updateproduct(Request $request,$id){
        $data=Product::find($id);
        $image=$request->file;
        if($image)
        {
        $imagename=time(). "." .$image->getClientOriginalExtension();
        $request->file->move('productimage',$imagename);
        $data->image=$imagename;
        }
        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->description;
        $data->quantity=$request->quantity;
        $result=$data->save();

           if($result){
            return redirect()->back()->with('success','Data successfully updated');
        }
        else{
            return  redirect()->back()->with('fail','Something went wrong');

        }
    }

    public function search(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $data=Product::paginate(3);//::all()
            $prod=compact('data');
            return view('User.home')->with($prod);
        }
        $data=Product::where('title','Like','%'.$search.'%')->get();
        return view('User.home',compact('data'));
    }

    public function addcart(Request $request,$id)
    {
        if(Auth::id())
        {


            $user=auth()->user();
            $product=Product::find($id);
            $cart=new Card();
            $cart->name=$user->name;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->product_title=$product->title;
            $cart->price=$product->price;
            $cart->quantity=$request->quantity;
            $cart->save();
            return redirect()->back()->with('succ','Product has been added to the cart');




        }
        else{
            return redirect('login');
        }
    }

    public function showcart()
    {
        $user=auth()->user();
        $cart=Card::where('phone',$user->phone)->get();
        $count=Card::where('phone',$user->phone)->count();
        return view('User.showcart',compact('cart','count'));
    }
    public function deletecart($id)
    {
        $data=Card::find($id);
        if(!is_null($data)){
            $data->delete();
            return redirect()->back()->with('suc','Product has beem delete from the Cart');
        }
        return redirect('showcard')->with('fai','Product already deleted');
    }

    public function confirmorder(Request $request)
    {
        $user=auth()->user();
        $name=$user->name;
        $phone=$user->phone;
        $address=$user->address;

        foreach($request->productname as $key=>$productname)
        {
            $order=new order();
            $order->product_title=$request->productname[$key];
            $order->price=$request->price[$key];
            $order->quantity=$request->quantity[$key];
            $order->name=$name;
            $order->phone=$phone;
            $order->address=$address;
            $order->status="Not Delivered";

            $order->save();


        }
        DB::table('cards')->where("phone",$phone)->delete();
        return redirect()->back();
    }

    public function showorder()
    {
        $order=order::all();

        return view('admin.showorder',compact('order'));


    }
    public function updatestatus($id)
    {
        $order=order::find($id);
        $order->status="Delivered";
        $order->save();

        return redirect()->back()->with('su','Order has been delivered Successfully');
    }

}
