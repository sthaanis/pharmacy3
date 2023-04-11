<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\MedicineType;
use Auth;
use DB;
use Str;
use App\Models\Prescription;
class FrontendController extends Controller
{
    public function index()
    {
        $brand = Brand::where('status', 'active')->get();
        $slider = Slider::all();
        $featured = Product::where('is_featured', 'yes')->get();
        $newArrivals = Product::where('is_topselling', 'yes')->get();
        return view('front.index', ['brands' => $brand, 'sliders' => $slider, 'featuredProducts' => $featured,'newArrivals' => $newArrivals]);
    }

    public function productDetail($id)
    {
        $product = Product::where('id', $id)->first();
        return view('front.product.detail', ['product' => $product]);
    }

    public function register(Request $request)
  {
    $user = new User();
    $user->email = $request->get('email');
    $user->password =$request->get('password');
    $user->save();
    return redirect()->back();
  }


   public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
           return redirect()->back();
        }

        return back()->with([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pharmacy.front.index');
    }

    public function addToCart(Request $request){
        $productID = $request->get('product_id');
        $userID = Auth::user()->id;
        $quantity = $request->get('qty');
        
        $cart = new Cart();
        $cart->product_id = $productID;
        $cart->user_id = $userID;
        $cart->quantity= $quantity;
        $cart->save();
        return redirect()->back();
    }

    public function myAccount(){
        $order = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('user_id', Auth::user()->id)
            ->select('orders.*', 'products.product_name', 'products.mrp', 'products.image')
            ->get();
        $presc = Prescription::where('user_id',Auth::user()->id)->get();
        return view('front.myaccount',['orders'=>$order, 'prescs'=>$presc]);
    }

    public function viewCart(){
        if(Auth::check()){
            $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('user_id', Auth::user()->id)
            ->select('carts.*', 'products.product_name', 'products.mrp', 'products.image')
            ->get();
            return view('front.cart',['products'=>$cartItems]);
        }
    }

    public function placeOrder(Request $request){
        $qty = $request->get('qty');
        $productID = $request->get('product_id');
        $payment = $request->get('payment');
        // dump($payment);
        for($i=0; $i<count($productID); $i++){
            $order = new Order();
            $order->order_no = Str::random(10);
            $order->product_id = $productID[$i];
            $order->user_id = Auth::user()->id;
            $order->quantity = $qty[$i];
            $order->payment_method = $payment;
            $order->status = 'pending';
            $order->save();
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        return redirect()->back()->with("message","Order Placed Successfully");
    }

    public function removeItem(Request $request)
    {
        $itemId = $request->input('itemId');
        $item = Cart::find($itemId);
        if ($item) {
            $item->delete();
            return response('Item removed from cart.', 200);
        } else {
            return response('Error removing item from cart.', 500);
        }
    }

    public function shop(){
        $product = Product::latest()->get();
        return view('front.shop.shop',['products'=>$product]);
    }

    public function medicine(){
        $medicineType = MedicineType::where('status','active')->get();
        return view('front.shop.medicine',['medicineTypes'=>$medicineType]);
    }


    public function shopByCategory(Request $request){
        $category = Category::where('status','active')->get();
        return view('front.shop.category',['categories'=>$category]);
    }
    

    public function shopByBrand(){
        $brand = Brand::where('status','active')->get();
        return view('front.shop.brand',['brands'=>$brand]);
    }

    public function newArrival(){
        $product = Product::where('is_topselling','yes')->latest()->get();
        return view('front.shop.newarrival',['products'=>$product]);
    }

    public function filterByCategory(Request $request){
        $categoryID = $request->categoryID;
        $product = Product::where([['category_id',$categoryID],['status','publish']])->get();
        return view('front.shop.categoryproducts',['products'=>$product]);
    }

    public function filterByMedicine(Request $request){
        $medicineType = $request->medicineType;
        $product = Product::where([['medicine_type_id',$medicineType],['status','publish']])->get();
        return view('front.shop.medicineproducts',['products'=>$product]);
    }

    public function filterByBrand(Request $request){
        $brand = $request->brand;
        $product = Product::where([['brand_id',$brand],['status','publish']])->get();
        return view('front.shop.brandproducts',['products'=>$product]);
    }

    public function pharmacistLogin(){
        return view('pharm.login');
    }

    public function authenticatePharm(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('pharm')->attempt($credentials)) {
           return redirect()->route('pharmacy.pharm.dashboard');
        }

        return back()->with([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function LogisticLogin(){
        return view('log.login');
    }

    public function authenticateLog(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('log')->attempt($credentials)) {
           return redirect()->route('pharmacy.log.dashboard');
        }

        return back()->with([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logoutPharm(Request $request){
        Auth::guard('pharm')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended(route('pharmacy.pharmacist.login'));
    }

    public function logoutLog(Request $request){
        Auth::guard('log')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended(route('pharmacy.log.login'));
    }

    public function uploadPrescription(Request $request){
        $presc = new Prescription();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileOriginalName = $image->getClientOriginalName();
            $path = public_path('presc/');
            $fileName = date('Ymd') . '-' . Str::random(5) . '-' . $fileOriginalName;
            $image->move($path, $fileName);
            $presc->image = $fileName;
        }

        $presc->user_id = Auth::user()->id;
        $presc->status = 'pending';
        $presc->save();
        return redirect()->back();
    }
}

