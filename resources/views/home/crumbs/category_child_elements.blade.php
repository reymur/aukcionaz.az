

@if ( isset($image) )
    <li class="category__child_image_li-styles">
        <div class="category__child_image-div-styles">  
            <img src="{{ asset('images/category/'. $image->name) }}" alt="" class="category__child_image-styles"/>
        </div>

        <p class="text-center lh-1">Kataloq</p>
    </li>
@endif
