<header>
    {{-- Top --}}
    <div class="container py-2">
        <div class="topbar flex justify-between text-light text-sm">
            <ul class="flex">
                <li class="mr-4"><a href="#">Customer care</a></li>
                <li class="mr-4"><a href="#">Track my order</a></li>
            </ul>
            <ul class="flex">
                <li class="mr-4"><a href="{{ route('login') }}">Log in</a></li>
                <li><a href="{{route('register')}}">Register</a></li>
            </ul>
        </div>
    </div>{{-- Top --}}

    {{-- Header --}}
    <div class="container py-4">
        <div class="flex flex-wrap justify-between items-center">
            <a href="/">
                @include('frontend.components.logo')
            </a>
            <div class="search">
                <form action="">
                    <div class="header-search flex">
                        <select name="" id="" class="none lg:block px-8 py-4 border-light">
                            <option selected disabled>Categories</option>
                            @forelse ($all_categories as $categ)
                                <option value="{{ $categ->slug }}">{{ $categ->name }}</option>
                            @empty

                            @endforelse
                        </select>
                        <input type="text" class="p-4 border-light" placeholder="What are you looking for?">
                        <button type="submit" class="px-8 py-4 border-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex">
                <div class="cart">
                    <button class="flex items-start py-2" @click="cartDrawerOpen=true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-secondary" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                        <div class="flex justify-center items-center w-4 h-4 bg-secondary font-bold text-xs text-primary rounded-md">{{ $cartItems->count() }}</div>
                    </button>
                </div>
                <div class="user ml-4 relative" x-data="{userDropdownOpen:false}">
                    <button class="flex items-center py-2" @click="userDropdownOpen=!userDropdownOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-secondary" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                    <div x-cloak x-show="userDropdownOpen" @click.away="userDropdownOpen=false" class="user-menu absolute w-30 bg-white text-sm shadow-md " style="top:100%; right:-1rem;">
                        <ul>
                            <li><a href="" class="block px-4 py-2 border-bottom-light">My Orders</a></li>
                            <li><a href="#" class="block px-4 py-2 border-bottom-light">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- Header --}}
</header>

{{-- Navbar --}}
<div class="header bg-primary" x-data="{mobileNavOpen: false}">
    <div class="container relative">
        <button class="flex lg:none p-4 text-white uppercase" id="nav-toggle" @click="mobileNavOpen=!mobileNavOpen">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="no-click mr-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
            Categories
        </button>
        <nav id="nav" :class="{ 'show': mobileNavOpen }" @click.away="mobileNavOpen=false">
            <ul id="main-nav" class="sm sm-simple">
                @if($allMenu->count())
                    @foreach($allMenu as $key => $menu)
                        <li>
                            <a href="/">{{ $menu }}</a>
                            <?php $subCategory = getSubCategory($key); ?>
                            @if(isset($subCategory) && $subCategory->count())
                                @foreach($subCategory as $key=>$category)
                                <ul class="">
                                    <li><a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                                        @if(isset($category->sub_categories) && ($category->sub_categories->count()))
                                            <ul class="">
                                                @foreach($category->sub_categories as $key=>$sub)
                                                    <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>
                                                        @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                            <ul class="">

                                                                @foreach($sub->sub_categories as $key=>$sub)
                                                                    <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>
                                                                        @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                                            <ul class="">

                                                                                @foreach($sub->sub_categories as $key=>$sub)
                                                                                    <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>

                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>

                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>

                                        @endif
                                    </li>
                                </ul>
                                @endforeach
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
    </div>
</div>
{{-- Navbar --}}

@push('scripts')
    <script>
        window.addEventListener('load', () => {
            $('#main-nav').smartmenus({
                subMenusSubOffsetY: -1
            })
        })
    </script>
@endpush
