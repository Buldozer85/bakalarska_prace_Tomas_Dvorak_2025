<x-web.layouts.app page="login" title="Přihlášení">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 lg:h-[1200px]">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mx-6 md:mx-0 mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Přihlaste se ke svému účtu</h2>
        </div>

        <div class="mt-8 mx-6 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @isset($status)
                    <div>
                        <p class="text-green-800">{{ $status }}</p>
                    </div>
                @endisset
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <x-web.form.input label="E-mailová adresa" id="email" name="email" type="email" auto-complete="email" required/>
                    <x-web.form.input label="Heslo" id="password" name="password" type="password" required/>

                    <div class="flex flex-col space-y-4">
                        <div class="text-sm">
                            <a href="{{ route('forgot-password-page.show') }}" class="font-medium text-brand-darker hover:text-green-900 hover:underline">Zapomněli jste heslo?</a>
                        </div>
                        <div class="text-sm">
                            <p>
                                Ještě nemáte účet?
                                <a href="{{ route('show-registration-page') }}" class="font-medium text-brand-darker hover:text-green-900 hover:underline"> Registrovat zde</a>
                            </p>

                        </div>
                    </div>

                    <div>
                        <x-web.button button-type="submit" class="w-full" type="primary">Přihlásit se</x-web.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-web.layouts.app>

