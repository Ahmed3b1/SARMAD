<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Review;
use App\Models\Setting;
use App\Models\orderdetails;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode ;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D ;

class AdminController extends Controller
{

   public function dashboard(Request $request)
    {
        // ====== الإحصائيات العامة ======
        $totalUsers = User::count();
        $totalOrders = Order::count();
        // $earnings = Order::sum('price');
        $totalProducts = Product::count();

        // ====== الفلاتر الزمنية ======
        // $from = $request->filled('from')
        //     ? Carbon::parse($request->input('from'))->startOfDay()
        //     : now()->subDays(30)->startOfDay();

        // $to = $request->filled('to')
        //     ? Carbon::parse($request->input('to'))->endOfDay()
        //     : now()->endOfDay();

        // ====== المستخدمين وزياراتهم ======
        // $users = User::query()
        //     ->withCount(['actions as visits_between' => function ($q) use ($from, $to) {
        //         $q->whereBetween('created_at', [$from, $to]);
        //     }])
        //     ->withMax('actions as last_activity_at', 'created_at')->latest()
        //     ->get();

        // ====== 🥇 أفضل المنتجات مبيعًا (Eloquent) ======
        // $bestsellerProducts = orderdetails::select('product_id')
        //     ->selectRaw('SUM(quantity) as total_sold')
        //     ->with('product:id,name')
        //     ->groupBy('product_id')
        //     ->orderByDesc('total_sold')
        //     ->take(6)
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'name' => $item->product?->name ?? 'Deleted Product',
        //             'sold' => $item->total_sold,
        //         ];
        //     });

        // ====== 👑 أكثر المستخدمين طلبًا (Eloquent) ======
        // $topUsers = Order::select('user_id')
        //     ->selectRaw('COUNT(*) as total_orders')
        //     ->whereNotNull('user_id')
        //     ->with('user:id,name')
        //     ->groupBy('user_id')
        //     ->orderByDesc('total_orders')
        //     ->take(6)
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'name' => $item->user?->name ?? 'Deleted User',
        //             'total_orders' => $item->total_orders,
        //         ];
        //     });

        // ====== عرض النتائج ======
        return view('admin.dashboard', [
            'totalUsers'         => $totalUsers,
            'totalOrders'        => $totalOrders,
            // 'earnings'           => $earnings,
            // 'totalProducts'      => $totalProducts,
            // 'users'              => $users,
            // 'from'               => $from,
            // 'to'                 => $to,
            // 'bestsellerProducts' => $bestsellerProducts,
            // 'topUsers'           => $topUsers,
        ]);
    }



    public function chartData(Request $request)
    {
        $type = $request->query('type', 'month'); // default month
        $orders = [];
        $earnings = [];
        $users = [];
        $products = [];
        $labels = [];

        if ($type === 'day') {
            $labels = range(1, 31);
            foreach ($labels as $day) {
                $orders[] = Order::whereDay('created_at', $day)->count();
                $earnings[] = Order::whereDay('created_at', $day)->sum('price');
                $users[] = User::whereDay('created_at', $day)->count();
                $products[] = Product::whereDay('created_at', $day)->count();
            }
        } elseif ($type === 'year') {
            $years = Order::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');
            $labels = $years;
            foreach ($years as $year) {
                $orders[] = Order::whereYear('created_at', $year)->count();
                $earnings[] = Order::whereYear('created_at', $year)->sum('price');
                $users[] = User::whereYear('created_at', $year)->count();
                $products[] = Product::whereYear('created_at', $year)->count();
            }
        } else {
            // default: month
            $labels = collect(range(1, 12))->map(fn($m) => date("F", mktime(0, 0, 0, $m, 1)));
            foreach (range(1, 12) as $month) {
                $orders[] = Order::whereMonth('created_at', $month)->count();
                $earnings[] = Order::whereMonth('created_at', $month)->sum('price');
                $users[] = User::whereMonth('created_at', $month)->count();
                $products[] = Product::whereMonth('created_at', $month)->count();
            }
        }

        return response()->json([
            'months' => $labels,
            'orders' => $orders,
            'earnings' => $earnings,
            'users' => $users,
            'products' => $products,
        ]);
    }




    public function adminSettings() {

        $settings = Setting::first() ;

        return view('admin.settings' , [ 'settings' => $settings ]);

    }

