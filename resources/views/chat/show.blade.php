<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            💬 Trip Chat
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-lg p-6">

                {{-- Header --}}
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2 mb-4">
                    💬 Messages
                </h3>

                {{-- Messages --}}
                <div id="messages-{{ $trip->id }}" class="space-y-3 mb-6">

                    @foreach($messages as $message)
                        <div class="bg-gray-100 rounded-2xl p-3 flex gap-2">
                            👤
                            <div>
                                <b>{{ $message->sender->name }}:</b>
                                {{ $message->message }}
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Send Message --}}
                <form id="chat-form" method="POST" action="{{ route('messages.store', $trip) }}">
                    @csrf

                    <div class="flex items-center gap-2">

                        💬

                        <input type="text"
                               name="message"
                               class="w-full border rounded-2xl p-3 focus:ring-2 focus:ring-blue-500"
                               placeholder="Type your message...">

                    </div>

                    <button class="mt-3 bg-blue-500 text-white px-5 py-3 rounded-2xl hover:bg-blue-600 flex items-center gap-2">
                        📩 Send
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>
        window.tripId = {{ $trip->id }};
    </script>

</x-app-layout>
