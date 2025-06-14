{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Чат с {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-indigo-600 text-white p-4">
            <h1 class="text-xl font-semibold">Чат с {{ $user->name }}</h1>
        </div>
        
        <div class="p-4 border-b border-gray-200">
            <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-800">← Back</a>
        </div>
        
        <div id="chat-messages" class="h-96 overflow-y-auto p-4 space-y-4">
            @foreach($messages as $message)
                <div class="{{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
                    <div class="{{ $message->sender_id == Auth::id() ? 'bg-indigo-100' : 'bg-gray-200' }} inline-block rounded-lg px-4 py-2">
                        <p class="text-sm">{{ $message->message }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="p-4 border-t border-gray-200">
            <form id="message-form" action="{{ route('chat.send', $user->id) }}" method="POST" class="flex space-x-2">
                @csrf
                <input type="text" name="message" id="message-input" placeholder="Введите сообщение..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Отправить</button>
            </form>
        </div>
    </div>
</div>

<script>

    const currentUserId = {{ Auth::id() }};
    const otherUserId = {{ $user->id }};
    
    // Создаем идентификатор канала (сортированный)
    const channelIds = [currentUserId, otherUserId].sort();
    const channelName = `chat.${channelIds[0]}.${channelIds[1]}`;
        
    // Подписываемся на канал
    Echo.private(channelName)
        .listen('NewMessage', (data) => {
            // Проверяем, что сообщение адресовано текущему пользователю
            if (data.message.receiver_id == currentUserId || data.message.sender_id == currentUserId) {
                addMessageToChat(data.message);
            }
        });

    // Функция добавления сообщения в чат
    function addMessageToChat(message) {
        const chatMessages = document.getElementById('chat-messages');
        const isCurrentUser = message.sender_id == currentUserId;
        
        const messageDiv = document.createElement('div');
        messageDiv.className = isCurrentUser ? 'text-right' : 'text-left';
        messageDiv.innerHTML = `
            <div class="${isCurrentUser ? 'bg-indigo-100' : 'bg-gray-200'} inline-block rounded-lg px-4 py-2">
                <p class="text-sm">${message.message}</p>
                <p class="text-xs text-gray-500 mt-1">Только что</p>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Обработка формы
    const form = document.getElementById('message-form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();
        
        if (!message) return;

        try {
            // Создаем временное сообщение для мгновенного отображения
            const tempMessage = {
                sender_id: currentUserId,
                receiver_id: otherUserId,
                message: message,
                created_at: new Date().toISOString()
            };
            addMessageToChat(tempMessage);
            
            // Отправляем на сервер
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });
            
            if (!response.ok) throw new Error('Ошибка отправки');
            
            messageInput.value = '';
        } catch (error) {
            console.error('Error:', error);
            alert('Ошибка при отправке сообщения');
        }
    });

</script>

@endsection