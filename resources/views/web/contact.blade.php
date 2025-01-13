<x-web.layouts.app page="contact" :title="$title">
    <div class="bg-white mx-auto max-w-nav space-y-12 pb-32">
        <div class="flex flex-row items-center">
            <div class="flex-1 space-y-4 max-md:flex max-md:flex-col max-md:justify-center max-md:mt-12 mx-8">
                <x-web.heading>Kontaktujte <span class="text-brand-black"><br>nás</span></x-web.heading>
                <x-web.button class="!px-8 md:!px-12" type="black"><span class="text-md md:text-lg font-normal">Pošlete nám dotaz!</span></x-web.button>
            </div>

            <div class="flex-1 hidden md:block">
                <img alt="Obrázek zobrazující komunikační symboly" src="{{ asset('images/contact.png') }}">
            </div>
        </div>
        <div class="mx-auto lg:px-8 space-y-12">
            <div class="mx-auto space-y-32 lg:mx-0 lg:max-w-none">
                <div class="grid grid-cols-1 gap-y-10 gap-x-8 xl:grid-cols-2 px-6">
                    <div class="my-auto">
                        <h2 class="text-3xl md:text-5xl text-brand-darker font-bold tracking-tight text-gray-900 text-center">Kontaktní osoby</h2>
                    </div>
                    <div class="space-y-12">
                        <x-web.contact-card name="Jiří Jeřábek" description="Správce kuželny" email="kuzelnaveseli@centrum.cz" phone="+420 724 410 275"/>
                        <x-web.contact-card name="Pavel Danihelka" description="Zástupce správce kuželny" email="kuzelnaveseli@centrum.cz" phone="+420 777 575 750"/>
                    </div>
                </div>
                <div class="!px-0">
                    <div>
                        <h2 class="text-3xl md:text-5xl font-bold tracking-tight text-center">Kde nás najdete?</h2>
                    </div>
                    <div class="py-10 ">
                        <iframe class="w-full h-[450px]" style="border:none" src="https://frame.mapy.cz/s/lemapuvasu" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-brand flex flex-col md:flex-row md:items-center py-36 md:py-0 px-12 xl:px-36 md:h-[800px] max-md:space-y-4">

            <div class="md:flex-1">
                <h2 class="text-white text-2xl md:text-5xl text-center md:text-left font-bold !leading-snug">Napadl Vás nějaký dotaz?</h2>
            </div>

            <div class="md:flex-1 ">
               <livewire:web.contact-form/>
            </div>
        </div>
    </div>
</x-web.layouts.app>
