<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter Section --}}
            <div x-data="{ open: {{ $request->anyFilled(['year', 'month', 'province', 'species']) ? 'true' : 'false' }} }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-lg font-medium text-gray-900 focus:outline-none">
                        <span>Filters</span>
                        <svg class="w-6 h-6 transform transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition class="mt-4">
                        <form action="{{ route('dashboard') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                                <div><label for="year" class="block text-sm font-medium text-gray-700">Year</label><select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">All Years</option>@foreach($filterYears as $year)<option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>@endforeach</select></div>
                                <div><label for="month" class="block text-sm font-medium text-gray-700">Month</label><select name="month" id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">All Months</option>@for ($i = 1; $i <= 12; $i++)<option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>@endfor</select></div>
                                <div><label for="province" class="block text-sm font-medium text-gray-700">Province</label><select name="province" id="province" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">All Provinces</option>@foreach($filterProvinces as $province)<option value="{{ $province }}" {{ $selectedProvince == $province ? 'selected' : '' }}>{{ $province }}</option>@endforeach</select></div>
                                <div><label for="species" class="block text-sm font-medium text-gray-700">Species</label><select name="species" id="species" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><option value="">All Species</option>@foreach($filterSpecies as $species)<option value="{{ $species }}" {{ $selectedSpecies == $species ? 'selected' : '' }}>{{ $species }}</option>@endforeach</select></div>
                                <div class="flex items-end space-x-2"><button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Filter</button><a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-400">Reset</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- NEW: Animated Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Entries -->
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                    <div>
                        <div class="text-gray-500 text-sm">Total Entries</div>
                        <div x-data="{ count: 0 }" x-init="() => { let final = {{ $totalEntries }}; let start = 0; let duration = 1500; let step = Math.ceil(final / (duration / 16)); setInterval(() => { start += step; if (start >= final) { count = final; return; } count = start; }, 16); }" class="text-2xl font-bold text-gray-900" x-text="count"></div>
                    </div>
                </div>
                <!-- Total Weight This Year -->
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-green-100 p-3 rounded-full"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg></div>
                    <div>
                        <div class="text-gray-500 text-sm">Total Weight ({{ now()->year }})</div>
                        <div x-data="{ count: 0 }" x-init="() => { let final = {{ round($totalWeightThisYear, 2) }}; let start = 0; let duration = 1500; let step = final / (duration / 16); setInterval(() => { start += step; if (start >= final) { count = final.toFixed(2); return; } count = start.toFixed(2); }, 16); }" class="text-2xl font-bold text-gray-900" x-text="count + ' kg'"></div>
                    </div>
                </div>
                <!-- Unique Fishermen -->
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center space-x-4">
                    <div class="bg-yellow-100 p-3 rounded-full"><svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                    <div>
                        <div class="text-gray-500 text-sm">Unique Fishermen</div>
                        <div x-data="{ count: 0 }" x-init="() => { let final = {{ $uniqueFishermen }}; let start = 0; let duration = 1500; let step = Math.ceil(final / (duration / 16)); setInterval(() => { start += step; if (start >= final) { count = final; return; } count = start; }, 16); }" class="text-2xl font-bold text-gray-900" x-text="count"></div>
                    </div>
                </div>
            </div>


            {{-- Main Grid for Charts --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Chart Cards --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><h3 class="text-lg font-medium text-gray-900 mb-4">Total Weight Caught Per Month (kg)</h3><div class="h-64"><canvas id="monthlyCatchChart"></canvas></div></div></div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><h3 class="text-lg font-medium text-gray-900 mb-4">Top 5 Species</h3><div class="h-64"><canvas id="speciesChart"></canvas></div></div></div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><h3 class="text-lg font-medium text-gray-900 mb-4">Data Entries by Province</h3><div class="h-64"><canvas id="provinceChart"></canvas></div></div></div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><h3 class="text-lg font-medium text-gray-900 mb-4">Top 5 Fishermen by Entries</h3><div class="h-64"><canvas id="fishermanChart"></canvas></div></div></div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><h3 class="text-lg font-medium text-gray-900 mb-4">Total Catch Weight by Stage</h3><div class="h-64"><canvas id="stageChart"></canvas></div></div></div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><h3 class="text-lg font-medium text-gray-900 mb-4">Top 5 Rivers by Weight (kg)</h3><div class="h-64"><canvas id="riverChart"></canvas></div></div></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const monthlyCtx = document.getElementById('monthlyCatchChart').getContext('2d'); new Chart(monthlyCtx, { type: 'line', data: { labels: @json($monthlyCatchLabels), datasets: [{ label: 'Total Weight (kg)', data: @json($monthlyCatchData), backgroundColor: 'rgba(59, 130, 246, 0.2)', borderColor: 'rgba(59, 130, 246, 1)', borderWidth: 2, fill: true, tension: 0.4 }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } } });
            const speciesCtx = document.getElementById('speciesChart').getContext('2d'); new Chart(speciesCtx, { type: 'doughnut', data: { labels: @json($speciesLabels), datasets: [{ label: 'Entries', data: @json($speciesCounts), backgroundColor: ['rgba(59, 130, 246, 0.7)', 'rgba(34, 197, 94, 0.7)', 'rgba(239, 68, 68, 0.7)', 'rgba(249, 115, 22, 0.7)', 'rgba(168, 85, 247, 0.7)'], }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } } } });
            const provinceCtx = document.getElementById('provinceChart').getContext('2d'); new Chart(provinceCtx, { type: 'bar', data: { labels: @json($provinceLabels), datasets: [{ label: 'Number of Data Entries', data: @json($provinceCounts), backgroundColor: 'rgba(22, 163, 74, 0.5)', borderColor: 'rgba(22, 163, 74, 1)', borderWidth: 1 }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }, plugins: { legend: { display: false } } } });
            const fishermanCtx = document.getElementById('fishermanChart').getContext('2d'); new Chart(fishermanCtx, { type: 'bar', data: { labels: @json($fishermanLabels), datasets: [{ label: 'Number of Entries', data: @json($fishermanCounts), backgroundColor: 'rgba(239, 68, 68, 0.5)', borderColor: 'rgba(239, 68, 68, 1)', borderWidth: 1 }] }, options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }, plugins: { legend: { display: false } } } });
            const stageCtx = document.getElementById('stageChart').getContext('2d'); new Chart(stageCtx, { type: 'pie', data: { labels: @json($stageLabels), datasets: [{ label: 'Total Weight (kg)', data: @json($stageWeights), backgroundColor: ['rgba(249, 115, 22, 0.7)', 'rgba(217, 70, 239, 0.7)', 'rgba(13, 148, 136, 0.7)', 'rgba(219, 39, 119, 0.7)'], }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } } } });
            const riverCtx = document.getElementById('riverChart').getContext('2d'); new Chart(riverCtx, { type: 'bar', data: { labels: @json($riverLabels), datasets: [{ label: 'Total Weight (kg)', data: @json($riverWeights), backgroundColor: 'rgba(168, 85, 247, 0.5)', borderColor: 'rgba(168, 85, 247, 1)', borderWidth: 1 }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } } });
        });
    </script>
</x-app-layout>
