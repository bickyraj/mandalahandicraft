@extends('layouts/app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs--}}
    <x-hero text="About Us" :image="asset('images/hero.jpg')" :breadcrumb-links="[
            ['name' => 'Home', 'route' => route('home')],
            ['name' => 'About Us', 'route' => route('about')],
        ]" />
    {{-- Hero > Breadcrumbs--}}

    <section>  
        <div class="container pt-10 pb-30">
            {{-- Featured Image --}}
            <img src="{{ asset('images/about-home.jpg') }}" alt="" class="mb-20 block" style="width: 100%; object-fit: cover; max-height: 36rem;">
            
                {{-- Content --}}
                <main>
                    <div class="mb-10 font-light text-xl text-center">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis nobis libero ut eos fugiat error porro hic ipsam necessitatibus voluptatem possimus praesentium voluptate saepe officia, cum doloribus officiis quae illo atque quos autem consectetur! Distinctio vero beatae quam aliquam eum eaque, est earum deleniti libero expedita sequi quia, quis quos molestiae neque in ullam sunt sint. Ut totam deserunt consequuntur voluptatum cumque officiis ipsa rerum quidem similique.</p>
                    </div>
                    <div class="bg-secondary p-10">
                        <div class="grid lg:grid-cols-3 gap-6">
                            <div class="bg-white rounded-md p-6">
                                <div class="flex justify-center mb-6">
                                    <img src="{{ asset('images/iconartist.png')}} " alt="" class="w-20">
                                </div>
                                <h2 class="mb-4 font-bold text-2xl text-dark text-center">Excellent craftmanship</h2>
                                <div class="text-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem itaque necessitatibus ab. Facere officia repudiandae, ducimus ex voluptatem culpa ut.</div>
                            </div>
                            <div class="bg-white rounded-md p-6">
                                <div class="flex justify-center mb-6">
                                    <img src="{{ asset('images/iconbrush.png')}} " alt="" class="w-20">
                                </div>
                                <h2 class="mb-4 font-bold text-2xl text-dark text-center">Ethnic Art</h2>
                                <div class="text-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem itaque necessitatibus ab. Facere officia repudiandae, ducimus ex voluptatem culpa ut.</div>
                            </div>
                            <div class="bg-white rounded-md p-6">
                                <div class="flex justify-center mb-6">
                                    <img src="{{ asset('images/icondelivery.png')}} " alt="" class="w-20">
                                </div>
                                <h2 class="mb-4 font-bold text-2xl text-dark text-center">Secured Delivery</h2>
                                <div class="text-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem itaque necessitatibus ab. Facere officia repudiandae, ducimus ex voluptatem culpa ut.</div>
                            </div>
                        </div>
                    </div>
                    <div class="editor text-lg">
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque culpa ipsa laboriosam, doloremque qui neque veniam corporis! Deserunt, laboriosam delectus.</li>
                            <li>Porro, nemo nesciunt? Commodi corrupti natus placeat distinctio mollitia voluptates aliquid molestiae hic ducimus repellat quo itaque, nesciunt maxime rerum.</li>
                            <li>Accusamus sapiente consectetur asperiores atque aspernatur totam nisi, quasi dolorum possimus neque sed odio perferendis vel eum cupiditate aliquid ea?</li>
                            <li>Minus earum magnam quasi consequatur harum rerum error sequi libero aperiam odit, mollitia, voluptates aut sapiente voluptatum incidunt quae sed.</li>
                            <li>Ipsa blanditiis laboriosam autem illum minima aliquam quo obcaecati. Molestiae excepturi saepe, deleniti adipisci sapiente quo molestias quibusdam dignissimos ipsa!</li>
                        </ul>
                        <p>Labore quis, illum culpa ullam quasi quidem earum voluptas velit reiciendis laudantium tempore impedit similique non voluptatem minima sapiente ratione delectus corrupti. Dolore, doloribus veniam soluta accusantium molestias excepturi voluptatem blanditiis et consectetur nisi magni saepe officia exercitationem iusto architecto quasi perspiciatis commodi voluptas ut non voluptatum facere. Nihil rem sit dolorem recusandae inventore vero accusantium similique, itaque, sapiente harum hic voluptatem? Quaerat, veniam nisi voluptates obcaecati animi corporis repellat, assumenda deserunt sint id maiores!</p>
                        <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta, ducimus!</h2>
                        <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta, ducimus!</h3>
                        <h4>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta, ducimus!</h4>
                        <p>Incidunt dolore et asperiores eveniet ratione provident iusto ducimus nostrum ipsum sapiente, porro soluta cumque illo quas possimus. Voluptatum pariatur accusamus, dolore sed vero incidunt, modi saepe nam illo sint placeat maiores! Quam doloribus recusandae nam qui? Accusamus aliquid atque quidem sit dolor exercitationem, quibusdam, hic alias repellat quae eum accusantium molestiae ad totam recusandae numquam! Facere odio vel quis. Expedita soluta mollitia laborum cumque at quae laudantium eligendi voluptates! Architecto, iste. Cupiditate, perspiciatis atque.</p>
                        <p>Repudiandae rerum adipisci libero ad doloremque quod quae ratione et tempore maiores corporis molestiae iusto, recusandae dolor cum eos. Facilis ab rerum consequuntur odio eveniet fuga fugit id assumenda, sit voluptate nobis, similique, obcaecati perspiciatis. Debitis recusandae aut dicta aliquam suscipit possimus architecto odio dolorum provident asperiores pariatur sed illo ab, dolores non ea placeat illum, animi quas ullam repellat laboriosam. Accusantium sit necessitatibus ab totam perspiciatis, debitis porro consectetur consequuntur, corrupti, adipisci cumque molestiae.</p>
                        <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta, ducimus!</h3>
                        <h4>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta, ducimus!</h4>
                        <p>Dolores quasi possimus at et fugit dignissimos in iste dolore est sequi vel distinctio deleniti, mollitia cumque itaque harum repellendus tenetur beatae placeat aut error. Architecto placeat omnis quisquam officia beatae doloribus dolor hic aperiam eaque laborum tempore, sequi, iste quos dolorem, laboriosam sint voluptatem ducimus? Optio unde eveniet tenetur cumque natus consequuntur illum soluta alias totam accusantium dolore eaque nobis autem hic ab, inventore fugiat in quasi? Suscipit eveniet, ipsam debitis qui nemo facilis?</p>
                        <p>Distinctio vel ipsam quo ea nemo quisquam et sapiente amet tenetur cum, doloremque optio voluptatum tempore modi aut iusto eaque ratione at maxime. Architecto delectus esse magnam eius quod modi aspernatur, ipsam blanditiis vitae quas aut obcaecati debitis voluptatum aliquid accusantium. Ab beatae numquam blanditiis impedit dolore minus corporis. Deserunt consequuntur harum accusantium, itaque tempora dignissimos nobis perspiciatis quas provident vero, minus assumenda fugiat quidem. Enim explicabo maxime hic asperiores delectus est doloremque, iure consectetur.</p>
                    </div>
                </main>

            </div>
        </div>
    </section>


@endsection
