<div>
    @if(!session()->has('sent'))
    <form class="space-y-4" method="POST" wire:submit="send">
        @csrf
        <x-web.form.input wire:model="name" label="Jméno" name="name" id="name" white-text required />
        <x-web.form.input wire:model="email" label="E-mail" name="email" id="email" white-text required />
        <x-web.textarea wire:model="message" name="message" label="Váš dotaz" id="message" white-text/>
        <x-web.button submit class="w-full" type="white">Odeslat</x-web.button>
    </form>
    @else
        <div class="flex justify-center flex-col items-center text-center gap-y-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <h2 class="text-2xl text-white">Váš dotaz byl odeslán. Kopii naleznete ve své e-mailové schránce</h2>

            <x-web.button wire:click="resetSession" type="yellow">Odeslat novou zprávu</x-web.button>
        </div>
    @endif
</div>
