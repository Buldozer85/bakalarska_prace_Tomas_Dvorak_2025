<x-web.layouts.app title="Přihlášení">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Přihlaste te se ke svému účtu</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <x-web.form.input label="E-mailová adresa" id="email" name="email" type="email" auto-complete="email" required/>
                    <x-web.form.input label="Heslo" id="password" name="password" type="password" required/>

                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-brand-darker hover:text-indigo-500">Zapomněli jste heslo?</a>
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

