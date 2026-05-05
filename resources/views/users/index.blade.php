<x-app-layout>
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">كل المستخدمين</h2>

        <div class="grid gap-3">
            @foreach($users as $user)
                <div class="p-3 border rounded flex justify-between">
                    <div>
                        <p class="font-bold">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>

                    <span class="text-sm bg-gray-200 px-2 py-1 rounded">
                        {{ $user->role ?? 'user' }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>
</x-app-layout>
