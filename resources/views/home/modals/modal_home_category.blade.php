  
  
  <!-- Button trigger modal -->
  <li class="all__category_image_li-styles" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
    <div class="all__category_image-div-styles aukcionaz__main-color">
      <img src="{{ asset('images/category/all__category_img.png') }}" alt="" class="all__category_image-styles bg-s">
    </div>

    <p class="text-center lh-1 all__category_image_li-text">Kataloq</p>
  </li>

  <!-- offcanvas -->
  <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="col offcanvas-header">
          <h5 class="col-5 offcanvas-title" id="offcanvasRightLabel">
              <svg xmlns="http://www.w3.org/2000/svg" type="button" data-bs-dismiss="offcanvas" aria-label="Close" width="18" height="18" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
              </svg>
          </h5>

          <h5 class="col-7 offcanvas-title fw-bolder ms-3" id="offcanvasRightLabel">
              Kataloq
          </h5>
      </div>
      
      <div class="py-1 bg-light"></div>

      <div class="offcanvas-body p-0">
          <div class="">
              <ul class="list-group">
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
                  @include('home.modals.modal_crumbs._vertical_all_catalog_element')
              </ul>
          </div>
      </div>
  </div>


