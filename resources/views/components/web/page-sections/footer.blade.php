<footer class="bg-brand">
    <div class="mx-auto max-w-7xl overflow-hidden py-20 px-6 sm:py-24 lg:px-8">
        <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
            <div class="pb-6">
                <a href="{{ route('homepage') }}" class="text-sm leading-6 text-white hover:text-slate-100">Domů</a>
            </div>

            <div class="pb-6">
                <a href="{{ route('reservation') }}" class="text-sm leading-6 text-white hover:text-slate-100">Rezervace</a>
            </div>

            <div class="pb-6">
                <a href="{{ route('contact') }}" class="text-sm leading-6 text-white hover:text-slate-100">Kontakt</a>
            </div>

            <div class="pb-6">
                <a href="{{ route('league') }}" class="text-sm leading-6 text-white hover:text-slate-100">Kuželkářská liga</a>
            </div>

            <div class="pb-6">
                <a href="{{ route('about-web') }}" class="text-sm leading-6 text-white hover:text-slate-100">O webu</a>
            </div>

            @guest
                <div class="pb-6">
                    <a href="{{ route('show-login-page') }}" class="text-sm leading-6 text-white hover:text-slate-100">Přihlášení</a>
                </div>

                <div class="pb-6">
                    <a href="{{ route('show-registration-page') }}" class="text-sm leading-6 text-white hover:text-slate-100">Registrace</a>
                </div>
            @endguest

            @auth
                <div class="pb-6">
                    <a href="{{ route('profile') }}" class="text-sm leading-6 text-white hover:text-slate-100">Profil</a>
                </div>
            @endauth
        </nav>

        <p class="mt-10 text-center text-xs leading-5 text-white">&copy; Tomáš Dvořák {{ Date("Y") }} @if(config('app.env') !== 'prod') Jedná se o testovací verzi!@endif</p>
    </div>
</footer>
