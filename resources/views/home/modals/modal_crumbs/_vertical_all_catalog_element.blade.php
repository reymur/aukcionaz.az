

@isset($category)
    <div class="">
        <div class="col">
            <!-- Modal button -->
            <a href="{{ $category->name }}" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#verticalOffcanvasRightElement-{{$category->id}}" data-bs-whatever="@mdo">
                <div class="col d-flex py-2 ps-3">
                    <div class="col-2 col-sm-1 col-lg-1 col-xl-1 col-xxl-1 vertical__all_catalog_img_div">
                        <img src="{{ asset('/images/category/'.($category->image ?? 'img')) }}" class="card-img-top d-flex m-auto vertical__all_catalog_img" alt="...">
                    </div>

                    <li class="col-9 col-sm-11 col-md-11 col-lg-11 col-xl-11 col-xxl-11 list-group-item d-flex vertical__all_catalog_li">
                        <h5 class="col-11 ps-1 vertical__all_catalog_title">{{ $category->name ?? '' }}</h5>
                        <div class="col-1 m-auto">1412</div>
                    </li>
                </div>
            </a>
        </div>

        <!-- Modal -->
        <div class="modal fade modal-right all__catalog_z_index" id="verticalOffcanvasRightElement-{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen-xxl-down">
                    <div class="modal-content">
                        <div class="col-12 modal-header border-0">
                            <div class="col-5 m-0" id="verticalOffcanvasRightElementClose" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </div>

                            <h1 class="col-7 modal-title fs-5 ms-3 fw-bolder all__category_image_li" id="exampleModalLabel">Elektronika</h1>
                        </div>

                        <div class="py-1 bg-light"></div>

                        <div class="modal-body pt-0">
                            <div class="">
                                <ul class="list-group">
                                    @foreach ( $category->subCategories as $sub_category)
                                        <vertical-all-catalog-element
                                            :category="{{ $category }}"
                                            :sub_category="{{ $sub_category }}"
                                        ></vertical-all-catalog-element>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
    </div>
@endisset



