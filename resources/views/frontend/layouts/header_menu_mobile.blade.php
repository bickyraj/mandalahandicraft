<li><a class="category-anchor" href="#">Categories</a><span class="arrow"></span>
    @if($allMenu->count())
        <ul class="nav-level-2">
            @foreach($allMenu as $key=>$menu)
                <li><a href="">{{ $menu }}</a>
                    <?php $subCategory = getSubCategory($key); ?>
                    @if(isset($subCategory) && $subCategory->count())
                        <span class="arrow"></span>
                        <ul class="nav-level-3">
                            @foreach($subCategory as $key=>$category)
                                <li><a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                                    @if(isset($category->sub_categories) && ($category->sub_categories->count()))
                                        <span class="arrow"></span>
                                        <ul class="nav nav-level-4">
                                            @foreach($category->sub_categories as $sub)
                                                <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>
                                                    @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                        <span class="arrow"></span>
                                                        <ul class="nav nav-level-5">
                                                            @foreach($sub->sub_categories as $key=>$sub)
                                                                <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a></li>
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
            @endforeach
        </ul>
    @endif
</li>

@if($headerMenu->count())
    @foreach($headerMenu as $key=>$menu)
        <li><a href="">{{ $menu }}</a>
            <?php $subCategory = getSubCategory($key); ?>
            @if(isset($subCategory) && $subCategory->count())
                <span class="arrow"></span>
                <ul class="nav-level-2">
                    @foreach($subCategory as $key=>$category)
                        <li><a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                            @if(isset($category->sub_categories) && ($category->sub_categories->count()))
                                <span class="arrow"></span>
                                <ul class="nav nav-level-3">
                                    @foreach($category->sub_categories as $sub)
                                        <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a>
                                            @if(isset($sub->sub_categories) && ($sub->sub_categories->count()))
                                                <span class="arrow"></span>
                                                <ul class="nav nav-level-4">
                                                    @foreach($sub->sub_categories as $key=>$sub)
                                                        <li><a href="{{ url('category') }}/{{ $sub->slug }}">{{ $sub->name }}</a></li>
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
    @endforeach
@endif