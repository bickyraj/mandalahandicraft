<div class="cart" x-cloak x-show="cartDrawerOpen">
    <div class="cart-overlay fixed" style="top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.6)" @click="cartDrawerOpen=false">
        <div class="cart-drawer absolute bg-white" style="top:0;right:0;width:360px;height:100%" @click.stop="">
            <div class="flex items-center p-4 border-bottom-light">
                <button class="mr-4" @click="cartDrawerOpen=false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-secondary" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
                <div class="flex-grow-1 p-2">
                    1 item in bag
                </div>
                <a href="" class="btn btn-sm btn-o-secondary">View Bag</a>
            </div>
            <div class="p-4 border-bottom-light">
                <div class="text-dark">
                    Total:
                </div>
                <div class="mb-4 font-bold text-xl text-dark">
                    $170.00
                </div>
                <div class="text-center"><a href="" class="btn btn-secondary">Proceed to Checkout</a></div>
            </div>
            @for ($i = 0; $i < 2; $i++)
                <div class="flex p-4 border-bottom-light">
                    <div class="mr-2">
                        <a href="#">
                            <img src="{{ asset('frontend/images/product1.jpg')}}" width="100" alt="">
                        </a>
                    </div>
                    <div>
                        <div class="mb-2 text-lg text-secondary">
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </div>
                        <div class="mb-4 font-bold text-dark">
                            $170.00
                        </div>
                        <div class="mb-2 flex items-center text-sm">
                            <span class="mr-2">Quantity: </span>
                            <input type="number" name="" id="" value="1" min="1" max="5" class="border-light p-2 w-20">
                        </div>
                        <div>
                            <a href="#" class="flex items-center text-sm text-light hover:text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Remove
                            </a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
