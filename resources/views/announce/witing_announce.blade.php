@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- NEW ANNOUNCE INFO -->
        @isset($waiting_product)
            @if( $waiting_product->id )
                <div class="mt-4">
                    <a href="/" class="fs-3 fw-bold d-flex justify-content-center text-decoration-none text-black">Aukcionaz.az</a>
                </div>

                <div class="col mt-3 mb-3">
                    <div class="fs-4 mb-3 text-center">
                        Elanınız yoxlama mərhələsindədir. <br> Elanınız təstiqləndikdən sonra elanlar bölməsində yerləşdiriləcək.
                    </div>

                    <div class="col-10 col-sm-6 col-md-5 col-lg-4 col-xl-4 col-xxl-4 m-auto py-1 bg-success bg-opacity-10">
                        <div class="d-flex justify-content-center">
                            <div class="fs-4 text-uppercase me-2"> pin: </div>
                            <div class="fs-4 text-black"> {{ $waiting_product->pin }} </div>
                        </div>

                        <div class="fs-6 d-flex justify-content-center text-decoration-underline ms-3 mt-n1">
                            PIN nömrəni yadda saxlayın.
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="mt-3 d-flex fs-5 text-center">
                            <div class="me-1">
                                Elana baxış
                            </div>

                            <div class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </div>

                            <a href="{{ route('product', ['id' => $waiting_product->id]) }}" class="">
                                {{ $waiting_product->title }}
                            </a>

                            <div class="ms-3 me-3 text-black fs-5">|</div>

                            <a href="/" class="">Çıxış</a>
                        </div>
                    </div>
                </div>

                <hr class="w-75 m-auto"/>

                <!-- ADD AUKCION -->
                <div class="d-flex justify-content-center mt-4">
                    <!-- ADD ON AUKCION -->
                    <div class="">
                        <div class="d-flex justify-content-center fs-4 fw-bold mb-2">Aukcion-da daha tez sat</div>

                        <div class="d-flex py-3">
                            <div class="align-self-center me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </div>

                            <div class="">
                                <add-on-aukcion></add-on-aukcion>
                            </div>

                            <div class="align-self-center ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                </svg>
                            </div>
                        </div>


                        <!-- Button trigger modal -->
                        <div class="text-center text-decoration-underline fs-5 mt-n2" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            Aukcion nədir <span class="ms-1">?</span>
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
                                        <div class="fs-5">
                                            Siz <span class="fs-4 ms-1 me-1 fw-bold">Aukcion</span>
                                            əlavə etməklə, sizin elanı <span class="fs-4 ms-1 me-1 fw-bold">auksiyona</span> çıxatmış olursunuz və bu zaman müştərilər sizin elanın
                                            <span class="fs-4 ms-1 me-1 fw-bold">auksiyonda</span> olduğunu görurlər. Bu o deməkdir ki, sizin elan real vaxtda daha çox müştəri
                                            cəlb edir və siz real zamanda bir neçə müstəri ilə canlı olaraq alqı-satqı edirsiniz.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
    </div>
@endsection
