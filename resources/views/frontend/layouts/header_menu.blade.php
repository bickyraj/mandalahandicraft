<li class="mmenu-item--mega category-link"><a class="category-anchor" href="">Categories</a>
    <div class="mmenu-submenu mmenu-submenu-with-sublevel">
        <div class="mmenu-submenu-inside">
            <div class="container">
                <div class="mmenu-cols column-5">
                    @if($allMenu->count())
                        @foreach($allMenu as $key=>$menu)
                            <div class="mmenu-col">

                                <h3 class="submenu-title"><a href="">{{ $menu }}</a></h3>
                                <?php $subCategory = getSubCategory($key); ?>

                                @if(isset($subCategory) && $subCategory->count())
                                    @foreach($subCategory as $key=>$category)
                                    <ul class="submenu-list">
                                        <li><a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                                            @if(isset($category->sub_categories) && ($category->sub_categories->count()))
                                                <ul class="sub-level">

                                                    @foreach($category->sub_categories as $key=>$sub)
                                                        <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>

                                                            @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                                <ul class="sub-level">

                                                                    @foreach($sub->sub_categories as $key=>$sub)
                                                                        <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>
                                                                            @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                                                <ul class="sub-level">

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

                            </div>

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>

@if($headerMenu->count())
    @foreach($headerMenu as $key=>$menu)
        <li class="mmenu-item--simple">
            <a href="" title="">{{ $menu }}</a>
            <?php $subCategory = getSubCategory($key); ?>

            @if(isset($subCategory) && $subCategory->count())
                <div class="mmenu-submenu">
                    <ul class="submenu-list">
                @foreach($subCategory as $key=>$category)

                            <li><a href="{{ url('category') }}/{{ $category->slug }}" title="">{{ $category->name }}</a>
                                @if(isset($category->sub_categories) && ($category->sub_categories->count()))
                                    <ul>
                                        @foreach($category->sub_categories as $key=>$sub)
                                            <li>
                                                <a href="{{ url('category') }}/{{ $sub->slug }}" title="">{{ $sub->name }}</a>
                                                @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                    <ul class="sub-level">

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
                </div>
            @endif
        </li>
    @endforeach
@endif
