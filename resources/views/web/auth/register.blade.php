<x-web::layouts.app title="Registrace">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 items-center">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Vytvořte si účet</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            @error("registration_error")
                <x-web::error-message>
                    {{ $message }}
                </x-web::error-message>
            @enderror
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="{{ route("register") }}" method="POST">
                    @csrf
                    <x-web::form.input label="E-mailová adresa" id="email" name="email" type="email"
                                       :value="old('email')" required/>
                    <div class="flex flex-row gap-5">
                        <x-web::form.input label="Jméno" id="first_name" name="first_name" type="text" required/>
                        <x-web::form.input label="Příjmení" id="last_name" name="last_name" type="text" required/>
                    </div>
                    <x-web::form.input label="Telefon" id="phone" name="phone" type="text" required/>
                    <x-web::form.input label="Heslo" id="password" name="password" type="password" required/>
                    <x-web::form.input label="Heslo znovu" id="password_confirmation" name="password_confirmation" type="password"
                                       required/>
                    <x-web::form.check-box id="gdpr_agreement" name="gdpr_agreement">Souhlasím s prohlášením o ochraně
                        osobních údajů
                    </x-web::form.check-box>
                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            <a href="{{ route('show-login-page') }}"
                               class="font-medium text-brand hover:text-brand-darker">Již máte účet? Přihlašte se <span
                                    class="underline">zde</span></a>
                        </div>
                    </div>
                    <div>
                        <x-web::button button-type="submit" class="w-full" type="primary">
                            Zaregistrovat se
                        </x-web::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-web::layouts.app>
