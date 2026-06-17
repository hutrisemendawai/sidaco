
<x-app-layout>
    <div class="py-2 scale-view">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 select-none">Dashboard</h1>
                <p class="text-sm font-semibold text-gray-500 mt-1">Plan, analyze, and oversee eel cultivation metrics across regions with ease.</p>
            </div>
            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('sidat.import') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-gray-205 text-slate-700 text-xs font-bold rounded-full hover:bg-slate-50 shadow-xs hover:shadow transition-all duration-200 select-none">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.24m0 0a2.242 2.242 0 002.242 2.246h13.516A2.242 2.242 0 0021 18.746V16.5m-3-4.5l-6 6m0 0l-6-6m6 6V3.75"></path></svg>
                        Import Data
                    </a>
                @endif
                <a href="{{ Auth::user()->isEnum() ? route('enum.sidat.create') : route('sidat.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-800 text-white text-xs font-bold rounded-full hover:bg-emerald-900 shadow-md shadow-emerald-800/10 hover:shadow-lg transition-all duration-200 select-none">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Add Data Record
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <div class="bg-gradient-to-br from-[#124d27] to-[#043314] text-white rounded-3xl p-6 shadow-md shadow-emerald-950/20 relative overflow-hidden flex flex-col justify-between h-40 group hover:shadow-lg hover:shadow-emerald-950/25 transition-all duration-300 pointer-events-none sm:pointer-events-auto">
                <div class="absolute -right-8 -bottom-8 w-28 h-24 bg-emerald-800/10 rounded-full group-hover:scale-110 transition-transform"></div>
                <div class="flex justify-between items-start z-10">
                    <span class="text-[10px] font-bold tracking-wider text-emerald-200/90 uppercase select-none">Total Entries</span>
                </div>
                <div class="mt-2 z-10">
                    <span class="text-4xl font-extrabold tracking-tight block leading-none">{{ number_format($totalEntries) }}</span>
                    <span class="text-[10px] text-emerald-200/80 font-bold tracking-wide flex items-center mt-3 select-none">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Continuous data accumulation
                    </span>
                </div>
            </div>

            <div class="bg-white text-slate-900 rounded-3xl p-6 shadow-xs border border-gray-100 relative overflow-hidden flex flex-col justify-between h-40 group hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase select-none">Total Weight ({{ now()->year }})</span>
                </div>
                <div class="mt-2">
                    <span class="text-3xl font-extrabold tracking-tight text-slate-900 block leading-none truncate">{{ number_format($totalWeightThisYear, 2) }} kg</span>
                    <span class="text-[10px] font-bold tracking-wide flex items-center mt-3 select-none">
                        <span class="bg-emerald-50 text-emerald-800 px-2 py-0.5 rounded-full border border-emerald-100 flex items-center shadow-2xs">
                            Weight This Year
                        </span>
                    </span>
                </div>
            </div>

            <div class="bg-white text-slate-900 rounded-3xl p-6 shadow-xs border border-gray-100 relative overflow-hidden flex flex-col justify-between h-40 group hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase select-none">Active Countries</span>
                </div>
                <div class="mt-2">
                    <span class="text-4xl font-extrabold tracking-tight text-slate-900 block leading-none">{{ $uniqueCountry }}</span>
                    <span class="text-[10px] font-bold tracking-wide flex items-center mt-3 select-none">
                        <span class="bg-emerald-50 text-emerald-800 px-2 py-0.5 rounded-full border border-emerald-100 flex items-center shadow-2xs">
                            Intergovernmental
                        </span>
                    </span>
                </div>
            </div>

            <div class="bg-white text-slate-900 rounded-3xl p-6 shadow-xs border border-gray-100 relative overflow-hidden flex flex-col justify-between h-40 group hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase select-none">Monitored Species</span>
                </div>
                <div class="mt-2">
                    <span class="text-4xl font-extrabold tracking-tight text-slate-900 block leading-none">{{ count($speciesLabels) }}</span>
                    <span class="text-[10px] font-bold tracking-wide flex items-center mt-3 select-none">
                        <span class="bg-teal-50 text-teal-800 px-2 py-0.5 rounded-full border border-teal-100 flex items-center shadow-2xs">
                            <svg class="w-3 h-3 mr-0.5 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Fully verified taxa
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div x-data="{ open: {{ $request->anyFilled(['year', 'month', 'country', 'province', 'species']) ? 'true' : 'false' }} }" class="bg-white overflow-hidden rounded-3xl shadow-xs border border-gray-100 mb-8 transition-all duration-300 hover:shadow-md hover:border-gray-200">
            <div class="p-6">
                <button @click="open = !open" class="flex items-center justify-between w-full text-md font-bold text-slate-900 focus:outline-none select-none">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4.5 h-4.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        <span>Filter Metrics Panel</span>
                    </div>
                    <div class="p-1 rounded-full bg-slate-50 border border-gray-150">
                        <svg class="w-4 h-4 transform transition-transform duration-350" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </button>
                
                <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-5 pt-5 border-t border-slate-50">
                    <form action="{{ route('dashboard') }}" method="GET">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                            <div>
                                <label for="year" class="block text-xs font-bold text-gray-400 tracking-wide uppercase mb-1.5">Harvest Year</label>
                                <select name="year" id="year" class="block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-xs font-medium py-2 px-3 shadow-2xs bg-slate-50/50">
                                    <option value="">All Years</option>
                                    @foreach($filterYears as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="month" class="block text-xs font-bold text-gray-400 tracking-wide uppercase mb-1.5">Harvest Month</label>
                                <select name="month" id="month" class="block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-xs font-medium py-2 px-3 shadow-2xs bg-slate-50/50">
                                    <option value="">All Months</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="country" class="block text-xs font-bold text-gray-400 tracking-wide uppercase mb-1.5">Country</label>
                                <select name="country" id="country" class="block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-xs font-medium py-2 px-3 shadow-2xs bg-slate-50/50">
                                    <option value="">All Countries</option>
                                    @foreach($filterCountries as $country)
                                        <option value="{{ $country }}" {{ $selectedCountry == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="province" class="block text-xs font-bold text-gray-400 tracking-wide uppercase mb-1.5">Province</label>
                                <select name="province" id="province" class="block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-xs font-medium py-2 px-3 shadow-2xs bg-slate-50/50">
                                    <option value="">All Provinces</option>
                                    @foreach($filterProvinces as $province)
                                        <option value="{{ $province }}" {{ $selectedProvince == $province ? 'selected' : '' }}>{{ $province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="species" class="block text-xs font-bold text-gray-400 tracking-wide uppercase mb-1.5">Taxa Species</label>
                                <select name="species" id="species" class="block w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-xs font-medium py-2 px-3 shadow-2xs bg-slate-50/50">
                                    <option value="">All Species</option>
                                    @foreach($filterSpecies as $species)
                                        <option value="{{ $species }}" {{ $selectedSpecies == $species ? 'selected' : '' }}>{{ $species }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-5 space-x-2.5">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-full border border-transparent transition-colors">
                                Reset Filters
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center px-5 py-2 bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-semibold rounded-full shadow-xs hover:shadow transition-all">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Total Weight Caught Per Year</h3>
                        <span class="text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-100 px-2 py-0.5 rounded-full select-none">Yearly Trend</span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-semibold mb-3 select-none">Historical record of catches in kilograms across all regions.</p>
                </div>
                <div class="h-48 relative">
                    <canvas id="yearlyCatchChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Total Weight Caught Per Month</h3>
                        <span class="text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-100 px-2 py-0.5 rounded-full select-none">Monthly Index</span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-semibold mb-3 select-none">Fluctuations and seasonal trends in eel harvest weight throughout the year.</p>
                </div>
                <div class="h-48 relative">
                    <canvas id="monthlyCatchChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Top 5 Species</h3>
                        <span class="text-[10px] font-bold bg-teal-50 text-teal-800 border border-teal-100 px-2 py-0.5 rounded-full select-none">Distribution</span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-semibold mb-3 select-none">Breakdown of the top five common eel taxons logged into the database.</p>
                </div>
                <div class="h-48 relative flex items-center justify-center">
                    <canvas id="speciesChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Data Entries by Country</h3>
                        <span class="text-[10px] font-bold bg-slate-50 text-slate-700 border border-gray-150 px-2 py-0.5 rounded-full select-none">Geographic Scope</span>
                    </div>
                </div>
                <div class="h-56 relative">
                    <canvas id="countryChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Data Entries by Province</h3>
                        <span class="text-[10px] font-bold bg-slate-50 text-slate-700 border border-gray-150 px-2 py-0.5 rounded-full select-none">Regional Level</span>
                    </div>
                </div>
                <div class="h-56 relative">
                    <canvas id="provinceChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Top 5 Fisher by Entries</h3>
                        <span class="text-[10px] font-bold bg-rose-50 text-rose-800 border border-rose-100 px-2 py-0.5 rounded-full select-none">Top Providers</span>
                    </div>
                </div>
                <div class="h-56 relative">
                    <canvas id="fishermanChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Total Catch Weight by Stage</h3>
                        <span class="text-[10px] font-bold bg-purple-50 text-purple-800 border border-purple-100 px-2 py-0.5 rounded-full select-none">Lifecycle Stage</span>
                    </div>
                </div>
                <div class="h-52 relative flex items-center justify-center">
                    <canvas id="stageChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Top 5 Rivers by Weight</h3>
                        <span class="text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-100 px-2 py-0.5 rounded-full select-none">Hydrological Zones</span>
                    </div>
                </div>
                <div class="h-56 relative">
                    <canvas id="riverChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between h-[340px]">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-sm font-bold tracking-tight text-slate-900 select-none">Top 5 Total of Fisher by Rivers</h3>
                        <span class="text-[10px] font-bold bg-indigo-50 text-indigo-800 border border-indigo-100 px-2 py-0.5 rounded-full select-none">Fisher Density</span>
                    </div>
                </div>
                <div class="h-56 relative">
                    <canvas id="totalOfFisherChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function() {
                if (typeof Chart === 'undefined') return;

                const gridConfig = {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', size: 10, weight: '600' }, color: '#94a3b8' }
                    },
                    y: {
                        grid: { color: '#f8fafc', drawTicks: false },
                        border: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', size: 10, weight: '600' }, color: '#94a3b8', padding: 8 }
                    }
                };

                const pointConfig = {
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#059669',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                };

                try {
                    const yearlyCtx = document.getElementById('yearlyCatchChart');
                    if (yearlyCtx) {
                        const yearlyCanvasCtx = yearlyCtx.getContext('2d');
                        const yearlyGradient = yearlyCanvasCtx.createLinearGradient(0, 0, 0, 180);
                        yearlyGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
                        yearlyGradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

                        new Chart(yearlyCanvasCtx, {
                            type: 'line',
                            data: {
                                labels: @json($yearlyCatchLabels),
                                datasets: [{
                                    label: 'Total Weight (kg)',
                                    data: @json($yearlyCatchData),
                                    backgroundColor: yearlyGradient,
                                    borderColor: '#059669',
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4,
                                    ...pointConfig
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: gridConfig,
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const monthlyCtx = document.getElementById('monthlyCatchChart');
                    if (monthlyCtx) {
                        const monthlyCanvasCtx = monthlyCtx.getContext('2d');
                        const monthlyGradient = monthlyCanvasCtx.createLinearGradient(0, 0, 0, 180);
                        monthlyGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
                        monthlyGradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

                        new Chart(monthlyCanvasCtx, {
                            type: 'line',
                            data: {
                                labels: @json($monthlyCatchLabels),
                                datasets: [{
                                    label: 'Total Weight (kg)',
                                    data: @json($monthlyCatchData),
                                    backgroundColor: monthlyGradient,
                                    borderColor: '#10b981',
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4,
                                    ...pointConfig
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: gridConfig,
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const speciesCtx = document.getElementById('speciesChart');
                    if (speciesCtx) {
                        new Chart(speciesCtx.getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: @json($speciesLabels),
                                datasets: [{
                                    label: 'Entries',
                                    data: @json($speciesCounts),
                                    backgroundColor: ['#044e29', '#0d9488', '#34d399', '#93c5fd', '#bae6fd'],
                                    borderWidth: 3,
                                    borderColor: '#ffffff',
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '65%',
                                plugins: {
                                    legend: { 
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 8,
                                            usePointStyle: true,
                                            padding: 12,
                                            font: { family: 'Plus Jakarta Sans', size: 10, weight: '700' },
                                            color: '#475569'
                                        }
                                    }
                                }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const countryCtx = document.getElementById('countryChart');
                    if (countryCtx) {
                        new Chart(countryCtx.getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: @json($countryLabels),
                                datasets: [{
                                    label: 'Number of Data Entries',
                                    data: @json($countryCounts),
                                    backgroundColor: '#10b981',
                                    borderRadius: 6,
                                    barThickness: 24,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: gridConfig,
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const provinceCtx = document.getElementById('provinceChart');
                    if (provinceCtx) {
                        new Chart(provinceCtx.getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: @json($provinceLabels),
                                datasets: [{
                                    label: 'Number of Data Entries',
                                    data: @json($provinceCounts),
                                    backgroundColor: '#34d399',
                                    borderRadius: 6,
                                    barThickness: 24,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: gridConfig,
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const fishermanCtx = document.getElementById('fishermanChart');
                    if (fishermanCtx) {
                        new Chart(fishermanCtx.getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: @json($fishermanLabels),
                                datasets: [{
                                    label: 'Number of Entries',
                                    data: @json($fishermanCounts),
                                    backgroundColor: '#f43f5e',
                                    borderRadius: 6,
                                    barThickness: 16,
                                }]
                            },
                            options: {
                                indexAxis: 'y',
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        grid: { color: '#f8fafc' },
                                        border: { display: false },
                                        ticks: { font: { family: 'Plus Jakarta Sans', size: 10, weight: '600' }, color: '#94a3b8' }
                                    },
                                    y: {
                                        grid: { display: false },
                                        border: { display: false },
                                        ticks: { font: { family: 'Plus Jakarta Sans', size: 10, weight: '700' }, color: '#475569' }
                                    }
                                },
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const stageCtx = document.getElementById('stageChart');
                    if (stageCtx) {
                        new Chart(stageCtx.getContext('2d'), {
                            type: 'pie',
                            data: {
                                labels: @json($stageLabels),
                                datasets: [{
                                    label: 'Total Weight (kg)',
                                    data: @json($stageWeights),
                                    backgroundColor: ['#f59e0b', '#d946ef', '#0d9488', '#ec4899', '#6366f1'],
                                    borderWidth: 1,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 8,
                                            usePointStyle: true,
                                            font: { family: 'Plus Jakarta Sans', size: 10, weight: '700' },
                                            color: '#475569'
                                        }
                                    }
                                }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const riverCtx = document.getElementById('riverChart');
                    if (riverCtx) {
                        new Chart(riverCtx.getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: @json($riverLabels),
                                datasets: [{
                                    label: 'Total Weight (kg)',
                                    data: @json($riverWeights),
                                    backgroundColor: '#8b5cf6',
                                    borderRadius: 6,
                                    barThickness: 20,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: gridConfig,
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}

                try {
                    const totalOfFisherCtx = document.getElementById('totalOfFisherChart');
                    if (totalOfFisherCtx) {
                        new Chart(totalOfFisherCtx.getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: @json($totalOfFisherLabels),
                                datasets: [{
                                    label: 'Total Of Fisher',
                                    data: @json($TotalOfFisherCounts),
                                    backgroundColor: '#6366f1',
                                    borderRadius: 6,
                                    barThickness: 20,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: gridConfig,
                                plugins: { legend: { display: false } }
                            }
                        });
                    }
                } catch (e) {}
            }, 50);
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#country').on('change', function () {
                var country = $(this).val();
                var provinceSelect = $('#province');
                provinceSelect.empty().append('<option value="">All Provinces</option>');

                if (country) {
                    $.ajax({
                        url: '{{ url("/get-provinces") }}/' + encodeURIComponent(country),
                        type: 'GET',
                        success: function (data) {
                            $.each(data, function (index, province) {
                                provinceSelect.append('<option value="' + province + '">' + province + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>

