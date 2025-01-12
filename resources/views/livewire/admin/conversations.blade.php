<div class="max-w-[1400px] mx-auto">
    @foreach($conversations as $conversation)
        <ul role="list" class="divide-y divide-gray-100">
            <x-admin.conversation id="{{ $conversation->id }}" :from-email="$conversation->from_email" :name="$conversation->from_name" :message-count="$conversation->unseenMessages->count()"/>
        </ul>
    @endforeach
    {{ $conversations->links() }}
</div>
