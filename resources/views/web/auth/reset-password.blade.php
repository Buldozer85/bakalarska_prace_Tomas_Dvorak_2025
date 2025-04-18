<x-web.layouts.app title="Reset hesla">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 h-[1200px]">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Resetování hesla</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}" id="token">
                    <x-web.form.input label="E-mailová adresa" id="email" name="email" type="email" auto-complete="email" required/>

                    <x-web.form.input label="Heslo" id="password" name="password" type="password" auto-complete="password" required/>
                    <x-web.form.input label="Heslo znovu" id="password_confirmation" name="password_confirmation" type="password" required/>
                    @isset($status)
                        <div>
                            <p class="text-green-800">{{ $status }}</p>
                        </div>
                    @endisset
                    <div>
                        <x-web.button button-type="submit" class="w-full" type="primary">Odeslat</x-web.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-web.layouts.app>
