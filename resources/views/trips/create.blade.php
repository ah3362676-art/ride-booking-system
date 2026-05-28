<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Create New Trip
        </h2>
    </x-slot>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-xl p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Trip Details
                </h3>

                <form action="{{ route('trips.store') }}" method="POST">

                    @csrf

                    <!-- Vehicle -->
                    <select name="vehicle_id" class="w-full p-3 border rounded-2xl mb-4">
                        <option value="">Select Vehicle</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">
                                {{ $vehicle->brand }} - {{ $vehicle->model }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Addresses -->
                    <div class="grid md:grid-cols-2 gap-4 mb-4">

                        <input type="text" id="start_address" name="start_address"
                               placeholder="Start Address"
                               class="p-3 border rounded-2xl">

                        <input type="text" id="end_address" name="end_address"
                               placeholder="End Address"
                               class="p-3 border rounded-2xl">

                    </div>

                    <!-- HIDDEN COORDINATES -->
                    <input type="hidden" id="start_lat" name="start_lat">
                    <input type="hidden" id="start_lng" name="start_lng">
                    <input type="hidden" id="end_lat" name="end_lat">
                    <input type="hidden" id="end_lng" name="end_lng">

                    <!-- Open Map Button -->
                    <button type="button"
                        onclick="openMap()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-xl mb-4">
                        📍 Select Location From Map
                    </button>

                    <!-- Trip Data -->
                    <input type="datetime-local" name="departure_time"
                           class="w-full p-3 border rounded-2xl mb-4">

                    <div class="grid md:grid-cols-2 gap-4 mb-4">

                        <input type="number" name="available_seats"
                               placeholder="Seats"
                               class="p-3 border rounded-2xl">

                        <input type="number" step="0.01" name="price_per_seat"
                               placeholder="Price"
                               class="p-3 border rounded-2xl">

                    </div>

                    <textarea name="notes"
                              class="w-full p-3 border rounded-2xl mb-4"
                              rows="3"
                              placeholder="Notes"></textarea>

                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-3 rounded-2xl w-full">
                        Create Trip
                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    <div id="mapModal"
         class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center">

        <div class="bg-white p-4 rounded-2xl w-[95%] max-w-3xl">

            <div class="flex justify-between items-center mb-3">
                <h2 class="font-bold">Select Location</h2>
                <button onclick="closeMap()">❌</button>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2 mb-3">

                <button type="button" onclick="getMyLocation()"
                    class="bg-blue-600 text-white px-3 py-2 rounded-xl w-full">
                    📍 My Location
                </button>

                <button type="button" onclick="searchStart()"
                    class="bg-green-600 text-white px-3 py-2 rounded-xl w-full">
                    🔍 Start
                </button>

                <button type="button" onclick="searchEnd()"
                    class="bg-black text-white px-3 py-2 rounded-xl w-full">
                    🔍 End
                </button>

            </div>

            <!-- Map -->
            <div id="map" style="height: 420px;" class="rounded-xl"></div>

            <button onclick="closeMap()"
                class="mt-3 bg-green-600 text-white px-4 py-2 rounded-xl w-full">
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

                map = L.map('map');

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                map.on('click', function (e) {
                    setPoint(e.latlng.lat, e.latlng.lng);
                });
            }

            map.invalidateSize();
        }

        function closeMap() {
            document.getElementById('mapModal').classList.add('hidden');
        }

        function setPoint(lat, lng) {

            if (mode === "start") {

                if (startMarker) map.removeLayer(startMarker);

                startMarker = L.marker([lat, lng]).addTo(map);

                document.getElementById('start_lat').value = lat;
                document.getElementById('start_lng').value = lng;

                mode = "end";

            } else {

                if (endMarker) map.removeLayer(endMarker);

                endMarker = L.marker([lat, lng]).addTo(map);

                document.getElementById('end_lat').value = lat;
                document.getElementById('end_lng').value = lng;

                mode = "start";
            }
        }

        // My Location
        function getMyLocation() {

            navigator.geolocation.getCurrentPosition(function (pos) {

                let lat = pos.coords.latitude;
                let lng = pos.coords.longitude;

                map.setView([lat, lng], 15);
                setPoint(lat, lng);

            });
        }

        // Search Start
        function searchStart() {

            let q = prompt("Enter START location:");
            if (!q) return;

            searchLocation(q, "start");
        }

        // Search End
        function searchEnd() {

            let q = prompt("Enter END location:");
            if (!q) return;

            searchLocation(q, "end");
        }

        async function searchLocation(query, type) {

            let res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`);
            let data = await res.json();

            if (!data.length) {
                alert("No results found");
                return;
            }

            let place = data[0];

            map.setView([place.lat, place.lon], 15);

            if (type === "start") {

                if (startMarker) map.removeLayer(startMarker);

                startMarker = L.marker([place.lat, place.lon]).addTo(map);

                document.getElementById('start_lat').value = place.lat;
                document.getElementById('start_lng').value = place.lon;

            } else {

                if (endMarker) map.removeLayer(endMarker);

                endMarker = L.marker([place.lat, place.lon]).addTo(map);

                document.getElementById('end_lat').value = place.lat;
                document.getElementById('end_lng').value = place.lon;
            }
        }

    </script>

</x-app-layout>
