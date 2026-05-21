<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Review & Edit Pending Data') }}
            </h2>
            <a href="{{ route('admin.approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                ← Back to Approvals
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Requester info banner --}}
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center gap-4">
                <img src="{{ $sidat->user->avatarUrl() }}" alt="Avatar" class="h-12 w-12 rounded-full object-cover border" />
                <div>
                    <p class="text-sm font-semibold text-blue-800">Submitted by: {{ $sidat->user->first_name }} {{ $sidat->user->last_name }}</p>
                    <p class="text-xs text-blue-600">{{ $sidat->user->email }} &mdash; Submitted on {{ $sidat->created_at->format('d M Y, H:i') }}</p>
                    @if($sidat->updatedBy)
                        <p class="text-xs text-blue-500 mt-1">Last edited by: {{ $sidat->updatedBy->first_name }} {{ $sidat->updatedBy->last_name }} on {{ $sidat->updated_at->format('d M Y, H:i') }}</p>
                    @endif
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.approvals.update', $sidat->id) }}" id="approval-form">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div>
                                <div>
                                    <x-input-label for="date" :value="__('Date')" />
                                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', $sidat->date->format('Y-m-d'))" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="country" :value="__('Country')" />
                                    <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Country</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="province" :value="__('Province')" />
                                    <select id="province" name="province" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Province</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="regency" :value="__('Regency/City')" />
                                    <select id="regency" name="regency" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Regency/City</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="district" :value="__('District')" />
                                    <select id="district" name="district" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="river" :value="__('River')" />
                                    <x-text-input id="river" list="river-options" class="block mt-1 w-full" type="text" name="river" :value="old('river', $sidat->river)" required />
                                    <datalist id="river-options">
                                        @foreach($rivers as $riverName)
                                            <option value="{{ $riverName }}">
                                        @endforeach
                                    </datalist>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="stage" :value="__('Stage')" />
                                    <x-text-input id="stage" class="block mt-1 w-full" type="text" name="stage" :value="old('stage', $sidat->stage)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="fisher_name" :value="__('Fisher Name')" />
                                    <x-text-input id="fisher_name" class="block mt-1 w-full" type="text" name="fisher_name" :value="old('fisher_name', $sidat->fisher_name)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="number_of_fisher" :value="__('Number of Fisher')" />
                                    <x-text-input id="number_of_fisher" class="block mt-1 w-full" type="number" name="number_of_fisher" :value="old('number_of_fisher', $sidat->number_of_fisher)" required />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div>
                                <div>
                                    <x-input-label for="type_of_fishing_gear" :value="__('Type of Fishing Gear')" />
                                    <x-text-input id="type_of_fishing_gear" class="block mt-1 w-full" type="text" name="type_of_fishing_gear" :value="old('type_of_fishing_gear', $sidat->type_of_fishing_gear)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="number_of_fishing_gear" :value="__('Number of Fishing Gear')" />
                                    <x-text-input id="number_of_fishing_gear" class="block mt-1 w-full" type="number" name="number_of_fishing_gear" :value="old('number_of_fishing_gear', $sidat->number_of_fishing_gear)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="species_name" :value="__('Species Name')" />
                                    <x-text-input id="species_name" class="block mt-1 w-full" type="text" name="species_name" :value="old('species_name', $sidat->species_name)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="operation_time" :value="__('Operation Time (hours/day)')" />
                                    <x-text-input id="operation_time" class="block mt-1 w-full" type="number" step="0.1" name="operation_time" :value="old('operation_time', $sidat->operation_time)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="total_weight_per_day" :value="__('Total Weight (kg/day)')" />
                                    <x-text-input id="total_weight_per_day" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_per_day" :value="old('total_weight_per_day', $sidat->total_weight_per_day)" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="price_per_kg" :value="__('Price (per kg)')" />
                                    <x-text-input id="price_per_kg" class="block mt-1 w-full" type="number" step="0.01" name="price_per_kg" :value="old('price_per_kg', $sidat->price_per_kg)" required />
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center gap-3">
                                {{-- Approve & Save --}}
                                <button type="submit" name="approve" value="1"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                    ✓ Save &amp; Approve
                                </button>

                                {{-- Save Only --}}
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Save Changes
                                </button>
                            </div>

                            <div class="flex items-center gap-3">
                                {{-- Reject --}}
                                <form method="POST" action="{{ route('admin.approvals.reject', $sidat->id) }}"
                                    onsubmit="return confirm('Reject and permanently delete this data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                        ✕ Reject &amp; Delete
                                    </button>
                                </form>

                                <a href="{{ route('admin.approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('country');
    const provinceSelect = document.getElementById('province');
    const regencySelect = document.getElementById('regency');
    const districtSelect = document.getElementById('district');

    const existingData = {
        country: "{{ old('country', $sidat->country) }}",
        province: "{{ old('province', $sidat->province) }}",
        regency: "{{ old('regency', $sidat->regency) }}",
        district: "{{ old('district', $sidat->district) }}"
    };

    const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const regencyApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';
    const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/';

    const indonesiaOption = document.createElement('option');
    indonesiaOption.value = 'Indonesia';
    indonesiaOption.textContent = 'Indonesia';
    countrySelect.appendChild(indonesiaOption);
    countrySelect.value = existingData.country || 'Indonesia';

    async function fetchProvinces() {
        const response = await fetch(provinceApiUrl);
        const provinces = await response.json();
        provinceSelect.innerHTML = '<option value="">Select Province</option>';
        provinces.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.name; opt.dataset.id = p.id; opt.textContent = p.name;
            if (p.name === existingData.province) opt.selected = true;
            provinceSelect.appendChild(opt);
        });
        const sel = provinceSelect.options[provinceSelect.selectedIndex];
        return sel ? sel.dataset.id : null;
    }

    async function fetchRegencies(provinceId) {
        if (!provinceId) return null;
        const response = await fetch(`${regencyApiBaseUrl}${provinceId}.json`);
        const regencies = await response.json();
        regencySelect.innerHTML = '<option value="">Select Regency/City</option>';
        regencies.forEach(r => {
            const opt = document.createElement('option');
            opt.value = r.name; opt.dataset.id = r.id; opt.textContent = r.name;
            if (r.name === existingData.regency) opt.selected = true;
            regencySelect.appendChild(opt);
        });
        const sel = regencySelect.options[regencySelect.selectedIndex];
        return sel ? sel.dataset.id : null;
    }

    async function fetchDistricts(regencyId) {
        if (!regencyId) return;
        const response = await fetch(`${districtApiBaseUrl}${regencyId}.json`);
        const districts = await response.json();
        districtSelect.innerHTML = '<option value="">Select District</option>';
        districts.forEach(d => {
            const opt = document.createElement('option');
            opt.value = d.name; opt.textContent = d.name;
            if (d.name === existingData.district) opt.selected = true;
            districtSelect.appendChild(opt);
        });
    }

    provinceSelect.addEventListener('change', async () => {
        const sel = provinceSelect.options[provinceSelect.selectedIndex];
        const id = await fetchRegencies(sel ? sel.dataset.id : null);
        if (id) fetchDistricts(id);
    });
    regencySelect.addEventListener('change', () => {
        const sel = regencySelect.options[regencySelect.selectedIndex];
        if (sel && sel.dataset.id) fetchDistricts(sel.dataset.id);
    });

    (async () => {
        const provId = await fetchProvinces();
        if (provId) {
            const regId = await fetchRegencies(provId);
            if (regId) await fetchDistricts(regId);
        }
    })();
});
</script>
</x-app-layout>
