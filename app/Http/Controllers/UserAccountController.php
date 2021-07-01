<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wishlist;
use App\Product;
use App\Review;


class UserAccountController extends BaseController
{

	public function index()
	{
		$this->data['user']=auth()->user();
		$this->data['title']='Account Details';
		return view('frontend.account.account_detail',$this->data);
	}

	public function myWishlist()
	{
		$user=auth()->user();
		$this->data['wishlists']=$user->wishlists()->latest()->with('firstImage')->get();
		$this->data['title']='My Wishlist';

		return view('frontend.account.wishlist',$this->data);
	}

	public function myOrderHistory()
	{
		$user=auth()->user();
		$this->data['orders']=$orders=$user->orders;




		$this->data['title']='My Order History';
		return view('frontend.account.order_history',$this->data);
	}


	public function updateProfile(Request $request)
	{
		$user=$request->user();

		$data=[
			'name'=>$request->input('name'),
			'phone'=>$request->phone,
			'address'=>$request->address

		];

		if($user->update($data))
		{
			return response()->json(['status'=>true,'message'=>'Profile updated successfully!']);
		}

		return response()->json(['status'=>false]);




		// return $user=auth()->user();

	}



	public function addToWishList($product_id)
	{

			if(auth()->check())
			{
				$user=auth()->user();
				if(request()->ajax())
				{


		            // $user->wishlists()->syncWithoutDetaching($product_id);
		            $productExist=$user->wishlists()->where('product_id',$product_id)->first();
		            if($productExist)
		            {
		            	$user->wishlists()->detach($product_id);
		            	$code=0;


		            }else
		            {
		            	$code=1;
		            	$user->wishlists()->attach($product_id);

		            }



		            // $user->wishlists()->toggle($product_id);
		            return response()->json(['status'=>true,'code'=>$code]);

				}else
				{
					$user->wishlists()->detach($product_id);
					return  redirect()->back()->with('success_message','Product removed from wishlist!');

				}


			}else
			{
				return response()->json(['status'=>false]);
			}




	}


	public function storeReview(Request $request)
	{
		$request->validate([
			'rating' => 'required|numeric|min:1|max:5',
			'review' => 'nullable|string',
		],[
			'rating.required'=>'You must give atleast 1 rating!'

		]);

		$product = Product::where('slug', $request->product_slug)->firstOrFail();


		Review::updateOrCreate(
			['user_id' => auth()->id(), 'product_id' => $product->id],
			['rating' => $request->rating, 'review' => $request->review]
		);

		return back()->with('success_message', 'Your review has been submitted.');

	}

}
