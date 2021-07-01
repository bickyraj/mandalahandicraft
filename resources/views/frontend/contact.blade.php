@extends('layouts/app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs--}}
    <x-hero text='Contact Us' :image="asset('images/hero.jpg')" :breadcrumb-links="[
            ['name' => 'Home', 'route' => route('home')],
            ['name' => 'Contact Us', 'route' => route('contact')],
        ]" />
    {{-- Hero > Breadcrumbs--}}

    <section>  
        <div class="bg-light">
            <div class="container py-20 grid grid-cols-3 gap-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-4 w-15 h-15 flex justify-center items-center bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill w-6 h-6 text-white" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="mb-2 text-sm text-primary uppercase">Visit Our Store</div>
                        <a href="#" class="font-bold text-lg text-dark">Thamel, Kathmandu, Nepal</a>
                        <div class="text-sm text-dark">Open 6am to 7pm</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-4 w-15 h-15 flex justify-center items-center bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-envelope-fill w-6 h-6 text-white" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="mb-2 text-sm text-primary uppercase">Send Us an Email</div>
                        <a href="tel:01-2345678" class="font-bold text-lg text-dark">info@mandalahandicraft.com</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-4 w-15 h-15 flex justify-center items-center bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-telephone-fill w-6 h-6 text-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="mb-2 text-sm text-primary uppercase">Call Us</div>
                        <a href="tel:01-2345678" class="font-bold text-lg text-dark">01-2345678</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-10 pb-20">
            
            <div class="grid lg:grid-cols-3 gap-20 pt-15">

                <div class="lg:col-span-2">
                        <main>
                            <h2 class="mb-10 font-bold text-4xl text-secondary">Send us your queries</h2>
                            <p class="mb-10 font-light text-xl">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur totam omnis ipsam atque veritatis eos vel reiciendis reprehenderit debitis.
                            </p>
                            <form action="">
                                <div class="grid grid-cols-2 gap-4 mb-4 ">
                                    <div>
                                        <label for="name" class="block mb-2 text-primary">Name</label>
                                        <input type="text" id="name" class="border-light px-6 py-4 w-full" required placeholder="Name" autocomplete="name">
                                    </div>
                                    <div>
                                        <label for="email" class="block mb-2 text-primary">Email</label>
                                        <input type="email" id="email" class="border-light px-6 py-4 w-full" required placeholder="Email" autocomplete="email">
                                    </div>
                                    <div>
                                        <label for="tel" class="block mb-2 text-primary">Phone numner</label>
                                        <input type="tel" id="tel" class="border-light px-6 py-4 w-full" required placeholder="Phone Number" autocomplete="tel">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="message" class="block mb-2 text-primary">Message/Queries</label>
                                        <textarea id="message" rows="10" class="border-light px-6 py-4 w-full" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary">Send</button>
                            </form>
                        </main>
                </div>

                <aside>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56521.40949266137!2d85.29917646858273!3d27.699123095458493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1bdb96047c71%3A0x6938ad3cb605cc07!2sMandala%20Handicraft!5e0!3m2!1sen!2snp!4v1621748210902!5m2!1sen!2snp" class="w-full" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </aside>
            </div>
        </div>
    </section>


@endsection