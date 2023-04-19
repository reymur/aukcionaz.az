@extends('layouts.app')

@section('content')
    <div class="container-xl container-lg p-0">
        <div class="">
{{--            <div class="container-lg">--}}
{{--                <div class="row chat-row">--}}
{{--                    <div class="chat-content">--}}
{{--                        <ul class="chat-ul">--}}
{{--                            <li class="chat-li" id="chatMessage">Chat message</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

{{--                    <div class="chat-section">--}}
{{--                        <div class="chat-box">--}}
{{--                            <div class="chat-input bg-white" id="chatInput" contenteditable=""></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @if( $auksiyon_gamers && $product && $auksiyon )

{{--            :started_auksiyon="{{ $started_auksiyon }}"--}}

            <real-time-auksiyon
                :user="{{ $user }}"
                :auksiyon_gamers="{{ $auksiyon_gamers }}"
                :product="{{ $product }}"
                :auksiyon="{{ $auksiyon }}"
            ></real-time-auksiyon>
        @endif
    </div>
@endsection
