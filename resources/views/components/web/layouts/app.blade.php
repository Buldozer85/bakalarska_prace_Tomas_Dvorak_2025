@props([
    'title' => '',
    'page' => ''
])
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset("images/ico.png") }}">
    @vite('resources/css/app.css')
    <title>{{ "Kuželna Veselí: ". ($title ?? "") }}</title>
</head>
<body>
<x-web.page-sections.header current-page="{{ $page }}"/>

@if(session()->has('flashMessage'))
    <x-web.toast :type="session('flashMessage')['type']" :message="session('flashMessage')['message']"/>
@endif

<main class="min-h-screen space-y-20">
    {{ $slot }}
</main>

<x-web.page-sections.footer/>
@vite('resources/js/app.js')
@livewireScripts
</body>
</html>
