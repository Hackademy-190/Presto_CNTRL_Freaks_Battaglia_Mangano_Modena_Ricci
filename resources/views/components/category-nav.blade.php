<div class="nav-category mt-5">
    <div class="container-category">
        @foreach ($categories as $category)
            <div class="btn-category"><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></div>
        @endforeach
        <svg class="outline" overflow="visible" width="400" height="60" viewBox="0 0 400 60"
            xmlns="http://www.w3.org/2000/svg">
            <rect class="rect" pathLength="100" x="0" y="0" width="400" height="60"
                fill="transparent" stroke-width="5"></rect>
        </svg>
    </div>
</div>