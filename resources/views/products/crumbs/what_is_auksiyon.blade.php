
<!-- Button trigger modal -->
<div class="text-center text-decoration-underline fs-5" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
    Auksiyon nədir <span class="ms-1">?</span>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col modal-title d-flex">
                    <div class="col-11 fs-4 fw-bold d-flex justify-content-center" id="staticBackdropLabel"> Aukcion nədir? </div>
                    <div class="col-1">
                        <button type="button" class="btn-close m-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="fs-5 px-3" style="text-align: justify;">
                    Siz <span class="fs-4 ms-1 me-1 fw-bold">Auksiyon</span>
                    əlavə etməklə, sizin elanı
                    <span class="bg-danger bg-opacity-10 me-1">
                        <span class="fs-4 ms-1 me-1 fw-bold">auksiyona</span>
                        çıxatmış olursunuz
                    </span>
                    və bu zaman müştərilər elanın üzərindəki

                    <span class="">
                            (<span class="fs-4 ms-2 me-2 fw-bold">auksiyon</span>
                        <span class="me-2 what_is_auksiyon_icon">
                            @include('products.crumbs.on_aukcion_icon')
                        </span>)
                        işarəsindən
                    </span>

                    sizin elanın
                    <span class="fs-4 ms-1 me-1 fw-bold">auksiyonda</span>
                    olduğunu görurlər. Bu o deməkdir ki, sizin elan
                    <span class="bg-danger bg-opacity-10">real vaxtda</span>
                    daha çox <span class="bg-danger bg-opacity-10">müştəri cəlb edir</span> və siz
                    <span class="bg-danger bg-opacity-10">real zamanda bir neçə müstəri</span>
                    ilə <span class="bg-danger bg-opacity-10">canlı olaraq alqı-satqı edirsiniz.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
            </div>
        </div>
    </div>
</div>

