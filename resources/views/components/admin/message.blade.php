<div class="flex flex-col sm:flex-row items-center sm:items-start gap-2.5 w-full @if($isAdmin) justify-end @else justify-start @endif">
    {{ $slot }}
    <div class="flex flex-col w-[320px] md:w-[520px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
        <div class="flex flex-col md:flex-row items-center space-x-2 rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $message->sender_email }}</span>
            <time  class="text-sm font-normal text-gray-500 dark:text-gray-400">@if(round($message->sent->diffInDays(\Carbon\Carbon::now())) > 0) {{ $message->sent->format('j.n.Y') }} @endif {{ $message->sent->format('G:i') }}</time>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{ $message->message }}</p>
    </div>
</div>
