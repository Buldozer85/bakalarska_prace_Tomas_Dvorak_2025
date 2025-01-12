<div>
    <div class="flex flex-col gap-y-12 mx-auto max-w-[1400px] min-h-[900px]">
        @if(!is_null($conversation->id))
            @foreach($messages as $message)
                <div class="flex flex-row">
                    <div class="flex-[4) w-full">
                        <x-web.message :message="$message">
                            @if($message->sender_email != user()->email)
                                <x-web.message-name-bubble name="{{ config('app.name') }}" color="bg-brand-black text-white"/>
                            @else
                                <x-web.message-name-bubble name="{{ user()->full_name }}" color="bg-brand text-white"/>
                            @endif

                        </x-web.message>
                    </div>
                </div>
            @endforeach
            {!! $messagesLinks !!}
        @endif

    </div>

    <div class="max-w-[1400px] mx-auto mt-12">
        <form wire:submit="sendMessage">
            <label for="message" class="sr-only">Vaše zpráva</label>
            <div class="flex items-baseline px-3 py-2 rounded-lg bg-gray-50 gap-x-12">
                <x-web.form.textarea placeholder="Zde napiště svou zprávu..." id="message" wire:model="message" name="message"></x-web.form.textarea>

                <button type="submit" class="inline-flex justify-center p-2 text-brand rounded-full cursor-pointer">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                    </svg>
                    <span class="sr-only">Odeslat zprávu</span>
                </button>
            </div>
        </form>
    </div>
</div>
