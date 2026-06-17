<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Create Enumerator Account') }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">{{ __('Generate new enumerator accounts for data collectors') }}</p>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8 bg-white">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-8 p-6 bg-green-50 border-l-4 border-green-500 rounded-lg">
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="font-semibold text-green-800 text-lg">{{ __('Success!') }}</h3>
                            </div>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Enumerator Account Section -->
                    <div class="border-b-2 border-gray-100 pb-8">
                        <div class="flex items-center mb-8">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ __('Generate Enumerator Account') }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ __('Automatically create accounts with unique credentials for data collectors') }}</p>
                            </div>
                        </div>

                    <form method="POST" action="{{ route('admin.enumerator.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- General Data Section -->
                        <div class="border-b-2 border-gray-100 pb-8">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-xl font-bold text-gray-800">{{ __('General Data') }}</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Date -->
                                <div>
                                    <x-input-label for="date" :value="__('Date')" />
                                    <x-text-input id="date" class="block mt-2 w-full py-2.5" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                </div>

                                <!-- Country -->
                                <div>
                                    <x-input-label for="country" :value="__('Country')" />
                                    <select id="country" name="country" class="block mt-2 w-full py-2.5 px-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-700" required>
                                        <option value="">Select Country</option>
                                    </select>
                                </div>

                                <!-- Province -->
                                <div>
                                    <x-input-label for="province" :value="__('Province')" />
                                    <select id="province" name="province" class="block mt-2 w-full py-2.5 px-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-700" required>
                                        <option value="">Select Province</option>
                                    </select>
                                </div>

                                <!-- Regency/City -->
                                <div>
                                    <x-input-label for="regency" :value="__('Regency/City')" />
                                    <select id="regency" name="regency" class="block mt-2 w-full py-2.5 px-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-700" required>
                                        <option value="">Select Regency/City</option>
                                    </select>
                                </div>

                                <!-- District -->
                                <div>
                                    <x-input-label for="district" :value="__('District')" />
                                    <select id="district" name="district" class="block mt-2 w-full py-2.5 px-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-700" required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>

                                <!-- River -->
                                <div>
                                    <x-input-label for="river" :value="__('River')" />
                                    <x-text-input id="river" class="block mt-2 w-full py-2.5" type="text" name="river" :value="old('river')" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                                <!-- Stage -->
                                <div>
                                    <x-input-label for="stage" :value="__('Stage')" />
                                    <x-text-input id="stage" class="block mt-2 w-full py-2.5" type="text" name="stage" :value="old('stage')" required />
                                </div>

                                <!-- Fisherman Name -->
                                <div>
                                    <x-input-label for="fisher_name" :value="__('Fisher Name')" />
                                    <x-text-input id="fisher_name" class="block mt-2 w-full py-2.5" type="text" name="fisher_name" :value="old('fisher_name')" required />
                                </div>

                                <!-- Number of Fisher -->
                                <div>
                                    <x-input-label for="number_of_fisher" :value="__('Number Of Fisher')" />
                                    <x-text-input id="number_of_fisher" class="block mt-2 w-full py-2.5" type="number" name="number_of_fisher" :value="old('number_of_fisher')" required />
                                </div>

                                <!-- Type Of Fishing Gear -->
                                <div>
                                    <x-input-label for="type_of_fishing_gear" :value="__('Type Of Fishing Gear')" />
                                    <x-text-input id="type_of_fishing_gear" class="block mt-2 w-full py-2.5" type="text" name="type_of_fishing_gear" :value="old('type_of_fishing_gear')" required />
                                </div>

                                <!-- Number of Fishing Gear -->
                                <div>
                                    <x-input-label for="number_of_fishing_gear" :value="__('Number of Fishing Gear')" />
                                    <x-text-input id="number_of_fishing_gear" class="block mt-2 w-full py-2.5" type="number" name="number_of_fishing_gear" :value="old('number_of_fishing_gear')" required />
                                </div>

                                <!-- Species Name -->
                                <div>
                                    <x-input-label for="species_name" :value="__('Species Name')" />
                                    <x-text-input id="species_name" class="block mt-2 w-full py-2.5" type="text" name="species_name" :value="old('species_name')" required />
                                </div>

                                <!-- Operation Time -->
                                <div>
                                    <x-input-label for="operation_time" :value="__('Operation Time (hours/day)')" />
                                    <x-text-input id="operation_time" class="block mt-2 w-full py-2.5" type="number" name="operation_time" step="0.1" :value="old('operation_time')" required />
                                </div>

                                <!-- Total Weight -->
                                <div>
                                    <x-input-label for="total_weight" :value="__('Total Weight (kg)')" />
                                    <x-text-input id="total_weight" class="block mt-2 w-full py-2.5" type="number" name="total_weight" step="0.01" :value="old('total_weight')" required />
                                </div>

                                <!-- Price per kg -->
                                <div>
                                    <x-input-label for="price_per_kg" :value="__('Price per kg (IDR)')" />
                                    <x-text-input id="price_per_kg" class="block mt-2 w-full py-2.5" type="number" name="price_per_kg" step="0.01" :value="old('price_per_kg')" required />
                                </div>
                            </div>
                        </div>

                        <!-- Water Quality Section -->
                        <div class="border-b-2 border-gray-100 pb-8">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m6.364 1.636l-.707-.707M21 12h-1m1.364 6.364l-.707.707M12 21v1m-6.364-1.636l.707.707M3 12h1M4.22 4.22l.707.707"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-xl font-bold text-gray-800">{{ __('Water Quality & Fish Data') }}</h3>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                <!-- Fish Photo - Full Width -->
                                <div class="lg:col-span-1">
                                    <x-input-label for="fish_photo" :value="__('Fish Photo')" />
                                    <div id="photo-upload-zone" class="mt-2 border-2 border-dashed border-blue-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition" onclick="document.getElementById('fish_photo').click();">
                                        <svg class="w-12 h-12 text-blue-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        <p class="text-sm text-gray-600">{{ __('Drag and drop or click to upload') }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ __('JPG, PNG (Max 5MB)') }}</p>
                                        <input type="file" id="fish_photo" name="fish_photo" accept="image/*" class="hidden" />
                                    </div>
                                    <div id="photo-preview-container" class="hidden mt-4">
                                        <img id="photo-preview" class="w-full h-auto rounded-lg border-2 border-blue-300 cursor-pointer shadow-md" onclick="openPhotoModal()" />
                                        <button type="button" onclick="clearPhotoPreview()" class="mt-2 w-full px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ __('Clear') }}</button>
                                    </div>
                                </div>

                                <!-- Water Quality Parameters -->
                                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <!-- Temperature -->
                                    <div>
                                        <x-input-label for="suhu" :value="__('Temperature (°C)')" />
                                        <x-text-input id="suhu" class="block mt-2 w-full py-2.5" type="number" name="suhu" step="0.01" min="-50" max="100" :value="old('suhu')" />
                                    </div>

                                    <!-- pH -->
                                    <div>
                                        <x-input-label for="ph_air" :value="__('pH Water')" />
                                        <x-text-input id="ph_air" class="block mt-2 w-full py-2.5" type="number" name="ph_air" step="0.01" min="0" max="14" :value="old('ph_air')" />
                                    </div>

                                    <!-- Salinity -->
                                    <div>
                                        <x-input-label for="salinitas" :value="__('Salinity (ppt)')" />
                                        <x-text-input id="salinitas" class="block mt-2 w-full py-2.5" type="number" name="salinitas" step="0.01" min="0" max="50" :value="old('salinitas')" />
                                    </div>

                                    <!-- Rain -->
                                    <div>
                                        <x-input-label for="hujan" :value="__('Rain')" />
                                        <div class="mt-2 flex items-center">
                                            <input type="checkbox" id="hujan" name="hujan" value="1" {{ old('hujan') ? 'checked' : '' }} class="w-5 h-5 text-blue-600 border-gray-300 rounded shadow-sm focus:ring-blue-500">
                                            <label for="hujan" class="ml-3 text-sm text-gray-600">{{ __('Raining') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stage Section -->
                        <div class="border-b-2 border-gray-100 pb-8">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-xl font-bold text-gray-800">{{ __('Eel Stage Information') }}</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
                                <!-- Stage Type -->
                                <div>
                                    <x-input-label for="stage_type" :value="__('Stage Type')" />
                                    <select id="stage_type" name="stage_type" class="block mt-2 w-full py-2.5 px-3 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm text-gray-700">
                                        <option value="">Select Stage Type</option>
                                        <option value="Glasseel" {{ old('stage_type') === 'Glasseel' ? 'selected' : '' }}>Glasseel</option>
                                        <option value="Elver" {{ old('stage_type') === 'Elver' ? 'selected' : '' }}>Elver</option>
                                        <option value="Yellow Eel" {{ old('stage_type') === 'Yellow Eel' ? 'selected' : '' }}>Yellow Eel</option>
                                    </select>
                                </div>

                                <!-- Sampling (conditional for Glasseel) -->
                                <div id="sampling-wrapper" class="{{ old('stage_type') === 'Glasseel' ? '' : 'hidden' }}">
                                    <x-input-label for="sampling" :value="__('Sampling')" />
                                    <x-text-input id="sampling" class="block mt-2 w-full py-2.5" type="number" name="sampling" min="0" :value="old('sampling')" />
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-8 border-t-2 border-gray-100">
                            <a href="{{ route('admin.enumerators.index') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Cancel') }}
                            </a>

                            <button type="submit" class="inline-flex items-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                                </svg>
                                {{ __('Save Data') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // File upload preview
    const fishPhotoInput = document.getElementById('fish_photo');
    const photoDropZone = fishPhotoInput.parentElement;
    
    photoDropZone.addEventListener('click', function(e) {
        if (e.target !== fishPhotoInput) {
            fishPhotoInput.click();
        }
    });
    
    photoDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoDropZone.classList.add('bg-blue-50', 'border-blue-400');
    });
    
    photoDropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoDropZone.classList.remove('bg-blue-50', 'border-blue-400');
    });
    
    photoDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoDropZone.classList.remove('bg-blue-50', 'border-blue-400');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            fishPhotoInput.files = dt.files;
            showPhotoPreview();
        }
    });

    fishPhotoInput.addEventListener('change', showPhotoPreview);

    function showPhotoPreview() {
        if (fishPhotoInput.files && fishPhotoInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
                document.getElementById('photo-preview-container').classList.remove('hidden');
                photoDropZone.classList.add('hidden');
            };
            reader.readAsDataURL(fishPhotoInput.files[0]);
        }
    }

    // Show/hide sampling field based on stage_type selection
    const stageTypeSelect = document.getElementById('stage_type');
    const samplingWrapper = document.getElementById('sampling-wrapper');
    
    if (stageTypeSelect && samplingWrapper) {
        stageTypeSelect.addEventListener('change', function() {
            if (this.value === 'Glasseel') {
                samplingWrapper.classList.remove('hidden');
            } else {
                samplingWrapper.classList.add('hidden');
            }
        });

        if (stageTypeSelect.value === 'Glasseel') {
            samplingWrapper.classList.remove('hidden');
        }
    }

    // Location dropdowns
    const countrySelect = document.getElementById('country');
    const provinceSelect = document.getElementById('province');
    const regencySelect = document.getElementById('regency');
    const districtSelect = document.getElementById('district');

    const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const regencyApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';
    const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/';

    const indonesiaOption = document.createElement('option');
    indonesiaOption.value = 'Indonesia';
    indonesiaOption.textContent = 'Indonesia';
    countrySelect.appendChild(indonesiaOption);
    countrySelect.value = 'Indonesia';

    function fetchProvinces() {
        fetch(provinceApiUrl)
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
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }

    function fetchRegencies() {
        const selectedProvince = provinceSelect.options[provinceSelect.selectedIndex];
        const provinceId = selectedProvince ? selectedProvince.dataset.id : null;
        regencySelect.innerHTML = '<option value="">Loading...</option>';

        if (!provinceId) {
            regencySelect.innerHTML = '<option value="">Select Province First</option>';
            return;
        }

        fetch(`${regencyApiBaseUrl}${provinceId}.json`)
            .then(response => response.json())
            .then(regencies => {
                regencySelect.innerHTML = '<option value="">Select Regency/City</option>';
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.textContent = regency.name;
                    option.dataset.id = regency.id;
                    regencySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching regencies:', error);
                regencySelect.innerHTML = '<option value="">Failed to load regencies/cities</option>';
            });
    }

    function fetchDistricts() {
        const selectedRegency = regencySelect.options[regencySelect.selectedIndex];
        const regencyId = selectedRegency ? selectedRegency.dataset.id : null;
        districtSelect.innerHTML = '<option value="">Loading...</option>';

        if (!regencyId) {
            districtSelect.innerHTML = '<option value="">Select Regency First</option>';
            return;
        }

        fetch(`${districtApiBaseUrl}${regencyId}.json`)
            .then(response => response.json())
            .then(districts => {
                districtSelect.innerHTML = '<option value="">Select District</option>';
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching districts:', error);
                districtSelect.innerHTML = '<option value="">Failed to load districts</option>';
            });
    }

    provinceSelect.addEventListener('change', fetchRegencies);
    regencySelect.addEventListener('change', fetchDistricts);
    fetchProvinces();
});

// Photo modal functions
function openPhotoModal() {
    const photoSrc = document.getElementById('photo-preview').src;
    const modalImg = document.getElementById('modal-photo');
    const photoModal = document.getElementById('photoModal');
    modalImg.src = photoSrc;
    photoModal.classList.remove('hidden');
}

function closePhotoModal() {
    document.getElementById('photoModal').classList.add('hidden');
}

function clearPhotoPreview() {
    document.getElementById('fish_photo').value = '';
    document.getElementById('photo-preview-container').classList.add('hidden');
    document.getElementById('photo-upload-zone').classList.remove('hidden');
}

document.addEventListener('click', function(event) {
    const photoModal = document.getElementById('photoModal');
    if (event.target === photoModal) {
        closePhotoModal();
    }
});
</script>

<!-- Photo Modal -->
<div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg max-w-2xl max-h-screen overflow-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">{{ __('Photo View') }}</h3>
            <button type="button" onclick="closePhotoModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <img id="modal-photo" src="" alt="Photo" class="w-full h-auto" />
        </div>
    </div>
</div>

</x-app-layout>
