<x-web.layouts.app page="reservations" title="Rezervace">
    <div class="max-w-nav mx-auto lg:px-8 pb-32 max-lg:pt-12">
        <div class="flex flex-col lg:flex-row lg:items-center ">
            <div class="flex-1 max-lg:space-y-8">
                <x-web.heading class="lg:!text-left !text-center">Zajistěte si u nás<br>místo!</x-web.heading>
                <p class="md:text-4xl text-2xl !leading-snug font-normal lg:text-left text-center">Rezervujte si dráhu nebo<br> i celý areál.</p>
            </div>

            <div class="flex-1 flex justify-end max-lg:hidden">
                <img src="{{ asset('images/reservation.png') }}"/>
            </div>

        </div>

        <div class="space-y-12">
            <div class="bg-brand rounded-xl w-full h-[650px] lg:h-[800px] mt-72">
                <div class="max-w-[1300px] relative mx-auto top-[-20%]">
                    <div>
                        <livewire:web.reservation :read-only="true"></livewire:web.reservation>
                    </div>

                </div>
            </div>

            <h2 class="text-center text-brand text-4xl lg:text-5xl font-bold ">A kolik Vás to bude stát?</h2>

            <h3 class="text-center text-3xl text-brand-brown-red">Areál</h3>
                <x-web.pricing/>


            <h3 class="text-center text-3xl text-brand-brown-red">Herna</h3>

            <div class="md:mx-auto max-w-2xl mx-6">
                <x-web.small-conteiner>
                    <h3 class="xl:text-4xl text-2xl font-bold">Cena za jednu 1 hod</h3>
                    <p class="xl:text-4xl text-2xl font-normal">
                        100,- Kč
                    </p>
                </x-web.small-conteiner>
            </div>
        </div>
    </div>
</x-web.layouts.app>
