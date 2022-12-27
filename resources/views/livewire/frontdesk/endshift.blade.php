<div>
    <x-button.danger x-on:click="$dispatch('confirm-end-shift')">End Shift</x-button.danger>
    <x-confirm name="end-shift"
        title="End Shift"
        message="Are you sure you want to end your shift?"
        onConfirm="endShift()" />
</div>
