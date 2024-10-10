<footer class="bg-white">
    <div class="mx-auto max-w-7xl overflow-hidden py-20 px-6 sm:py-24 lg:px-8">
        <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
            <div class="pb-6">
                <a href="{{ route('homepage') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Domů</a>
            </div>

            <div class="pb-6">
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Rezervace</a>
            </div>

            <div class="pb-6">
                <a href="{{ route('contact') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Kontakt</a>
            </div>

            <div class="pb-6">
                <a href="{{ route('contact') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Kuželkářská liga</a>
            </div>

            @guest
                <div class="pb-6">
                    <a href="{{ route('show-login-page') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Přihlášení</a>
                </div>

                <div class="pb-6">
                    <a href="{{ route('show-registration-page') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Registrace</a>
                </div>
            @endguest

            @auth
                <div class="pb-6">
                    <a href="{{ route('profile') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Profil</a>
                </div>
            @endauth

        </nav>

        <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; {{ Date("Y") }} Tomáš Dvořák</p>
    </div>
</footer>
