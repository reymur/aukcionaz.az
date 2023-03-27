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
        <real-time-auksiyon
            :users="{{ $users }}"
            :product="{{ $product }}"
        ></real-time-auksiyon>
    </div>
@endsection
