

<div class="waiting__small_image_parent" role="button" data-bs-toggle="modal" data-bs-target="#waitingSmallModal">
    <img src="{{ asset('/images/icons/waiting.png') }}" alt="" class="waiting__small_image">
</div>

<div class="modal fade" id="waitingSmallModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-11 waiting__modal_small_image_parent">
                    <img src="{{ asset('/images/icons/waiting.png') }}" alt="" class="waiting__modal_small_image">
                </div>
                <div class="col-1 mt-1 ms-n2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body waiting__modal_small_text">
                Sizin elanınız yoxlama mərhələsindədir. Elanınız təstiqləndikdən sonra elanlar bölməsində yerləşdiriləcək.
            </div>
        </div>
    </div>
</div>

