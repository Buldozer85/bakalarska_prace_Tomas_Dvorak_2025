<div class="bg-brand-black rounded-md text-white w-full flex-1 p-12 space-y-8 max-lg:order-first" x-data="{
            expiry: ($wire.entangle('expiry').live == null) ? '' : $wire.entangle('expiry').live,
            remaining:null,
            interval: null,

            initTimer() {
            setTimeout(() => {
               this.remaining = null;
                this.setRemaining()

                this.interval = setInterval(() => {
                    this.setRemaining();
                }, 1000);
            }, 50)
            },
            setRemaining() {
                if(!this.expiry) {
                    this.remaining = null
                    clearInterval(this.interval)
                    return
                }

             const timeExpiry = new Date(this.expiry)
             const diff = timeExpiry.getTime() - new Date().getTime();
             this.remaining =  parseInt(diff / 1000);

             if(this.remaining <= 0) {
                $wire.dispatch('timer-expired')
             }
            },
            minutes() {
    	        return {
      	            value:this.remaining / 60,
                    remaining:this.remaining % 60
                };
            },
            seconds() {
    	        return {
      	            value:this.minutes().remaining,
                };
            },
            format(value) {
                return ('0' + parseInt(value)).slice(-2)
            },
            time(){
                return {
                    minutes:this.format(this.minutes().value),
                    seconds:this.format(this.seconds().value),
                }
            },

}" x-init="$wire.on('start-timer', function() {
	initTimer()
}); expiry ? initTimer() : ''">

    <h2 class="font-bold text-2xl">Souhrn</h2>
    @if(!empty($expiry))
        <p>Rezervace platná: <span x-text="time().minutes"></span>:<span x-text="time().seconds"></span></p>
    @endif
    <p><span class="font-bold">Datum: </span> {{ $date?->format('j.n.Y') ?? 'Zatím nevybráno' }}</p>
    <p class="font-normal"><span class="font-bold">Od - Do: </span>{{ $from?->format('G:i') ?? '' }}
        - {{ $to?->format('G:i') ?? '' }}</p>
    <p><span class="font-bold">Čas celkem: {{ round($from?->diffInHours($to) ?? 0) }} h</span></p>

    <div class="flex flex-col gap-y-4 lg:flex-row gap-x-4">
        <x-web.button data-modal-target="cancelReservation"
                      data-modal-toggle="cancelReservation"
                      class="flex-1" type="danger"><span class="flex flex-row gap-x-4 items-center justify-between">Zrušit!<svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
</svg>
</span></x-web.button>

        @if($currentStep !== 3)
            <x-web.button class="flex-1" type="yellow" wire:click.prevent="$parent.nextStep">
                    <span class="flex flex-row gap-x-4 items-center justify-between">
                          Další krok
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                              d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z"
                              clip-rule="evenodd"/>
                    </svg>
                    </span>
            </x-web.button>
        @else
            <x-web.button class="flex-1" wire:click.prevent="$parent.confirmReservation">
                    <span class="flex flex-row gap-x-4 items-center justify-between">
                          Dokončit
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                    </span>
            </x-web.button>
        @endif
    </div>
    <x-web.confirm-action-modal id="cancelReservation">
        <svg class="mx-auto mb-4 text-black w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        @if(is_null($expiry))
            <h3 class="mb-5 text-lg font-bold text-black">Nemáte vybraný žádný časový slot</h3>
            <div class="flex justify-between max-w-[250px] gap-x-5 mx-auto">
                <x-web.button class="flex-1" data-modal-hide="cancelReservation" data-modal-hide="cancelReservation" type="white">Zpět</x-web.button>
            </div>
        @else
            <h3 class="mb-5 text-lg font-bold text-black">Opravdu si přejete zrušit vybranou rezervaci?</h3>
            <div class="flex justify-between max-w-[250px] gap-x-5 mx-auto">
                <x-web.button class="flex-1" wire:click="$parent.deleteSelectedReservation({{ user()->temporaryReservation?->id }})" data-modal-hide="cancelReservation" type="danger">Potvrdit</x-web.button>
                <x-web.button class="flex-1" data-modal-hide="cancelReservation" data-modal-hide="cancelReservation" type="white">Zpět</x-web.button>
            </div>

        @endif

    </x-web.confirm-action-modal>
</div>

