<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset("images/ico.png") }}">
    @vite('resources/css/app.css')
    <title>Kuželna Veselí administrace: Přihlášení</title>
</head>
<body>
<main>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 2xl:h-[1200px] mx-6">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Přihlášení do administrace</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @isset($status)
                    <div>
                        <p class="text-green-800">{{ $status }}</p>
                    </div>
                @endisset
                <form class="space-y-6" action="{{ route('administration.login') }}" method="POST">
                    @csrf
                    <x-admin.form.input label="E-mailová adresa" id="email" name="email" type="email" auto-complete="email" required/>
                    <x-admin.form.input label="Heslo" id="password" name="password" type="password" required/>

                    <div>
                        <x-web.button button-type="submit" class="w-full" type="primary">Přihlásit se</x-web.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


@vite('resources/js/app.js')
@livewireScripts
</body>
</html>
