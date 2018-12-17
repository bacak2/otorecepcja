<ul class="nav nav-pills">
    @if(isset($menu))
        @foreach(getLinks() as $route => $link)

            @if($route === $menu)
                <li class="nav-item">
                    <a class="nav-link active" href="{{route($route)}}">{{ $link }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route($route)}}">{{ $link }}</a>
                </li>
            @endif

        @endforeach
    @endif
</ul>

@if(isset($submenu) && isset($activeSubmenu))
    <hr>
    <ul class="nav nav-pills">
        @foreach($submenu as $route => $link)

            @if($route === $activeSubmenu)
                <li class="nav-item">
                    <a class="nav-link active" href="{{route($menu.'.'.$route)}}">{{ $link }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route($menu.'.'.$route)}}">{{ $link }}</a>
                </li>
            @endif

        @endforeach
    </ul>
@endif