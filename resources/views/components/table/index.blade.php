@props([
    'header' => null,
    'footer' => null,
])
<div class="flex flex-col">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden border border-gray-200 shadow-sm md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    @if ($header)
                        <thead class="bg-gray-700">
                            <tr>
                                {{ $header }}
                            </tr>
                        </thead>
                    @endif
                    <tbody wire:loading.class="opacity-70"
                        class="divide-y divide-gray-200 bg-white">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
            @if ($footer)
                <div class="mt-4">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
