<x-web.layouts.app title="Rezervace">
    <div class="max-w-nav mx-auto lg:px-8 pb-32">
        <div class="flex flex-row items-center">
            <div class="flex-1">
                <x-web.heading>Zajistěte si u nás<br>místo!</x-web.heading>
                <p class="md:text-4xl text-2xl !leading-snug font-normal">Rezervujte si dráhu nebo<br> i celý areál.</p>
            </div>

            <div class="flex-1 flex justify-end">
                <img src="{{ asset('images/reservation.png') }}"/>
            </div>

        </div>

        <div>
            <div class="bg-brand rounded-xl w-full h-[800px] mt-36">
                <div class="max-w-[1300px] relative mx-auto top-[-20%]">
                    <livewire:web.reservation :read-only="true"></livewire:web.reservation>
                </div>

            </div>
        </div>
    </div>
</x-web.layouts.app>
