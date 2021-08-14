<?php

namespace App\Http\Controllers;

use App\Color;
use App\GroupSize;
use App\Slider;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\Faq;
use App\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\User;
use App\Role;
use App\Subscriber;

class HomeController extends BaseController
{

    protected $result=[];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         parent::__construct();
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['sliders'] = Slider::get();
        $product = new Product();
        $this->data['featuredProducts'] = $product->getFeaturedProducts();
        $this->data['popularProducts'] = $product->getPopularProducts();
        $this->data['saleProducts'] = $product->getSaleProducts();
        $this->data['newProducts'] = $product->getNewProducts();
        $this->data['allProducts'] = $product->getAllProducts();
        $this->data['reviews'] = Review::latest()->limit(2)->get();
        return view('frontend.home', $this->data);
    }


    public function search()
    {
        request()->validate([
            'keyword' => 'required|string',

        ],[
            'keyword.required'=>'You must type something in order to search..'
        ]);

        $keyword = strtolower(request()->query('keyword'));
        $collection1=collect([]);
        $collection2=new Collection();
        $collection3=collect([]);

        $query = Product::with('images')
                        ->where(function ($query) use ($keyword) {
                            $query->where('title', 'like', "%{$keyword}%")
                                  ->orWhere('description', 'like', "%{$keyword}%");
                        });
        $collection1=$query->get();

        $categories=Category::where(function ($query) use ($keyword) {
                            $query->where('name', 'like', "%{$keyword}%");

                        })->get();


        if($categories->count()>0)
        {
            $array_of_collections=$this->searchProductByCategory($categories);

            foreach($array_of_collections as $collection)
            {
                foreach ($collection as $item) {
                   $collection2->push($item);
                }


            }




        }

      $query3=Brand::where(function ($query) use ($keyword) {
                            $query->where('brand_name', 'like', "{$keyword}%");

                        })->first();


        if(!is_null($query3))
        {
              $collection3=$query3->products;


        }

        $allItems = new \Illuminate\Database\Eloquent\Collection;
        $allItems = $allItems->merge($collection1);
        $allItems = $allItems->merge($collection2);
        $allItems = $allItems->merge($collection3);
        $this->data['result']=paginateCollection($allItems,$this->default_pagination_limit);

        return view('frontend.search',$this->data);







    }


   public function searchProductByCategory($categories)
    {


         foreach($categories as $category)
          {
            if ($category->has_children()) {

             $this->searchProductByCategory($category->sub_categories);



            }else
            {
                if($category->products->count()>0)
                {

                    $this->result[]= $category->products;


                }

            }
        }


       return $this->result;





    }




    public function categoryPage($categorySlug = null) {
        $limit = 12;
        $products = Product::query();
        $categoryModel = new Category();

        $brands = Brand::pluck('brand_name','id');
        $colors = Color::pluck('name','id');
        $sizes = GroupSize::pluck('size','id');

        $categoryId = "";
        $categoryName = "";
        if($categorySlug != null) {
            $category = Category::where('slug', $categorySlug)->first();
            $categoryId = $category->id;

            $childCategory = Category::with('childrenRecursive')
            ->where('id', $categoryId)
            ->first(); // to get child categories


            $categoryIds = $childCategory->getAllCategories(); // to get child categories ids

            array_push($categoryIds, $categoryId);

            $categoryName = $category->name;
            $products->whereIn('category_id', $categoryIds);
        }

        $products = $products->paginate($limit);
        $this->data['products'] = $products;
        $this->data['brands'] = $brands;
        $this->data['colors'] = $colors;
        $this->data['sizes'] = $sizes;
        $this->data['category_id'] = $categoryId;
        $this->data['category_name'] = $categoryName;
        $this->data['categorySlug'] = $categorySlug;

        return view('frontend.categories.index', $this->data);
    }

    public function loadCategory(Request $request, $limit = 12) {
        $products = Product::query();

        if (isset($request->limit) && !empty($request->limit)) {
            $limit = $request->limit;
        }

        if (isset($request->category_id) && !empty($request->category_id)) {
            $childCategory = Category::with('childrenRecursive')
                ->where('id', $request->category_id)
                ->first(); // to get child categories


            $categoryIds = $childCategory->getAllCategories(); // to get child categories ids

            array_push($categoryIds, $request->category_id);
            $products->whereIn('category_id', $categoryIds);
        }

        if (isset($request->price_max) && !empty($request->price_max)) {
            $products->where('user_price', '<=', $request->price_max);
        }

        if (isset($request->price_min) && !empty($request->price_min)) {
            $products->where('user_price', '>=', $request->price_min);
        }

        if (isset($request->price_order) && !empty($request->price_order)) {
            if ($request->price_order == 'asc') {
                $products->orderBy('user_price', 'asc');
            } else if($request->price_order == 'desc') {
                $products->orderBy('user_price', 'desc');
            }
        }

        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $products->whereIn('brand_id', $request->brand_id);
        }

        if (isset($request->sale) && $request->sale == 1) {
            $products->where('sale', $request->sale);
        }

        if (isset($request->popular) && $request->popular == 1) {
            $products->where('popular', $request->popular);
        }

        if (isset($request->feature) && $request->feature == 1) {
            $products->where('feature', $request->feature);
        }

        if (isset($request->color_id) && !empty($request->color_id)) {
            $productIds = DB::table('color_product')->whereIn('color_id', $request->color_id)->pluck('product_id');
            $products->whereIn('id', $productIds);
        }

        $products->limit($limit);

        $this->data['products'] = $products->paginate($limit);


        return view('frontend.categories.load_category', $this->data);
    }

    public function faq()
    {
        $this->data['faqs']=Faq::orderBy('priority','asc')->get();

        return view('frontend.faq',$this->data);
    }


    public function termsCondition()
    {
       return view('frontend.terms_conditions',$this->data);

    }


    public function requestWholeSeller()
    {
        return view('frontend.wholeseller_request',$this->data);

    }

    public function requestWholeSellerStore(Request $request)
    {

        $this->validate($request,[
            'first_name'=>'required|string|max:50',
            'last_name'=>'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'phone'=>'required|max:15',
            'address'=>'required|max:100',
            'document'=>'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'

        ]);

        $user=User::where('email',$request->email)->first();
        if(is_null($user))
        {

         $role              =      Role::where('name', 'wseller')->first();
         $user              = new User;
         $user->name        = $request->input('first_name').' '.$request->input('last_name');
         $user->email       = $request->input('email');
         $user->phone       = $request->input('phone');
         $user->password    = md5(rand(1,10000));
         $user->address =$request->input('address');
         $user->verified=1;
         $user->document =upload_image($request->document,'document',$image_path_from_public='users/documents');
         $user->save();
         $user->roles()->attach($role);
         // Mail::to($user)->send(new VerifyEmail($user));

        return redirect()->back()->with('success_message', 'Your request is sent successfully!,you will be notifiy after admin approval!');




        }else
        {
         return back()->with('failure_message','The email already exists!');

        }


    }

    public function aboutUs()
    {
        return view('frontend.about',$this->data);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscribers,email'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        session()->flash('success_message', "You've been subscribed.");
        return redirect()->back();
    }
}
