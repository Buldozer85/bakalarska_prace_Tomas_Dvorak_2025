<div {{ $attributes->merge(["class" => "bg-brand text-white text-center py-10 space-y-4 rounded-md px-4"]) }}>
    @isset($icon)
        {{ $icon }}
    @endisset

    <div class="text-center space-y-4">
        {{ $slot }}
    </div>

    @isset($button)
        {{ $button }}
    @endisset
</div>
