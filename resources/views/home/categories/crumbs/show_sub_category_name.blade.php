

@if ( isset($category->SubCategories) && $category->SubCategories->count() > 0 )
    @foreach ( $category->SubCategories as $item )
        <li class="d-flex show__sub_category_li">
            <a href="" class="d-block text-black text-nowrap p-3 show__sub_category_a">
                <div class="col text-center lh-1">{{ $item->name }}</div>
            </a>
        </li>
    @endforeach
@endif
