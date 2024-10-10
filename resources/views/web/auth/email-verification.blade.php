<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset("images/ico.png") }}">
    @vite('resources/css/app.css')
    <title>Kuželna Veselí: Je potřebné potvrzení e-mailové adresy</title>
</head>
<body class="min-h-screen space-y-20 bg-gradient-to-bl from-[#0D8828] to-[#228437] relative">
<main class="flex justify-center text-center">
    <div class="bg-white drop-shadow-xl rounded-md max-w-[1200px] mt-32 flex-[2] flex justify-center items-center flex-col space-y-12 p-12 mx-6">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M30 21V32.25M57 30C57 33.5457 56.3016 37.0567 54.9447 40.3325C53.5879 43.6082 51.5991 46.5847 49.0919 49.0919C46.5847 51.5991 43.6082 53.5879 40.3325 54.9447C37.0567 56.3016 33.5457 57 30 57C26.4543 57 22.9433 56.3016 19.6675 54.9447C16.3918 53.5879 13.4153 51.5991 10.9081 49.0919C8.40093 46.5847 6.41213 43.6082 5.05525 40.3325C3.69838 37.0567 3 33.5457 3 30C3 22.8392 5.84463 15.9716 10.9081 10.9081C15.9716 5.84464 22.8392 3 30 3C37.1608 3 44.0284 5.84464 49.0919 10.9081C54.1554 15.9716 57 22.8392 57 30ZM30 41.25H30.024V41.274H30V41.25Z" stroke="#0D8828" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <div class="flex-1 space-y-12">
            <p class="text-brand-darker font-bold">
                Pro vstup do této části webu je zapotřebí nejprve potvrzení Vaší e-mailové adresy
            </p>


            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                    Pokud Vám žádný e-mail nedorazil klikněte na odkaz <button type="submit" class="underline text-brand-darker hover:text-green-900 font-bold">zde</button>
            </form>

            @session('message')
                <p class="text-green-700">
                    {{ session('message') }}
                </p>
            @endsession


        </div>

        <div class="flex flex-col justify-center sm:flex-row sm:justify-between flex-1 w-full md:w-1/2 gap-2 space-y-4 sm:space-y-0">
            <x-web.button class="flex-1 max-w-[200px] md:!p-4" :route="route('homepage')">
                Zpět
            </x-web.button>

            <x-web.button class="flex-1 max-w-[200px] md:!p-4" :route="route('logout')">
                Odhlásit se
            </x-web.button>
        </div>
    </div>

</main>

@vite('resources/js/app.js')
@livewireScripts
</body>
</html>
