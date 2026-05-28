<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">
            Create Trip Request
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-3xl shadow-xl p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Trip Request Details
                </h3>

                <form action="{{ route('trip-requests.store') }}" method="POST">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-4 mb-4">

                        <input type="text" id="start_address" name="start_address"
                               placeholder="Start Address"
                               class="p-3 border rounded-2xl">

                        <input type="text" id="end_address" name="end_address"
                               placeholder="End Address"
                               class="p-3 border rounded-2xl">

                    </div>

                    <!-- hidden coords -->
                    <input type="hidden" id="start_lat" name="start_lat">
                    <input type="hidden" id="start_lng" name="start_lng">
                    <input type="hidden" id="end_lat" name="end_lat">
                    <input type="hidden" id="end_lng" name="end_lng">

                    <!-- open map -->
                    <button type="button"
                            onclick="openMap()"
                            class="bg-blue-600 text-white px-4 py-2 rounded-xl mb-4">
                        📍 Open Map
                    </button>

                    <input type="number" name="requested_seats"
                           value="1"
                           class="w-full p-3 border rounded-2xl mb-4">

                    <button class="bg-black text-white w-full py-3 rounded-2xl">
                        Save Request
                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- MAP MODAL -->
    <div id="mapModal"
         class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center">

        <div class="bg-white p-4 rounded-2xl w-[95%] max-w-3xl">

            <div class="flex justify-between mb-3">
                <h2 class="font-bold">Select Location</h2>
                <button onclick="closeMap()">❌</button>
            </div>

            <!-- MODE BUTTONS -->
            <div class="flex gap-2 mb-3">

                <button onclick="openSearch('start')"
                        class="bg-green-600 text-white px-3 py-2 rounded-xl w-full">
                    🔍 Start
                </button>

                <button onclick="openSearch('end')"
                        class="bg-black text-white px-3 py-2 rounded-xl w-full">
                    🔍 End
                </button>

                <button onclick="getMyLocation()"
                        class="bg-blue-600 text-white px-3 py-2 rounded-xl w-full">
                    📍 My Location
                </button>

            </div>

            <div id="map" style="height: 420px;"></div>

            <button onclick="closeMap()"
                    class="mt-3 bg-green-600 text-white w-full py-2 rounded-xl">
                Done
            </button>

        </div>

    </div>

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
            }

            map.invalidateSize();
        }

        function closeMap() {
            document.getElementById('mapModal').classList.add('hidden');
        }

        // 🔥 NEW: POPUP SEARCH (Uber style)
        async function openSearch(type) {

            let query = prompt("Enter location name:");
            if (!query) return;

            let res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`);
            let data = await res.json();

            if (!data.length) {
                alert("No results found");
                return;
            }

            let place = data[0];

            map.setView([place.lat, place.lon], 15);

            setPoint(place.lat, place.lon, type);
        }

        function setPoint(lat, lng, type) {

            if (type === "start") {

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

                setPoint(lat, lng, mode);

            });
        }

    </script>

</x-app-layout>
