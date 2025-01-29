@props([
    'tabName' => '',
    'disabled' => false
])
<li class="me-2">
    @if($disabled)
        <a class="inline-block p-4 rounded-t-lg text-gray-400 cursor-not-allowed">{{ $slot }}</a>
    @else
        <a @click="selectedTab = '{{ $tabName }}'; window.location.hash = '{{ $tabName }}'" x-bind:class="selectedTab == '{{ $tabName }}' ? 'text-brand-black border-b-2 border-brand-black' : 'border-b-2 border-transparent'" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 cursor-pointer">{{ $slot }}</a>
    @endif
</li>
