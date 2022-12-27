

@if ( isset($category) && isset($id))
    <li class="category__child_image_li-styles" id="{{ $id }}">
        <a href="" class="category__child_image_a" onMouseEnter={addBorderOnCategoryImageA(event)} onMouseLeave={rmBorderOnCategoryImageA(event)}>
            <div class="category__child_image-div-styles">  
                <img src="{{ asset('images/category/'. $category->image) }}" alt="" class="category__child_image-styles"/>
            </div>
    
            <div class="text-center lh-1">{{ $category->name }}</div>
        </a>
    </li>
@endif
