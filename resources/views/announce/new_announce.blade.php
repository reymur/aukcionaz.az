@extends('layouts.app')

@section('content')
   <div class="">

        <div class="col-12">
            <div class="bg-white w-100 mt-1 mb-3 p-0">
                @include('announce.modals.modal_category')
            </div>

            <div class="cbg-white w-100 mt-1 mb-2 p-0">
                <div class="border-0 ">
                    @include('announce.modals.modal_price')
                </div>

                <div class="ms-3 border-bottom border-secondary border-opacity-10"></div>

                <div class="">
                    @include('announce.modals.modal_city')
                </div>

                <div class="mt-3">
                    @include('announce.modals.modal_about')
                </div>
                
                <div class="mt-3">
                    <input-phone-number></input-phone-number>
                </div>

                <div class="p-3 mb-4 border-bottom-danger">
                    <button type="button" class="btn announce__btn-color w-100">
                        <p class="fs-5 p-2 m-auto text-white">Davam et</p>
                    </button>

                    <div class="p-3 text-secondary text-opacity-50">
                        <p class="">Elan yrlərşdirərkən siz "Aukcionaz.az" saytının 
                            <a href="" class="text-secondary text-opacity-75">müşəri razılaşmasıyla</a>  
                            avtomatik razılaşırsınız.</table></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

