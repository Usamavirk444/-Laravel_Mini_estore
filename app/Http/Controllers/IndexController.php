<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Chef;
use App\Models\Cart;
use App\Models\Reservation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $data = food::all(); 
        $chef = Chef::all(); 
        return view('index',compact('data','chef'));
    }

    public function some(){
        $data =Food::all();
        $chef  =Chef::all();
        $role = Auth::user()->role;
        if ($role == '1') {
            return view('admin.admin');
        }
        else{
            $user_id = Auth::id();
            $count = Cart::where('user_id',$user_id)->count();

            return view('index', compact('data','chef', 'count')); 
        }
    }

    public function admin_home(){
        return view('admin.dash');
    }
    public function users(){
        $user = User::all();
        return view('admin.users',compact('user'));
    }
   
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
    // ######---FOOD SECTION----######

    public function foodMenu(){
        return view('admin.foodMenu');
          
    }

    // insert food into Db
     public function insertFood(Request $request){
         
        $food = new Food;
        $food->title = $request->input('fname');
        $food->price = $request->input('fprice');
        $food->description = $request->input('fdes');
        if ($file = $request->file('fimg')) {
            $extation = $file->getClientOriginalExtension();
            $fileName = date('YmdHis'). '.' . $extation;
            $file->move('admin/food/', $fileName);
            $food->img =$fileName;

        }
        $food->save();
        return redirect('foodMenu');
     }

    // View food From Db

     public function view_food(){
         $food = Food::all();
        return view('admin.viewFood',compact('food'));

     }
    // Delete food from Db

     public function delFood($id){
         $food = Food::find($id);
         $destination = 'admin/food/'.$food->img;
         if (File::exists($destination)) {
             File::delete($destination);
         }
         $food->delete();
        return redirect()->back();

     }

    // edit food into Db

     public function edit($id){
         $edit =DB::table('food')->where('id',$id)->first();
         $data =[
             'row'=>$edit
         ];
         return view('admin.editFood',$data);

     }

    //  update food 

    public function update(Request $request,$id){
        $food = Food::find($id);
   
        $food->title = $request->input('fname');
        $food->price = $request->input('fprice');
        $food->description = $request->input('fdes');
        $destination = 'admin/food/'.$food->img;

        if ($file = $request->file('fimg')) {
           
        
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $extation = $file->getClientOriginalExtension();
            $fileName = date('YmdHis'). '.' . $extation;
            $file->move('admin/food/', $fileName);
            $food->img =$fileName;
    }
        
        $food->update();
        return redirect('admin.viewFood');


    }


    // ###########--Chef--################

    public function addChef(){
        return view('admin.addChef');
          
    }

    public function insertChef(Request $request){
        $chef = new Chef;
        $chef->name= $request->input('cname');
        $chef->speciality= $request->input('cspeciality');
        

        if ($file = $request->file('cimg')) {
            $destination = $file->getClientOriginalExtension();
            $filename = date('YmdHis').'.'. $destination;
            $file->move('admin/chef/', $filename);
            $file->chefImage = $file;
        }
        $chef->save();
        return redirect()->back();
       
          
    }
    public function viewChef(){
        $chef = Chef::all();
        return view('admin.viewChef', compact('chef'));
    }
    public function delChef($id){
        $chef = Chef::find($id);
        $chef->delete();
        return redirect()->back();
    }
    public function editChef($id){
        $chef = DB::table('chefs')->where('id',$id)->first();
        $data = [
            'row'=> $chef
        ];
       
        return view('admin.editChef',$data);
    }
    public function updateChef(Request $request, $id){
            $chef =Chef::find($id);
            $chef->name= $request->input('cname');
            $chef->speciality= $request->input('cspeciality');
            $destination = 'admin/chef/'.$chef->chefImage;
            if ($file = $request->file('cimg')) {
                if (File::exists($destination)) {
                   
                }
                $destination = $file->getClientOriginalExtension();
                $filename = date('YmdHis').'.'. $destination;
                $file->move('admin/chef/', $filename);
                $file->chefImage = $file;
            }
            $chef->save();
            return redirect('admin.viewChef');
    }

    //reservation

    public function reservation(Request $request){

        $reserve = new Reservation;
        $reserve->name = $request->input('rname');
        $reserve->email = $request->input('remail');
        $reserve->phone = $request->input('rphone');
        $reserve->guest = $request->input('guest');
        $reserve->date = $request->input('date');
        $reserve->time = $request->input('time');
        $reserve->msg = $request->input('message');
        $reserve->save();
        return redirect()->back();
    }

    public function viewReserve(){
        $reserve = Reservation::all();
        return view('admin.reservation', compact('reserve'));
    }
    //addcart
    public function addcart(Request $request, $id){
        
        if (Auth::id()) {
            $user_id = Auth::id();
            $food_id = $id;
          
            $quantity = $request->quality;

            $cart =new Cart;
            $cart->user_id = $user_id;
            $cart->food_id = $food_id;
            $cart->Quantity = $quantity;
            $cart->save();
            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }

    public function showcart(Request $request, $id){
        $count = Cart::where('user_id', $id)->count();
        $data1 = Cart::select('*')->where('user_id', '=', $id)->get();
        $data = Cart::where('user_id',$id)->join('food', 'carts.food_id', 'food.id')->get();
        return view('showcart', compact('count','data', 'data1'));


    }
    public function remove($id){
        
    $data = Cart::find($id);
    $data->delete();
    return redirect()->back();

    }

}
