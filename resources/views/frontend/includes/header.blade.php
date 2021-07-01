<header>
    {{-- Top --}}
    <div class="container py-2">
        <div class="topbar flex justify-between text-light text-sm">
            <ul class="flex">
                <li class="mr-4"><a href="#">Customer care</a></li>
                <li class="mr-4"><a href="#">Track my order</a></li>
            </ul>
            <ul class="flex">
                <li class="mr-4"><a href="#">Log in</a></li>
                <li><a href="#">Sign up</a></li>
            </ul>
        </div>
    </div>{{-- Top --}}

    {{-- Header --}}
    <div class="container py-4">
        <div class="flex flex-wrap justify-between items-center">
            <x-logo class="mb-2"/>
            <div class="search">
                <form action="">
                    <div class="header-search flex">
                        <select name="" id="" class="none lg:block px-8 py-4 border-light">
                            <option selected disabled>Categories</option>
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
            <div class="cart">
                <button class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-secondary" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg>
                    <div class="flex justify-center items-center w-4 h-4 bg-secondary font-bold text-xs text-primary rounded-md">88</div>
                </button>
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
                <li>
                    <a href="">Thangka</a>
                    <ul>
                        <li><a href="">Lorem, ipsum dolor.</a></li>
                        <li><a href="">Saepe, facere excepturi?</a></li>
                        <li><a href="">Eveniet, saepe expedita.</a></li>
                        <li><a href="">Quisquam, eum iusto!</a></li>
                    </ul>
                </li>
                <li><a href="">Singing Bowl</a></li>
                <li><a href="">Mudra</a></li>
            </ul>
        </nav>
    </div>
</div>
{{-- Navbar --}}

@push('scripts')
    <script>
        window.addEventListener('load', () => {
            $('#main-nav').smartmenus()
        })
    </script>
@endpush