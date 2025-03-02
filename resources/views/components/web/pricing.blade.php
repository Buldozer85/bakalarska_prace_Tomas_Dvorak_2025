<div
    class="isolate mx-6 sm:mx-auto lg:mx-6 xl:mx-auto mt-16 grid max-w-md grid-cols-1 gap-y-8 sm:mt-20 lg:max-w-[1200px] lg:grid-cols-3">
    <div
        class="flex flex-col justify-between rounded-3xl p-8 ring-1 ring-white xl:p-10 lg:mt-8 lg:rounded-r-none bg-brand-black">
        <div class="space-y-4 md:space-y-12">
            <div class="flex items-center justify-center gap-x-4 mt-6">
                <h3 id="tier-freelancer" class="text-2xl md:text-3xl lg:text-4xl text-center font-bold leading-8 text-brand-yellow">Krátkodobý</h3>
            </div>
            <p class=" flex items-baseline gap-x-1 text-center justify-center">
                <span class="text-md lg:text-2xl font-normal tracking-tight text-white text-center">+ do 2 hodin</span>
            </p>
            <h4 class="text-lg md:text-3xl lg:text-4xl font-bold tracking-tight text-white mt-16 text-center">{{ settings('price.short-term') }},- Kč</h4>
            <p class=" flex items-baseline gap-x-1 text-center justify-center">
                <span class="text-lg md:text-xl lg:text-2xl font-normal tracking-tight text-white">+ kuželník {{ settings('price.track.pack') }},- Kč</span>
                <span class="text-sm font-normal leading-6 text-white text-center">/hodinu</span>
            </p>
        </div>
    </div>

    <div
        class="flex flex-col justify-between rounded-3xl bg-brand p-8 ring-1 ring-white xl:p-10 lg:z-10 lg:rounded-b-none shadow-2xl">
        <div class="space-y-4 md:space-y-12">
            <div class="flex items-center justify-center gap-x-4 mt-6">
                <h3 id="tier-startup" class="text-2xl md:text-3xl lg:text-4xl font-bold leading-8 text-white">Celodenní</h3>
            </div>
            <p class="flex items-baseline gap-x-1 text-center justify-center">
                <span class="text-md md:text-2xl font-normal tracking-tight text-white text-center">+ od 2 do 24 hodin</span>
            </p>
            <h4 class="text-lg md:text-3xl lg:text-4xl font-bold tracking-tight text-white mt-16 text-center">{{ settings('price.full-day') }},- Kč</h4>
            <p class="flex items-baseline gap-x-1 text-center justify-center">
                <span class="text-lg md:text-xl lg:text-2xl font-normal tracking-tight text-white">+ kuželník {{ settings('price.track.pack') }},- Kč</span>
                <span class="text-sm font-normal leading-6 text-white text-center">/hodinu</span>
            </p>
        </div>
    </div>

    <div
        class="flex flex-col justify-between rounded-3xl bg-brand-black p-8 ring-1 ring-white xl:p-10 lg:mt-8 lg:rounded-l-none">
        <div class="space-y-4 md:space-y-12">
            <div class="flex items-center justify-center gap-x-4 mt-6">
                <h3 id="tier-enterprise" class="text-2xl md:text-3xl lg:text-4xl font-bold leading-8 text-brand-yellow">Komerční akce</h3>
            </div>
            <p class="flex items-baseline gap-x-1 text-center justify-center">
                <span class="text-md md:text-2xl font-normal tracking-tight text-white text-center">+ od 2 do 24 hodin</span>
            </p>
            <h4 class="text-lg md:text-3xl lg:text-4xl font-bold tracking-tight text-white mt-16 text-center">{{ settings('price.commercial-events') }},- Kč</h4>
            <p class="flex items-baseline gap-x-1 text-center justify-center">
                <span class="text-lg md:text-xl lg:text-2xl font-normal tracking-tight text-white">+ kuželník {{ settings('price.track.pack') }},- Kč</span>
                <span class="text-sm font-normal leading-6 text-white text-center">/hodinu</span>
            </p>
        </div>
    </div>
</div>
