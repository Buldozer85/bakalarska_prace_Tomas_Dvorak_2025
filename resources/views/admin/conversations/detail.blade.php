<x-admin.layouts.app title="Konverzace s {{ $conversation->from_name }}" page="messages">

    <livewire:admin.conversation :conversation="$conversation"/>
</x-admin.layouts.app>
