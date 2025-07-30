<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Tropical Anguillid Eel Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
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

                    <form method="POST" action="{{ route('sidat.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div>
                                <!-- Date -->
                                <div>
                                    <x-input-label for="date" :value="__('Date')" />
                                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                </div>

                                <!-- Country -->
                                <div class="mt-4">
                                    <x-input-label for="country" :value="__('Country')" />
                                    <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Country</option>
                                    </select>
                                </div>

                                <!-- Province -->
                                <div class="mt-4">
                                    <x-input-label for="province" :value="__('Province')" />
                                    <select id="province" name="province" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Province</option>
                                    </select>
                                </div>

                                <!-- District -->
                                <div class="mt-4">
                                    <x-input-label for="district" :value="__('District/City')" />
                                    <select id="district" name="district" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select District/City</option>
                                    </select>
                                </div>

                                <!-- River -->
                                <div class="mt-4">
                                    <x-input-label for="river" :value="__('River')" />
                                    <x-text-input id="river" list="river-options" class="block mt-1 w-full" type="text" name="river" :value="old('river')" required placeholder="Type or select a river" />
                                    <datalist id="river-options">
                                        @foreach($rivers as $riverName)
                                            <option value="{{ $riverName }}">
                                        @endforeach
                                    </datalist>
                                </div>

                                <!-- Stage -->
                                <div class="mt-4">
                                    <x-input-label for="stage" :value="__('Stage')" />
                                    <x-text-input id="stage" class="block mt-1 w-full" type="text" name="stage" :value="old('stage')" required />
                                </div>

                                <!-- Fisherman Name -->
                                <div class="mt-4">
                                    <x-input-label for="fisher_name" :value="__('Fisher Name')" />
                                    <x-text-input id="fisher_name" class="block mt-1 w-full" type="text" name="fisher_name" :value="old('fisher_name')" required />
                                </div>
                            </div>
                            <div>
                                <!-- Type Of Fishing Gear -->
                                <div>
                                    <x-input-label for="type_of_fishing_gear" :value="__('Type Of Fishing Gear')" />
                                    <x-text-input id="type_of_fishing_gear" class="block mt-1 w-full" type="text" name="type_of_fishing_gear" :value="old('type_of_fishing_gear')" required />
                                </div>

                                <!-- Number of Fishing Gear -->
                                <div class="mt-4">
                                    <x-input-label for="number_of_fishing_gear" :value="__('Number of Fishing Gear')" />
                                    <x-text-input id="number_of_fishing_gear" class="block mt-1 w-full" type="number" name="number_of_fishing_gear" :value="old('number_of_fishing_gear')" required />
                                </div>

                                <!-- Species Name -->
                                <div class="mt-4">
                                    <x-input-label for="species_name" :value="__('Species Name')" />
                                    <x-text-input id="species_name" class="block mt-1 w-full" type="text" name="species_name" :value="old('species_name')" required />
                                </div>

                                <!-- Operation Time -->
                                <div class="mt-4">
                                    <x-input-label for="operation_time" :value="__('Operation Time (hours per day)')" />
                                    <x-text-input id="operation_time" class="block mt-1 w-full" type="number" step="0.1" name="operation_time" :value="old('operation_time')" required />
                                </div>

                                <!-- Total Weight (Kg/day) -->
                                <div class="mt-4">
                                    <x-input-label for="total_weight_per_day" :value="__('Total Weight (Kg/day)')" />
                                    <x-text-input id="total_weight_per_day" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_per_day" :value="old('total_weight_per_day')" required />
                                </div>

                                <!-- Price (per kg) -->
                                <div class="mt-4">
                                    <x-input-label for="price_per_kg" :value="__('Price (per kg)')" />
                                    <x-text-input id="price_per_kg" class="block mt-1 w-full" type="number" step="0.01" name="price_per_kg" :value="old('price_per_kg')" required />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>

                            <x-primary-button>
                                {{ __('Save Data') }}
                            </x-primary-button>
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
    const districtSelect = document.getElementById('district');

    const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';

    // Isi country manual karena hanya Indonesia
    const indonesiaOption = document.createElement('option');
    indonesiaOption.value = 'Indonesia';
    indonesiaOption.textContent = 'Indonesia';
    indonesiaOption.selected = true;
    countrySelect.appendChild(indonesiaOption);

    function fetchProvinces() {
        fetch(provinceApiUrl)
            .then(response => response.json())
            .then(provinces => {
                provinceSelect.innerHTML = '<option value="">Select Province</option>';
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.name;
                    option.dataset.id = province.id; // simpan ID untuk fetch kabupaten/kota
                    option.textContent = province.name;
                    provinceSelect.appendChild(option);
                });

                const southSumatra = Array.from(provinceSelect.options).find(opt => opt.value === 'SUMATERA SELATAN');
                if (southSumatra) {
                    southSumatra.selected = true;
                    fetchDistricts();
                }
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }

    function fetchDistricts() {
        const selectedProvince = provinceSelect.options[provinceSelect.selectedIndex];
        const provinceId = selectedProvince.dataset.id;
        districtSelect.innerHTML = '<option value="">Loading...</option>';

        if (!provinceId) {
            districtSelect.innerHTML = '<option value="">Select Province First</option>';
            return;
        }

        fetch(`${districtApiBaseUrl}${provinceId}.json`)
            .then(response => response.json())
            .then(districts => {
                districtSelect.innerHTML = '<option value="">Select District/City</option>';
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });

                const palembang = Array.from(districtSelect.options).find(opt => opt.value === 'KOTA PALEMBANG');
                if (palembang) {
                    palembang.selected = true;
                }
            })
            .catch(error => {
                console.error('Error fetching districts:', error);
                districtSelect.innerHTML = '<option value="">Failed to load districts</option>';
            });
    }

    provinceSelect.addEventListener('change', fetchDistricts);
    fetchProvinces();
});
</script>

</x-app-layout>
