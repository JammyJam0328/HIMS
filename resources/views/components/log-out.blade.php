<div>
    <form method="POST"
        action="{{ route('logout') }}">
        @csrf
        <x-button.dark href="{{ route('logout') }}"
            onclick="event.preventDefault();
                    this.closest('form').submit();">Log Out</x-button.dark>
    </form>
</div>
