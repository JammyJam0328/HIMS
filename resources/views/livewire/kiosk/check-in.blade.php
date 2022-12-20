<div x-data="{ step: $wire.entangle('step') }">
    <div x-show="step==1"
        id="selectType">
        @include('v1.kiosk.partials.select-type')
    </div>
    <div x-cloak
        x-show="step==2"
        id="selectRoom">
        @include('v1.kiosk.partials.select-room')
    </div>
    <div x-cloak
        x-show="step==3"
        id="selectRoom">
        @include('v1.kiosk.partials.select-rate')
    </div>
    <div x-cloak
        x-show="step==4"
        id="selectRoom">
        @include('v1.kiosk.partials.fillup-information')
    </div>
    <div x-cloak
        x-show="step==5"
        id="selectRoom">
        @include('v1.kiosk.partials.show-generated-qrcode')
    </div>
</div>
