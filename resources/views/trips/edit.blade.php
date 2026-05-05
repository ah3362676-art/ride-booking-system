<x-app-layout>
    <x-slot name="header">
        {{-- عنوان الصفحة --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تعديل الرحلة
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('trips.update', $trip) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="vehicle_id" class="block text-sm font-medium text-gray-700">اختر المركبة</label>
                            <select name="vehicle_id" id="vehicle_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">-- اختر مركبة --</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        @selected(old('vehicle_id', $trip->vehicle_id) == $vehicle->id)>
                                        {{ $vehicle->brand }} - {{ $vehicle->model }} ({{ $vehicle->plate_number }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_address" class="block text-sm font-medium text-gray-700">عنوان البداية</label>
                            <input type="text" name="start_address" id="start_address"
                                   value="{{ old('start_address', $trip->start_address) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('start_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="start_lat" class="block text-sm font-medium text-gray-700">خط عرض البداية</label>
                                <input type="text" name="start_lat" id="start_lat"
                                       value="{{ old('start_lat', $trip->start_lat) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('start_lat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="start_lng" class="block text-sm font-medium text-gray-700">خط طول البداية</label>
                                <input type="text" name="start_lng" id="start_lng"
                                       value="{{ old('start_lng', $trip->start_lng) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('start_lng')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="end_address" class="block text-sm font-medium text-gray-700">عنوان النهاية</label>
                            <input type="text" name="end_address" id="end_address"
                                   value="{{ old('end_address', $trip->end_address) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('end_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="end_lat" class="block text-sm font-medium text-gray-700">خط عرض النهاية</label>
                                <input type="text" name="end_lat" id="end_lat"
                                       value="{{ old('end_lat', $trip->end_lat) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('end_lat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_lng" class="block text-sm font-medium text-gray-700">خط طول النهاية</label>
                                <input type="text" name="end_lng" id="end_lng"
                                       value="{{ old('end_lng', $trip->end_lng) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('end_lng')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-700">ميعاد الانطلاق</label>
                            <input type="datetime-local" name="departure_time" id="departure_time"
                                   value="{{ old('departure_time', $trip->departure_time?->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('departure_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label for="available_seats" class="block text-sm font-medium text-gray-700">عدد المقاعد المتاحة</label>
                                <input type="number" name="available_seats" id="available_seats"
                                       value="{{ old('available_seats', $trip->available_seats) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('available_seats')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price_per_seat" class="block text-sm font-medium text-gray-700">السعر لكل مقعد</label>
                                <input type="number" step="0.01" name="price_per_seat" id="price_per_seat"
                                       value="{{ old('price_per_seat', $trip->price_per_seat) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('price_per_seat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">الحالة</label>
                            <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="scheduled" @selected(old('status', $trip->status) === 'scheduled')>scheduled</option>
                                <option value="in_progress" @selected(old('status', $trip->status) === 'in_progress')>in_progress</option>
                                <option value="completed" @selected(old('status', $trip->status) === 'completed')>completed</option>
                                <option value="cancelled" @selected(old('status', $trip->status) === 'cancelled')>cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">ملاحظات</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $trip->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                    class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                                تحديث
                            </button>

                            <a href="{{ route('trips.index') }}"
                               class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
                                رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
