@php
    $path = Request::getPathInfo();
    $parts = explode('/', $path);
    $currentPath = '';
@endphp

<nav class="breadcrumbs-nav">
    <div class="nav-wrapper">
        <div class="col s12">
            @foreach ($parts as $part)
                @php
                   $currentPath .= $part.'/'; 
                @endphp

                @if (empty($part) || $part === 'admin' || is_numeric($part))
                    @continue
                @endif

                <a href="{{ $currentPath }}" class="breadcrumb">{{ ucfirst($part) }}</a>
            @endforeach
        </div>
    </div>
</nav>
