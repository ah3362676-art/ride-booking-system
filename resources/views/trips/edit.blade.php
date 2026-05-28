<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Edit Trip
        </h2>
    </x-slot>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-xl p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Update Trip Details
                </h3>

                <form action="{{ route('trips.update', $trip) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Vehicle -->
                    <select name="vehicle_id" class="w-full p-3 border rounded-2xl mb-4">
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                @selected($trip->vehicle_id == $vehicle->id)>
                                {{ $vehicle->brand }} - {{ $vehicle->model }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Addresses -->
                    <div class="grid md:grid-cols-2 gap-4 mb-4">

                        <input type="text"
                               id="start_address"
                               name="start_address"
                               value="{{ $trip->start_address }}"
                               class="p-3 border rounded-2xl"
                               placeholder="Start Address">

                        <input type="text"
                               id="end_address"
                               name="end_address"
                               value="{{ $trip->end_address }}"
                               class="p-3 border rounded-2xl"
                               placeholder="End Address">

                    </div>

                    <!-- Hidden Coordinates -->
                    <input type="hidden" id="start_lat" name="start_lat" value="{{ $trip->start_lat }}">
                    <input type="hidden" id="start_lng" name="start_lng" value="{{ $trip->start_lng }}">

                    <input type="hidden" id="end_lat" name="end_lat" value="{{ $trip->end_lat }}">
                    <input type="hidden" id="end_lng" name="end_lng" value="{{ $trip->end_lng }}">

                    <!-- Map Button -->
                    <button type="button"
                            onclick="openMap()"
                            class="bg-blue-600 text-white px-4 py-2 rounded-xl mb-4">
                        📍 Edit Locations on Map
                    </button>

                    <!-- Time -->
                    <input type="datetime-local"
                           name="departure_time"
                           value="{{ $trip->departure_time?->format('Y-m-d\TH:i') }}"
                           class="w-full p-3 border rounded-2xl mb-4">

                    <!-- Seats + Price -->
                    <div class="grid md:grid-cols-2 gap-4 mb-4">

                        <input type="number"
                               name="available_seats"
                               value="{{ $trip->available_seats }}"
                               class="p-3 border rounded-2xl">

                        <input type="number"
                               step="0.01"
                               name="price_per_seat"
                               value="{{ $trip->price_per_seat }}"
                               class="p-3 border rounded-2xl">

                    </div>

                    <!-- Status -->
                    <select name="status" class="w-full p-3 border rounded-2xl mb-4">
                        @foreach (['scheduled','in_progress','completed','cancelled'] as $status)
                            <option value="{{ $status }}"
                                @selected($trip->status == $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Notes -->
                    <textarea name="notes"
                              class="w-full p-3 border rounded-2xl mb-4"
                              rows="3">{{ $trip->notes }}</textarea>

                    <button class="bg-black text-white w-full py-3 rounded-2xl">
                        Update Trip
                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- MODAL MAP -->
    <div id="mapModal"
         class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center">

        <div class="bg-white p-4 rounded-2xl w-[95%] max-w-3xl">

            <div class="flex justify-between mb-3">
                <h2 class="font-bold">Edit Locations</h2>
                <button onclick="closeMap()">❌</button>
            </div>

            <div class="flex gap-2 mb-3">

                <button type="button" onclick="getMyLocation()"
                        class="bg-blue-600 text-white px-3 py-2 rounded-xl w-full">
                    📍 My Location
                </button>

                <button type="button" onclick="setMode('start')"
                        class="bg-green-600 text-white px-3 py-2 rounded-xl w-full">
                    Start
                </button>

                <button type="button" onclick="setMode('end')"
                        class="bg-black text-white px-3 py-2 rounded-xl w-full">
                    End
                </button>

            </div>

            <div id="map" style="height: 420px;"></div>

            <button onclick="closeMap()"
                    class="mt-3 bg-green-600 text-white w-full py-2 rounded-xl">
                Done
            </button>

        </div>

    </div>

    <!-- Leaflet -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>

        let map;
        let startMarker;
        let endMarker;
        let mode = "start";

        function openMap() {

            document.getElementById('mapModal').classList.remove('hidden');

            if (!map) {

                map = L.map('map').setView([30.0444, 31.2357], 10);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                map.on('click', function (e) {
                    setPoint(e.latlng.lat, e.latlng.lng);
                });
            }

            map.invalidateSize();

            // load existing markers
            loadExisting();
        }

        function closeMap() {
            document.getElementById('mapModal').classList.add('hidden');
        }

        function setMode(m) {
            mode = m;
        }

        function setPoint(lat, lng) {

            if (mode === "start") {

                if (startMarker) map.removeLayer(startMarker);

                startMarker = L.marker([lat, lng]).addTo(map);

                document.getElementById('start_lat').value = lat;
                document.getElementById('start_lng').value = lng;

            } else {

                if (endMarker) map.removeLayer(endMarker);

                endMarker = L.marker([lat, lng]).addTo(map);

                document.getElementById('end_lat').value = lat;
                document.getElementById('end_lng').value = lng;
            }
        }

        function getMyLocation() {

            navigator.geolocation.getCurrentPosition(function (pos) {

                let lat = pos.coords.latitude;
                let lng = pos.coords.longitude;

                map.setView([lat, lng], 15);
                setPoint(lat, lng);

            });
        }

        function loadExisting() {

            let slat = document.getElementById('start_lat').value;
            let slng = document.getElementById('start_lng').value;

            let elat = document.getElementById('end_lat').value;
            let elng = document.getElementById('end_lng').value;

            if (slat && slng) {
                startMarker = L.marker([slat, slng]).addTo(map);
            }

            if (elat && elng) {
                endMarker = L.marker([elat, elng]).addTo(map);
            }
        }

    </script>

</x-app-layout>
