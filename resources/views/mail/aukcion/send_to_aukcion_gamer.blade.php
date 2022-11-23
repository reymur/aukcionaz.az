@component('mail::message')

{{--@component('mail::button', ['url' => ''])--}}
{{--    Button Text--}}
{{--@endcomponent--}}
    <div class="">
        {{ $user->name }}
    </div>
    <br/>
    <div class="">
        <h4 class="">Siz Mercedes s-class 220w </h4> Aukciona qoşuldunuz.
        <br>
        Aukcion saat 16:00 - da başlayacaq.
    </div>

@endcomponent
