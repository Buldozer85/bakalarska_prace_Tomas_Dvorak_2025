<x-web.layouts.app title="Změna hesla">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 h-[1200px]">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Resetování hesla</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @if(session()->has('status'))
                    <div>
                        <p class="text-green-800 text-sm">{{ session('status') }}</p>
                    </div>
                @endif
                <form class="space-y-6" action="{{ route('forgot-password-page.send-email') }}" method="POST">
                    @csrf
                    <x-web.form.input label="E-mailová adresa" id="email" name="email" type="email" auto-complete="email" required/>

                    <div>
                        <x-web.button button-type="submit" class="w-full" type="primary">Odeslat</x-web.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-web.layouts.app>
