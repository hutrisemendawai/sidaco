<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Sidat Data') }}
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

                                <!-- Type -->
                                <div class="mt-4">
                                    <x-input-label for="type" :value="__('Type')" />
                                    <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required />
                                </div>

                                <!-- Fisherman Name -->
                                <div class="mt-4">
                                    <x-input-label for="fisherman_name" :value="__('Fisherman Name')" />
                                    <x-text-input id="fisherman_name" class="block mt-1 w-full" type="text" name="fisherman_name" :value="old('fisherman_name')" required />
                                </div>

                                <!-- Type Of Fishing Gear -->
                                <div class="mt-4">
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

                                <!-- Total Weight (per Fisher) -->
                                <div class="mt-4">
                                    <x-input-label for="total_weight_per_fisher" :value="__('Total Weight (per Fisher)')" />
                                    <x-text-input id="total_weight_per_fisher" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_per_fisher" :value="old('total_weight_per_fisher')" required />
                                </div>

                                <!-- Estimate Number by Fisher (per Day) -->
                                <div class="mt-4">
                                    <x-input-label for="estimate_number_by_fisher_per_day" :value="__('Estimate Number by Fisher (per Day)')" />
                                    <x-text-input id="estimate_number_by_fisher_per_day" class="block mt-1 w-full" type="number" name="estimate_number_by_fisher_per_day" :value="old('estimate_number_by_fisher_per_day')" required />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div>
                                <!-- Elver -->
                                <h3 class="font-semibold text-lg text-gray-800 border-b pb-2 mb-4">Elver</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="total_weight_elver_kg" :value="__('Total Weight (kg)')" />
                                        <x-text-input id="total_weight_elver_kg" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_elver_kg" :value="old('total_weight_elver_kg')" />
                                    </div>
                                    <div>
                                        <x-input-label for="price_elver" :value="__('Price')" />
                                        <x-text-input id="price_elver" class="block mt-1 w-full" type="number" step="0.01" name="price_elver" :value="old('price_elver')" />
                                    </div>
                                    <div class="col-span-2">
                                        <x-input-label for="amount_individual_elver_size" :value="__('Amount of Individual Size')" />
                                        <x-text-input id="amount_individual_elver_size" class="block mt-1 w-full" type="number" name="amount_individual_elver_size" :value="old('amount_individual_elver_size')" />
                                    </div>
                                </div>

                                <!-- PK -->
                                <h3 class="font-semibold text-lg text-gray-800 border-b pb-2 my-4">PK</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="total_weight_pk_kg" :value="__('Total Weight (kg)')" />
                                        <x-text-input id="total_weight_pk_kg" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_pk_kg" :value="old('total_weight_pk_kg')" />
                                    </div>
                                    <div>
                                        <x-input-label for="price_pk" :value="__('Price')" />
                                        <x-text-input id="price_pk" class="block mt-1 w-full" type="number" step="0.01" name="price_pk" :value="old('price_pk')" />
                                    </div>
                                    <div class="col-span-2">
                                        <x-input-label for="amount_individual_pk_size" :value="__('Amount of Individual Size')" />
                                        <x-text-input id="amount_individual_pk_size" class="block mt-1 w-full" type="number" name="amount_individual_pk_size" :value="old('amount_individual_pk_size')" />
                                    </div>
                                </div>

                                <!-- PB -->
                                <h3 class="font-semibold text-lg text-gray-800 border-b pb-2 my-4">PB</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="total_weight_pb_kg" :value="__('Total Weight (kg)')" />
                                        <x-text-input id="total_weight_pb_kg" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_pb_kg" :value="old('total_weight_pb_kg')" />
                                    </div>
                                    <div>
                                        <x-input-label for="price_pb" :value="__('Price')" />
                                        <x-text-input id="price_pb" class="block mt-1 w-full" type="number" step="0.01" name="price_pb" :value="old('price_pb')" />
                                    </div>
                                    <div class="col-span-2">
                                        <x-input-label for="amount_individual_pb_size" :value="__('Amount of Individual Size')" />
                                        <x-text-input id="amount_individual_pb_size" class="block mt-1 w-full" type="number" name="amount_individual_pb_size" :value="old('amount_individual_pb_size')" />
                                    </div>
                                </div>

                                <!-- Fingerling -->
                                <h3 class="font-semibold text-lg text-gray-800 border-b pb-2 my-4">Fingerling</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="total_weight_fingerling" :value="__('Total Weight (kg)')" />
                                        <x-text-input id="total_weight_fingerling" class="block mt-1 w-full" type="number" step="0.01" name="total_weight_fingerling" :value="old('total_weight_fingerling')" />
                                    </div>
                                    <div>
                                        <x-input-label for="price_fingerling" :value="__('Price')" />
                                        <x-text-input id="price_fingerling" class="block mt-1 w-full" type="number" step="0.01" name="price_fingerling" :value="old('price_fingerling')" />
                                    </div>
                                    <div class="col-span-2">
                                        <x-input-label for="amount_individual_fingerling_size" :value="__('Amount of Individual Size')" />
                                        <x-text-input id="amount_individual_fingerling_size" class="block mt-1 w-full" type="number" name="amount_individual_fingerling_size" :value="old('amount_individual_fingerling_size')" />
                                    </div>
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

            
            const countryApiUrl = 'https:
            const provinceApiBaseUrl = 'https:

            
            
            
            const indonesiaOption = document.createElement('option');
            indonesiaOption.value = 'Indonesia';
            indonesiaOption.textContent = 'Indonesia';
            indonesiaOption.selected = true; 
            countrySelect.appendChild(indonesiaOption);
            
            
            function fetchProvinces() {
                fetch(countryApiUrl)
                    .then(response => response.json())
                    .then(provinces => {
                        provinceSelect.innerHTML = '<option value="">Select Province</option>';
                        provinces.forEach(province => {
                            const option = document.createElement('option');
                            option.value = province.name;
                            option.dataset.id = province.id;
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

                fetch(`${provinceApiBaseUrl}${provinceId}.json`)
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
