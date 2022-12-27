<div class="grid p-20">
  {{-- <div class="grid gap-4">
        <h1 class="text-3xl uppercase text-green-400 underline">
            CHECK IN
        </h1>
        <h1 class="text-5xl font-bold uppercase text-white underline">
            GENERATED QR CODE
        </h1>
    </div> --}}
  <div>
    <h1 class="font-bold text-green-400">CHECK-IN</h1>
    <h1 class="text-5xl uppercase font-extrabold text-gray-50">GENERATED QR CODE</h1>
  </div>
  <div class="mt-20 flex w-full justify-center gap-4">
    <div class="pt-20 px-20 pb-10 bg-gray-50 rounded-xl">
      <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $generatedQrCode }}"
        alt="QRCODE :{{ $generatedQrCode }}">
      <div class="mt-6 text-center">
        <span class="text-gray-700 font-bold text-xl">
          {{ $generatedQrCode }}
        </span>
      </div>
    </div>
  </div>

  <div class="mt-5 flex justify-center">
    <div>
      <x-button.primary href="{{ route('kiosk.index') }}" class="mt-3">
        <span class="text-xl"> {{ __('Done') }}</span>
      </x-button.primary>
    </div>
  </div>
</div>