    public function generalSettings(Request $request) {

        $settings = Setting::first();

        // لو الجدول فاضي، ننشئ صف جديد
        if (!$settings) {
            $settings = new Setting();
        }

        // نحدّث البيانات
        $settings->store_name = $request->store_name;
        $settings->store_email = $request->store_email;
        $settings->phone = $request->phone;
        $settings->currency = $request->currency;
        $settings->language = $request->language;
        $settings->address = $request->address;

        if($request ->has('logo')) {
                $path= $request->logo-> move('uploads' , $request->logo) ;
                $settings->logo = $path ;
        }

            // ✅ رفع اللوجو لو تم إرساله
        // if ($request->hasFile('logo')) {
        //     $file = $request->file('logo');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads/settings'), $filename);
        //     $settings->logo = 'uploads/settings/' . $filename;
        // }

        // نحفظ التغييرات
        $settings->save();

        return redirect('/adminsettings');

    }

    // 💳 Payment Settings
    public function paymentSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();

        $settings->stripe_enabled = $request->has('stripe_enabled') ? 1 : 0;
        $settings->stripe_key = $request->stripe_key;
        $settings->paypal_enabled = $request->has('paypal_enabled') ? 1 : 0;

        $settings->save();

        return redirect('/adminsettings');

    }

    // 🚚 Shipping Settings
    public function shippingSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();

        $settings->shipping_cost = $request->shipping_cost ?? 0;
        $settings->free_shipping_above = $request->free_shipping_above ?? 0;

        $settings->save();

        return back()->with('success', 'Shipping settings updated successfully.');

    }

     // 📧 Email Settings
    public function emailSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();

        $settings->sender_name = $request->sender_name;
        $settings->sender_email = $request->sender_email;

        $settings->save();
        return back()->with('success', 'Email settings updated successfully.');
    }

    // 👤 Account Settings
    public function accountSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();

        $settings->admin_email = $request->admin_email;

        if ($request->filled('admin_password')) {
            $settings->admin_password = bcrypt($request->admin_password);
        }

        $settings->save();
        return back()->with('success', 'Admin info updated successfully.');

    }

      // 🔍 SEO Settings
    public function seoSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();

        $settings->meta_title = $request->meta_title;
        $settings->meta_description = $request->meta_description;

        $settings->save();
        return back()->with('success', 'SEO settings updated successfully.');
    }

    public function adminWatches() {

        $watches = Product::where('category_id', 1)->get() ;

        return view('admin.adminwatches',[ 'watches' => $watches]);

    }

    public function adminOrders()
    {
        $orders = Order::where('status','paid')->latest()->get();

        return view('admin.adminorders',compact('orders'));
    }

    public function adminOrderDetails($id)
    {
        $order = Order::with('orderItems.product')
                        ->findOrFail($id);

        return view('admin.adminorderdetails',compact('order'));
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->orderItems()->delete();

        $order->delete();

        return redirect()
                ->route('adminorders')
                ->with('success','Order deleted successfully.');
    }

    public function changeOrderStatus(Request $request,$id)
    {
        $request->validate([
            'delivery_status'=>'required'
        ]);

        $order = Order::findOrFail($id);

        $order->delivery_status = $request->delivery_status;

        $order->save();

        return redirect()->route('adminorders')->with('success','Status Updated Successfully.');
    }

    public function adminPerfumes() {

        $perfumes = Product::where('category_id', 2)->get() ;

        return view('admin.adminperfumes',[ 'perfumes' => $perfumes]);

    }

    public function adminSubcategories() {

        $categories = Category::all() ;
        $subcategories = Subcategory::all() ;

        return view('admin.admincategories',[ 'subcategories' => $subcategories , 'categories' => $categories]);

    }


    public function addSubcategory() {

        $allcategories = Category::all() ;
        $allsubcategories = Subcategory::all() ;

        return view('admin.addsubcategory',[ 'allcategories' => $allcategories , 'allsubcategories' => $allsubcategories]);

    }

    public function getSubcategoriesByCategory($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->orderBy('sort_order')->get(['id', 'name']);

        return response()->json($subcategories);
    }

    public function storeSubcategory(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255',
            // 'description' => 'required|string',
            'quote'       => 'required|string',
            'sort_order'  => 'required|integer',
        ]);

        Subcategory::create($validated);

        return redirect()->route('adminsubcategories')->with('success', 'تم إضافة القسم الفرعي بنجاح');
    }

    public function editSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $allcategories = Category::all();

        return view('admin.editsubcategory', [
            'subcategory'   => $subcategory,
            'allcategories' => $allcategories,
        ]);
    }

    public function updateSubcategory(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255',
            'quote'       => 'nullable|string',
            'sort_order'  => 'required|integer',
        ]);

        $subcategory->update($validated);

        return redirect()->route('adminsubcategories')->with('success', 'تم تحديث القسم الفرعي بنجاح');
    }

    public function deleteSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->back()->with('success', 'تم حذف القسم الفرعي بنجاح');
    }

    public function addWatch() {

        $allcategories = Category::all() ;

        return view('admin.addwatch', ['allcategories' => $allcategories]   );

    }

    public function addPerfume() {

        // $new = Auth::user() ;

        $allcategories = Category::all() ;

        return view('admin.addperfume', ['allcategories' => $allcategories]);

    }

    public function addCategory() {

        $allcategories = Category::all() ;

        return view('admin.addCategory',[ 'allcategories' => $allcategories]);

    }


    public function reviews() {

        $categories = Category::with('Product')->get() ;

        return view('admin.reviews',[ 'categories' => $categories]);

    }

    public function showReviews($productid) {

        $product = Product::find($productid) ;

        // $productreviews = review::where('product_id' , $productid)->with('user')->get() ;

        return view('admin.showreviews',[]);

    }

    public function addImages($productid) {

        $product = Product::find($productid) ;

        $productImages = ProductPhoto::where('product_id' , $productid)->get() ;

        return view('admin.addimage',[ 'product' => $product , 'productImages' => $productImages ]);

    }

    public function storeItemImage (Request $request) {

        $request->validate([
            'product_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        $photo = new ProductPhoto() ;
        $photo->product_id = $request->product_id ;

        if($request->has('photo')) {

            $fileName = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();

            $request->file('photo')->move(public_path('uploads/images'),$fileName);

            $photo -> imagepath = $fileName ;

        }

        $photo->save() ;

        return redirect()->back()->with('success', 'Image added successfully.');

    }

    public function editItem($productid = null) {

        if($productid != null){

            $currentProduct = Product::with('subcategory')->find($productid);
            if($currentProduct == null) {
                abort("403" , "can not find the product" ) ;
            }
            $allcategories = Category::all();

            // $qrCode= QrCode::size(200)->generate('www.codewithsaad.com') ;

            // $barcode= DNS1D::getBarcodeHTML('00201069873029' ,'C39') ;

            return view('admin.edititem' , ['product' => $currentProduct , 'allcategories' => $allcategories ]) ;

        } else {

            return redirect()->route('admindashboard');

        }


    }

    public function storeitem(Request $request) {

        $request->validate([
            'name' => ['required' , 'max: 10'] ,
            'price' => 'required|numeric' ,
            'quantity' => 'required|numeric|integer' ,
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,jpg,png,gif',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);


        // Product Editing
        if($request->id) {

            $currentProduct = Product::find($request->id) ;
            $currentProduct->name = $request->name ;
            $currentProduct->price = $request->price ;
            $currentProduct->quantity = $request->quantity ;
            $currentProduct->description = $request->description ;
            $currentProduct->category_id = $request->category_id ;
            $currentProduct->subcategory_id = $request->subcategory_id ;

            if ($request->hasFile('photo')) {

                if ($currentProduct->imagepath && file_exists(public_path('uploads/images/' . $currentProduct->imagepath))) {
                    unlink(public_path('uploads/images/' . $currentProduct->imagepath));
                }

                $fileName = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('uploads/images'), $fileName);

                $currentProduct->imagepath = $fileName;
            }

            $currentProduct->save() ;

            if($request-> category_id == 1){

                return redirect()->route('adminwatches') ;

            } else {

                return redirect()->route('adminperfumes') ;

            }

        } else {

            // Product Adding
            $newProduct = new Product() ;
            $newProduct -> name = $request -> name ;
            $newProduct -> price = $request -> price ;
            $newProduct -> quantity = $request -> quantity ;
            $newProduct -> description = $request -> description ;
            $newProduct -> imagepath =  'imagepath' ;
            $newProduct -> category_id =  $request -> category_id ;
            $newProduct -> subcategory_id =  $request -> subcategory_id ;

            // $path= $request -> photo -> move ('uploads/images' ,
            //         Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName()) ;

            $path = '' ;

            if($request ->has('photo')) {
                $fileName = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('uploads/images'),$fileName);

                $newProduct -> imagepath = $fileName ;

            }



            $newProduct->save() ;

            if($request-> category_id == 1){

                return redirect()->route('adminwatches') ;

            } else {

                return redirect()->route('adminperfumes') ;

            }



        }

    }

    public function storeCategory(Request $request) {

        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required',
            'slug' => 'required|alpha_dash|max:255',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);


        if($request->id) {

            // Category Editing

            $currentCategory = Category::find($request->id) ;
            $currentCategory->name = $request->name ;
            $currentCategory->slug = $request->slug ;
            $currentCategory->description = $request->description ;

            if($request ->has('photo')) {
                $path= $request -> photo -> move ('uploads' , $request->photo) ;
                $currentCategory -> imagepath = $path ;
            }

            $currentCategory->save() ;
            return redirect('/admineditcategory/' . $request->id) ;

        } else {

            // Adding Category

            $newcategory = new Category() ;
            $newcategory -> name = $request -> name ;
            $newcategory -> description = $request -> description ;
            $newcategory -> slug = $request -> slug ;
            $newcategory -> imagepath =  'imagepath' ;


            // $path= $request -> photo -> move ('uploads' ,
            //         Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName()) ;

            $path = '' ;

            if($request ->has('photo')) {
                $path= $request -> photo -> move ('uploads' , $request->photo) ;
            }

            $newcategory -> imagepath = $path ;

            $newcategory->save() ;

            return redirect()->route('adminsubcategories') ;

        }

    }


    public function adminUsers(Request $request) {

        // $user_id = Auth::id() ;


        $totalUsers = User::count();


        $from = $request->filled('from')
            ? Carbon::parse($request->input('from'))->startOfDay()
            : now()->subDays(30)->startOfDay();

        $to = $request->filled('to')
            ? Carbon::parse($request->input('to'))->endOfDay()
            : now()->endOfDay();

        $users = User::query()
            ->withCount(['actions as visits_between' => function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to]);
            }])
            ->withMax('actions as last_activity_at', 'created_at')->latest()
            ->paginate(10);


        return view('admin.users', [
            'totalUsers' => $totalUsers,
            'users'      => $users,
            'from'       => $from,
            'to'         => $to,
        ]);

    }

    public function adminUserProfile(Request $request , $id) {

        // $user_id = Auth::id() ;


        $totalUsers = User::count();


        $from = $request->filled('from')
            ? Carbon::parse($request->input('from'))->startOfDay()
            : now()->subDays(30)->startOfDay();

        $to = $request->filled('to')
            ? Carbon::parse($request->input('to'))->endOfDay()
            : now()->endOfDay();

        $user = User::query()
        ->withCount(['actions as visits_between' => function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        }])
        ->withMax('actions as last_activity_at', 'created_at')
        ->findOrFail($id);


        return view('admin.userprofile', [
            'totalUsers' => $totalUsers,

            'user'      => $user,
            'from'       => $from,
            'to'         => $to,
        ]);

    }

    public function editCategory($categoryid = null) {

        if($categoryid != null){

            $currentCategory = Category::find($categoryid);
            if($currentCategory == null) {
                abort("403" , "can not find the product" ) ;
            }
            $allcategories = Category::all();

            return view('admin.editcategory' , ['category' => $currentCategory , 'allcategories' => $allcategories]) ;

        } else {

            return redirect('/adminaddcategory') ;

        }


    }

    public function deleteItem($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function deleteItemPhoto($id)
    {
        $productphoto = Productphoto::findOrFail($id);

         if ($productphoto->imagepath && file_exists(public_path('uploads/images/' . $productphoto->imagepath))) {
            unlink(public_path('uploads/images/' . $productphoto->imagepath));
        }

        $productphoto->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

     public function deleteCategory($cateoryid = null ) {

        if ($cateoryid != null ) {

            $currentCategory = Category::find($cateoryid);
            $currentCategory->delete();

            return redirect('/admincategories') ;

        }

        else {

            abort(403 , "please enter product id in the route") ;

        }

    }

}
