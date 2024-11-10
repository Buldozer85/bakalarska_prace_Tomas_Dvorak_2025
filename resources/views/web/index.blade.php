<x-web.layouts.app title="Hlavní strana">
    <div class="relative">
        <div class="bg-black opacity-50 absolute w-full h-full z-20 top-0"></div>
        <div class="bg-brand z-30 bottom-0 w-full md:top-0 md:h-full md:w-1/3 absolute clip-path py-8">
            <div class="md:relative md:top-60 text-center md:pr-10 md:space-y-8 max-w-image-text m-auto ">
                <h1 class="text-white !leading-snug font-bold top-1/2 text-5xl 2xl:text-7xl text-left hidden md:block">
                    Kuželna Veselí</h1>
                <p class="text-left text-brand-yellow font-bold text-2xl xl:text-3xl !leading-snug hidden md:block">Přijďte si s&nbsp;námi zahrát kuželky!</p>
            </div>
        </div>

        <div class="bg-homepage-image bg-cover bg-center w-full relative py-96">
            <h1 class="text-white mx-auto text-6xl z-50 relative px-12 md:hidden font-bold !leading-snug">Vítejte na stránkách Kuželny Veselí</h1>
        </div>
    </div>

    <div
        class="mx-6 sm:mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-16 xl:gap-40 sm:mt-20 lg:mx-20 lg:max-w-none lg:grid-cols-3">
        <x-web.small-conteiner>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="mx-auto w-10 h-10 2xl:w-12 2xl:h-12">
                    <path fill-rule="evenodd"
                          d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z"
                          clip-rule="evenodd"/>
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z"/>
                </svg>
            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold">
                Provozní řád
            </h2>

            <p class="text-lg 2xl:text-xl font-normal">
                Přečtěte si důležité informace o provozu kuželny
            </p>

            <x-slot:button>
                <x-web.button class="text-lg 2xl:text-xl px-10" type="secondary">Jak to u nás chodí?</x-web.button>
            </x-slot:button>
        </x-web.small-conteiner>

        <x-web.small-conteiner>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="mx-auto w-10 h-10 2xl:w-12 2xl:h-12">
                    <path
                        d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z"/>
                    <path fill-rule="evenodd"
                          d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold">
                Rezervace
            </h2>

            <p class="text-lg 2xl:text-xl font-normal">
                Zarezervujte si termín v našem rezervačním systému
            </p>

            <x-slot:button>
                <x-web.button class="text-lg 2xl:text-xl px-10" type="secondary">Rezervujte a hrajte!</x-web.button>
            </x-slot:button>
        </x-web.small-conteiner>

        <x-web.small-conteiner>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto">
                    <path fill-rule="evenodd"
                          d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                          clip-rule="evenodd"/>
                </svg>

            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold">
                Důležité kontakty
            </h2>

            <p class="text-lg 2xl:text-xl font-normal">
                V případě dotazů nás můžete kontaktovat
            </p>

            <x-slot:button>
                <x-web.button class="text-lg 2xl:text-xl px-10" type="secondary">Kontaktujte nás!</x-web.button>
            </x-slot:button>
        </x-web.small-conteiner>
    </div>

    <h1 class="text-4xl font-bold text-center text-brand">Zázemí kuželny</h1>

    <div class="lg:mx-20 mx-6">
        <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            <li class="relative">
                <div
                    class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ asset("images/1.jpg") }}" alt=""
                         class="pointer-events-none object-cover group-hover:opacity-75">
                    <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for IMG_4985.HEIC</span>
                    </button>
                </div>
            </li>

            <li class="relative">
                <div
                    class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ asset("images/2.jpg") }}" alt=""
                         class="pointer-events-none object-cover group-hover:opacity-75">
                    <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for IMG_4985.HEIC</span>
                    </button>
                </div>
            </li>

            <li class="relative">
                <div
                    class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ asset("images/3.jpg") }}" alt=""
                         class="pointer-events-none object-cover group-hover:opacity-75">
                    <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for IMG_4985.HEIC</span>
                    </button>
                </div>
            </li>

            <li class="relative">
                <div
                    class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ asset("images/4.jpg") }}" alt=""
                         class="pointer-events-none object-cover group-hover:opacity-75">
                    <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for IMG_4985.HEIC</span>
                    </button>
                </div>
            </li>

            <li class="relative">
                <div
                    class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ asset("images/6.jpg") }}" alt=""
                         class="pointer-events-none object-cover group-hover:opacity-75">
                    <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for IMG_4985.HEIC</span>
                    </button>
                </div>
            </li>
        </ul>
    </div>

    <h1 class="text-4xl font-bold text-center text-brand text-brand">Ceník pronájmu areálu</h1>


    <div
        class="isolate mx-6 mx-auto lg:mx-6 xl:mx-auto mt-16 grid max-w-md grid-cols-1 gap-y-8 sm:mt-20 lg:max-w-[1200px] lg:grid-cols-3">
        <div
            class="flex flex-col justify-between rounded-3xl p-8 ring-1 ring-white xl:p-10 lg:mt-8 lg:rounded-r-none bg-brand-black">
            <div>
                <div class="flex items-center justify-center gap-x-4 mt-6">
                    <h3 id="tier-freelancer" class="text-4xl text-center font-bold leading-8 text-brand-yellow">Krátkodobý</h3>
                </div>
                <p class="mt-12 flex items-baseline gap-x-1 text-center justify-center">
                    <span class="text-2xl font-normal tracking-tight text-white text-center">+ do 2 hodin</span>
                </p>
                <h4 class="text-4xl font-bold tracking-tight text-white mt-16 text-center">200,- Kč</h4>
                <p class="mt-16 flex items-baseline gap-x-1 text-center justify-center">
                    <span class="text-2xl font-normal tracking-tight text-white">+ kuželník 50,- Kč</span>
                    <span class="text-sm font-normal leading-6 text-white text-center">/hodinu</span>
                </p>
            </div>
        </div>

        <div
            class="flex flex-col justify-between rounded-3xl bg-brand p-8 ring-1 ring-white xl:p-10 lg:z-10 lg:rounded-b-none shadow-2xl">
            <div>
                <div class="flex items-center justify-center gap-x-4 mt-6">
                    <h3 id="tier-startup" class="text-4xl font-bold leading-8 text-white">Celodenní</h3>
                </div>
                <p class="mt-12 flex items-baseline gap-x-1 text-center justify-center">
                    <span class="text-2xl font-normal tracking-tight text-white text-center">+ od 2 do 24 hodin</span>
                </p>
                <h4 class="text-4xl font-bold tracking-tight text-white mt-16 text-center">500,- Kč</h4>
                <p class="mt-16 flex items-baseline gap-x-1 text-center justify-center">
                    <span class="text-2xl font-normal tracking-tight text-white">+ kuželník 50,- Kč</span>
                    <span class="text-sm font-normal leading-6 text-white text-center">/hodinu</span>
                </p>
            </div>
        </div>

        <div
            class="flex flex-col justify-between rounded-3xl bg-brand-black p-8 ring-1 ring-white xl:p-10 lg:mt-8 lg:rounded-l-none">
            <div>
                <div class="flex items-center justify-center gap-x-4 mt-6">
                    <h3 id="tier-enterprise" class="text-4xl font-bold leading-8 text-brand-yellow">Komerční akce</h3>
                </div>
                <p class="mt-12 flex items-baseline gap-x-1 text-center justify-center">
                    <span class="text-2xl font-normal tracking-tight text-white text-center">+ od 2 do 24 hodin</span>
                </p>
                <h4 class="text-4xl font-bold tracking-tight text-white mt-16 text-center">1000,- Kč</h4>
                <p class="mt-16 flex items-baseline gap-x-1 text-center justify-center">
                    <span class="text-2xl font-normal tracking-tight text-white">+ kuželník 50,- Kč</span>
                    <span class="text-sm font-normal leading-6 text-white text-center">/hodinu</span>
                </p>
            </div>
        </div>
    </div>

    <h1 class="text-4xl font-bold text-center text-brand">Ceník pronájmu herny</h1>

    <div class="md:mx-auto max-w-2xl mx-6">
        <x-web.small-conteiner>
            <h3 class="xl:text-4xl text-2xl font-bold">Cena za jednu 1 hod</h3>
            <p class="xl:text-4xl text-2xl font-normal">
                100,- Kč
            </p>
        </x-web.small-conteiner>
    </div>

    <h1 class="text-4xl font-bold text-center text-brand">Základní informace</h1>

    <div
        class="mx-6 sm:mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-16 xl:gap-60 sm:mt-20 lg:mx-20 lg:max-w-none lg:grid-cols-2">
        <x-web.small-conteiner color="black">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold">
                Otvírací doba
            </h2>

            <p class="text-lg 2xl:text-xl">
                Pondělí - Sobota
            </p>
            <p class="text-lg 2xl:text-xl text-brand-yellow font-normal">
                9:00 - 20:00
            </p>
        </x-web.small-conteiner>

        <x-web.small-conteiner>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto mt-6">
                    <path fill-rule="evenodd"
                          d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold mt-6">
                Zázaz vstupu se zvířaty
            </h2>
        </x-web.small-conteiner>

        <x-web.small-conteiner>
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto mt-6">
                    <path fill-rule="evenodd"
                          d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold mt-6">
                Vstup do herny jen se souhlasem pověřené osoby
            </h2>
        </x-web.small-conteiner>

        <x-web.small-conteiner color="black">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto mt-6">
                    <path fill-rule="evenodd"
                          d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot:icon>

            <h2 class="text-2xl 2xl:text-3xl font-bold mt-6">
                Převzetí klíčů nutno předem domluvit
                s pověřenou osobou
            </h2>
        </x-web.small-conteiner>
    </div>

    <h1 class="text-4xl font-bold text-center text-brand">Pověřené osoby</h1>

    <div
        class="mx-6 sm:mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-16 xl:gap-60 sm:mt-20 lg:mx-20 lg:max-w-none 2xl:grid-cols-2 py-12">
            <x-web.contact-card name="Jiří Jeřábek" description="Správce kuželny" phone="+420 724 410 275" email="kuzelnaveseli@centrum.cz"/>
            <x-web.contact-card name="Pavel Danihelka" description="Zástupce správce kuželny" phone="+420 777 575 750" email="kuzelnaveseli@centrum.cz"/>
    </div>

</x-web.layouts.app>
