@php
$path = explode('/', request()->path());
@endphp
<ol class="breadcrumb p-0 m-0">
    @foreach ($path as $key => $item)
        @if (count($path) == $key + 1)
            <li class="active">
                {{ ucfirst(str_replace('-', ' ', $item)) }}
            </li>
        @else
            <li>
                <a href="#"> {{ ucfirst(str_replace('-', ' ', $item)) }}</a>
            </li>
        @endif
    @endforeach
</ol>
