@extends('layouts/app')

@section('title', 'Our Team')

@section('content')
    {{-- Hero > Breadcrumbs--}}
    <x-hero text='Our Team' :breadcrumb-links="[
            ['name' => 'Home', 'route' => route('home')],
            ['name' => 'Our Team', 'route' => route('team')],
        ]" />
    {{-- Hero > Breadcrumbs--}}

    <section>  
        <div class="container pt-10 pb-30">
            {{-- Featured Image --}}
            {{-- <img src="{{ asset('images/about-home.jpg') }}" alt="" class="mb-20 block" style="width: 100%; object-fit: cover; max-height: 36rem;"> --}}
            
            <div class="grid lg:grid-cols-3 gap-20">

                <div class="lg:col-span-2">
                    {{-- Content --}}
                    <main>
                        @php
                            $members = [
                                [
                                    'name' => 'John Doe',
                                    'designation' => 'Campus Chief',
                                    'image' => 'images/dean.jpg'
                                ],[
                                    'name' => 'Jane Doe',
                                    'designation' => 'Assistant Campus Chief',
                                    'image' => 'images/dean.jpg'
                                ]
                            ];
                        @endphp
                        <div class="grid lg:grid-cols-2 gap-6">
                            @foreach ($members as $member)
                                <div class="bg-white">
                                    <div class="image" style="padding-top: 80%;background:center / cover url({{ asset($member['image']) }})">
                                    </div>
                                    <div class="p-6 text-center border-bottom-light">
                                        <h2 class="mb-2 font-bold text-xl text-primary">{{ $member['name'] }}</h2>
                                        <div class="mb-4 font-bold text-dark">{{ $member['designation'] }}</div>
                                        <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima cum harum nulla exercitationem natus aliquid eaque nihil rerum quaerat velit explicabo, reprehenderit dolor, at excepturi, ad officiis error a totam?</p>
                                    </div>
                                    <div class="flex justify-center items-center p-6">
                                            <a href="#" class="block bg-light mr-1 p-4 text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                                                    <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
                                                </svg>
                                            </a>
                                            <a href="#" class="block bg-light mr-1 p-4 text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                                </svg>
                                            </a>
                                            <a href="#" class="block bg-light mr-1 p-4 text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                                </svg>
                                            </a>
                                            <a href="#" class="block bg-light mr-1 p-4 text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                                </svg>
                                            </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </main>

                </div>

                <aside>
                    <div class="mb-20 shadow-md">
                        <div class="flex items-center bg-primary text-white">
                            <div class="flex justify-center items-center w-20 h-20 bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-megaphone-fill w-6 h-6 text-primary" viewBox="0 0 16 16">
                                    <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-11zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25.222 25.222 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56V3.224zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009a68.14 68.14 0 0 1 .496.008 64 64 0 0 1 1.51.048zm1.39 1.081c.285.021.569.047.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a65.81 65.81 0 0 1 1.692.064c.327.017.65.037.966.06z"/>
                                </svg>
                            </div>
                            <h2 class="px-6 uppercase tracking-wider">Notice Board</h2>
                        </div>
                        <div class="bg-white">
                            @for ($i = 0; $i < 5; $i++)
                                <a href="#" class="block p-6 hover:bg-lprimary border-bottom-light">
                                    <div class="mb-2 text-primary">May 6, 2022</div>
                                    <div class="text-dark"><h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, iure?</h3></div>
                                </a>
                            @endfor
                            <div class="p-6"><a href="#" class="btn btn-o-primary">All Notices</a></div>
                        </div>
                    </div>

                    <div class="mb-20 shadow-md">
                        <div class="flex items-center bg-primary text-white">
                            <div class="flex justify-center items-center w-20 h-20 bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-event-fill w-6 h-6 text-primary" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </div>
                            <h2 class="px-6 uppercase tracking-wider">Upcoming Events</h2>
                        </div>
                        <div class="bg-white">
                            @for ($i = 0; $i < 5; $i++)
                                <a href="#" class="block p-6 hover:bg-lprimary border-bottom-light">
                                    <div class="mb-4 font-bold text-lg text-dark">Lorem ipsum dolor sit amet consectetur.</div>
                                    <div class="flex mb-2 text-sm text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock flex-shrink-0 mr-4 text-primary" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                        </svg>
                                        <time datetime="2022-05-06 08:30">
                                            May 6, 2022 8:30am
                                        </time>
                                    </div>
                                    <div class="flex text-sm text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo flex-shrink-0 mr-4 text-primary" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                                        </svg>
                                        Lamjung Campus Auditorium
                                    </div>
                                </a>
                            @endfor
                            <div class="p-6"><a href="#" class="btn btn-o-primary">All Events</a></div>
                        </div>
                    </div>

                    {{-- <div class="mb-20 shadow-md">
                        <div class="flex items-center bg-primary text-white">
                            <div class="flex justify-center items-center w-20 h-20 bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-event-fill w-6 h-6 text-primary" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </div>
                            <h2 class="px-6 uppercase tracking-wider">Latest News</h2>
                        </div>
                        <div class="bg-white">
                            @for ($i = 0; $i < 5; $i++)
                                <a href="#" class="block p-6 hover:bg-lprimary border-bottom-light">
                                    <div class="mb-4 font-bold text-lg text-dark">Lorem ipsum dolor sit amet consectetur.</div>
                                    <div class="flex mb-2 text-sm text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock flex-shrink-0 mr-4 text-primary" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                        </svg>
                                        <time datetime="2022-05-06 08:30">
                                            May 6, 2022 8:30am
                                        </time>
                                    </div>
                                    <div class="flex text-sm text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo flex-shrink-0 mr-4 text-primary" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                                        </svg>
                                        Lamjung Campus Auditorium
                                    </div>
                                </a>
                            @endfor
                            <div class="p-6"><a href="#" class="btn btn-o-primary">All Events</a></div>
                        </div>
                    </div> --}}
                </aside>
            </div>
        </div>
    </section>
@endsection
