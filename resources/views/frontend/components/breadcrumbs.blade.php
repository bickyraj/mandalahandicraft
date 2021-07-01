@props(['links'])

<ol class="flex">
    @foreach ($links as $link)
    <li class="mr-4 text-white">
        @if (!$loop->last) 
            <a href="{{ $link['route'] }}" class="mr-4 font-bold ">
                {{ $link['name'] }}
            </a>
            / 
        @else
            <span>
                {{ $link['name'] }}
            </span>
        @endif
    </li>
    @endforeach
</ol>