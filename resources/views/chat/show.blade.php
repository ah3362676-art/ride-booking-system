<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            شات الرحلة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto bg-white p-6 shadow rounded-lg">

            {{-- Messages --}}
            <div id="messages-{{ $trip->id }}" class="space-y-2 mb-4">

                @foreach($messages as $message)
                    <div class="p-2 rounded bg-gray-100">
                        <b>{{ $message->sender->name }}:</b>
                        {{ $message->message }}
                    </div>
                @endforeach

            </div>

            {{-- Send Message --}}
            <form id="chat-form" method="POST" action="{{ route('messages.store', $trip) }}">
                @csrf

                <input type="text"
                       name="message"
                       class="border p-2 w-full rounded"
                       placeholder="اكتب رسالة...">

                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
                    إرسال
                </button>
            </form>

        </div>
    </div>

    {{-- مهم جدًا --}}
    <script>
        window.tripId = {{ $trip->id }};
    </script>

</x-app-layout>
