<div class="grid p-20">
    <div class="grid gap-4">
        <h1 class="text-3xl uppercase text-green-400 underline">
            CHECK IN
        </h1>
        <h1 class="text-5xl font-bold uppercase text-white underline">
            GENERATED QR CODE
        </h1>
    </div>
    <div class="mt-20 flex w-full justify-center gap-4">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $generatedQrCode }}"
            alt="QRCODE :{{ $generatedQrCode }}">
        <div class="mt-2">
            <span class="text-white">
                {{ $generatedQrCode }}
            </span>
        </div>
    </div>
</div>
