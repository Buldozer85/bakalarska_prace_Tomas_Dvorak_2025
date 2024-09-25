<x-web.layouts.app :title="$title">
    <div class="bg-white py-24 sm:py-32 lg:mx-20 mx-6">
        <div class="mx-auto  px-6 lg:px-8">
            <div class="mx-auto space-y-16 divide-y divide-gray-100 lg:mx-0 lg:max-w-none">
                <div class="grid grid-cols-1 gap-y-10 gap-x-8 xl:grid-cols-2">
                    <div class="my-auto">
                        <h2 class="text-5xl text-brand-darker font-bold tracking-tight text-gray-900 text-center">Kontaktní osoby</h2>
                    </div>
                    <div class="">
                        <x-web.small-conteiner class="bg-white  ">
                            <div class="flex flex-col sm:flex-row items-center shadow-lg space-y-2">
                                <div class="bg-brand z-30 w-full sm:w-1/2 clip-path py-3 sm:py-16 sm:pr-8 2xl:pr-0 space-y-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto ">
                                        <path fill-rule="evenodd"
                                              d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <h2 class="font-bold text-center text-xl 2xl:text-2xl">
                                        Jiří Jeřábek
                                    </h2>

                                    <h3 class="text-center">
                                        Správce kuželny
                                    </h3>
                                </div>

                                <div class="space-y-6 py-6 sm:py-0">
                                    <div class="text-black flex-row flex items-center space-x-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="w-6 h-6 text-black">
                                            <path fill-rule="evenodd"
                                                  d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-black font-bold lg:text-lg">+420 724 410 275</p>
                                    </div>

                                    <div class="flex-row flex items-center space-x-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="w-6 h-6 text-black">
                                            <path
                                                d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                                            <path
                                                d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                                        </svg>

                                        <p class="text-black font-bold lg:text-lg">kuzelnaveseli@centrum.cz</p>
                                    </div>
                                </div>
                            </div>
                        </x-web.small-conteiner>
                        <x-web.small-conteiner class="bg-white">
                            <div class="flex flex-col sm:flex-row items-center shadow-lg">
                                <div class="bg-brand z-30 w-full sm:w-1/2 clip-path py-3 sm:py-16 sm:pr-8 space-y-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-10 h-10 2xl:w-12 2xl:h-12 mx-auto ">
                                        <path fill-rule="evenodd"
                                              d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <h2 class="font-bold text-center text-xl 2xl:text-2xl">
                                        Pavel Danihelka
                                    </h2>

                                    <h3 class="text-center">
                                        Zástupce správce
                                    </h3>
                                </div>

                                <div class="space-y-6 py-6 sm:py-0">
                                    <div class="text-black flex-row flex items-center space-x-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="w-6 h-6 text-black">
                                            <path fill-rule="evenodd"
                                                  d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-black font-bold lg:text-lg">+420 777 575 750</p>
                                    </div>

                                    <div class="flex-row flex items-center space-x-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="w-6 h-6 text-black">
                                            <path
                                                d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                                            <path
                                                d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                                        </svg>

                                        <p class="text-black font-bold lg:text-lg">kuzelnaveseli@centrum.cz</p>
                                    </div>
                                </div>
                            </div>
                        </x-web.small-conteiner>

                    </div>
                </div>
                <div class="grid xl:grid-cols-2 gap-y-10 gap-x-8 pt-16 ">
                    <div class="my-auto">
                        <h2 class="text-5xl text-brand-darker font-bold tracking-tight text-gray-900 text-center">Kde nás najdete?</h2>
                    </div>
                    <div class="px- py-10 ">
                        <iframe class="w-full h-[450px]" style="border:none" src="https://frame.mapy.cz/s/lemapuvasu" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web.layouts.app>
