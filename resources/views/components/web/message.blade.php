@if($message->sender_email === user()->email)
    <div class="flex items-start gap-2.5 w-full justify-end">
        {{ $slot }}
        <div class="flex flex-col w-[250px] lg:w-[520px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">Já</span>
                <time  class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $message->sent->format('G:i') }}</time>
            </div>
            <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{ $message->message }}</p>
        </div>

    </div>
@else
    <div class="flex items-start gap-2.5 w-full justify-start">
        {{ $slot }}
        <div class="flex flex-col w-[250px] lg:w-[520px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">

                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $message->sender_email }}</span>
                <time  class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $message->sent->format('G:i') }}</time>
            </div>
            <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{ $message->message }}</p>
        </div>

    </div>
@endif

