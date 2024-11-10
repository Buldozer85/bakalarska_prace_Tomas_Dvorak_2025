@props([
    'date' => '',
    'from' => '',
    'to' => '',

])
<div {{ $attributes->merge(['class' => 'bg-brand-black rounded-md text-white w-full flex-1 p-12 space-y-8']) }}>
    <h2 class="font-bold text-2xl">Souhrn</h2>
    <p>Rezervace platná: ..</p>

    <p><span class="font-bold">Datum:</span></p>
    <p><span class="font-bold">Od - Do:</span></p>
    <p><span class="font-bold">Čas celkem:</span></p>

    <div class="flex flex-row gap-x-4">
        <x-web.button class="flex-1" type="danger">Zrušit!</x-web.button>
        <x-web.button class="flex-1" type="yellow" wire:click.prevent="nextStep">
                    <span class="flex flex-row gap-x-4 items-center justify-between">
                          Další krok
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                    </span>
        </x-web.button>

    </div>
</div>
