<x-app-layout>
    <x-slot name="header">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Chat</div>
                        <div class="card-body">
                            <div class="chat-container">
                                @foreach ($messages as $message)
                                    @if (auth()->user()->id === $message->user_id)
                                        <div class="message message-sent">
                                            <div class="message-text">{{ $message->message }}</div>
                                            <div class="message-time">{{ $message->created_at }}</div>
                                        </div>
                                    @else
                                        <div class="message message-received">
                                            <div class="user-name">{{ $message->user->name }}</div>
                                            <div class="message-text mt-2">{{ $message->message }}</div>
                                            <div class="message-time">{{ $message->created_at }}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="input-area d-flex">

                                <input type="text" class="form-control flex-grow-1"
                                    placeholder="Type your message...">
                                <button class="btn btn-primary ms-2 save-message"><i
                                        class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>


</x-app-layout>
<script>
    $(".save-message").on("click", function() {
        const messageInput = document.querySelector('.input-area input');
        const messageText = messageInput.value;

        if (messageText.trim() == "") {
            alert("Message can not be empty")
            return 0;
        }
        $.ajax({
            url: "{{ route('store-message') }}",
            type: 'POST',
            data: JSON.stringify({
                message: messageText,
            }), // Data as JSON string
            contentType: 'application/json', // Important: tell the server you're sending JSON
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            },
            success: function(data) {
                if (!data.success) {
                    console.error('Error:', data.error);
                    // Revert optimistic update:
                    const chatContainer = document.querySelector('.chat-container');
                    chatContainer.removeChild(chatContainer.lastChild);
                    alert("Error sending message.");
                } else {
                    console.log('Message saved:', data);
                }
            },
            error: function(xhr, status, error) {

            }
        });

        messageInput.value = "";

    })
</script>
