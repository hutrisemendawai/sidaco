<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Add New Tropical Anguillid Eel Data') }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">{{ __('Please fill in all required fields to record new SIDAT monitoring data') }}</p>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8 bg-white">

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-8 p-6 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="font-semibold text-red-800 text-lg">{{ __('Please correct the following errors:') }}</h3>
                            </div>
                            <ul class="space-y-2">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red-700 flex items-start">
                                        <span class="text-red-500 mr-2">•</span>
                                        <span>{{ $error }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sidat.store') }}" enctype="multipart/form-data" class="space-y-8">
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
                                    <x-text-input id="river" list="river-options" class="block mt-2 w-full py-2.5" type="text" name="river" :value="old('river')" required placeholder="Type or select a river" />
                                    <datalist id="river-options">
                                        @foreach($rivers as $riverName)
                                            <option value="{{ $riverName }}">
                                        @endforeach
                                    </datalist>
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
                                    <x-input-label for="number_of_fishing_gear" :value="__('Number Of Fishing Gear')" />
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
                                    <x-text-input id="operation_time" class="block mt-2 w-full py-2.5" type="number" step="0.1" name="operation_time" :value="old('operation_time')" required />
                                </div>

                                <!-- Total Weight -->
                                <div>
                                    <x-input-label for="total_weight_per_day" :value="__('Total Weight (kg/day)')" />
                                    <x-text-input id="total_weight_per_day" class="block mt-2 w-full py-2.5" type="number" step="0.01" name="total_weight_per_day" :value="old('total_weight_per_day')" required />
                                </div>

                                <!-- Price per kg -->
                                <div>
                                    <x-input-label for="price_per_kg" :value="__('Price (per kg)')" />
                                    <x-text-input id="price_per_kg" class="block mt-2 w-full py-2.5" type="number" step="0.01" name="price_per_kg" :value="old('price_per_kg')" required />
                                </div>
                            </div>
                        </div>

                        <!-- Water Quality Section -->
                        <div class="border-b-2 border-gray-100 pb-8">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-xl font-bold text-gray-800">{{ __('Water Quality & Fish Data') }}</h3>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                <!-- Fish Photo - Full Width -->
                                <div class="lg:col-span-1">
                                    <x-input-label for="fish_photo" :value="__('Fish Photo (Optional)')" />
                                    
                                    <!-- Photo Preview -->
                                    <div id="photo-preview-container" class="mt-2 hidden">
                                        <img id="photo-preview" src="" alt="Photo Preview" class="w-full h-64 object-cover rounded-lg cursor-pointer border-2 border-blue-300 hover:border-blue-500 transition shadow-md" onclick="openPhotoModal()" />
                                        <button type="button" onclick="clearPhotoPreview()" class="mt-3 w-full px-4 py-2 text-sm font-medium bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Clear Photo</button>
                                    </div>

                                    <!-- Upload Zone -->
                                    <div id="photo-upload-zone" class="mt-2 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('fish_photo').click()">
                                        <div class="space-y-2 text-center">
                                            <svg class="mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v4m0-4h4m0 0h4m0 0v-4m0 4v4m-8-20V12a4 4 0 00-4-4H12a4 4 0 00-4 4v20m32-12a6 6 0 11-12 0 6 6 0 0112 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <div class="text-sm text-gray-600 font-medium">
                                                <span>{{ __('Click to upload or drag and drop') }}</span>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                        <x-text-input id="fish_photo" type="file" name="fish_photo" class="hidden" accept="image/*" />
                                    </div>
                                    @error('fish_photo')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a.75.75 0 00-1.06-1.061L11 17.879V4a.75.75 0 00-1.5 0v13.879L4.96 11.869a.75.75 0 10-1.06 1.06l7.5 7.5a.75.75 0 001.06 0l7.5-7.5z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Water Quality Parameters -->
                                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <!-- Suhu (Temperature) -->
                                    <div>
                                        <x-input-label for="suhu" :value="__('Temperature (°C)')" />
                                        <x-text-input id="suhu" class="block mt-2 w-full py-2.5" type="number" step="0.1" name="suhu" :value="old('suhu')" placeholder="e.g., 28.5" />
                                    </div>

                                    <!-- pH Air -->
                                    <div>
                                        <x-input-label for="ph_air" :value="__('pH (Water)')" />
                                        <x-text-input id="ph_air" class="block mt-2 w-full py-2.5" type="number" step="0.1" min="0" max="14" name="ph_air" :value="old('ph_air')" placeholder="0-14" />
                                    </div>

                                    <!-- Salinitas -->
                                    <div>
                                        <x-input-label for="salinitas" :value="__('Salinity (PSU)')" />
                                        <x-text-input id="salinitas" class="block mt-2 w-full py-2.5" type="number" step="0.1" min="0" name="salinitas" :value="old('salinitas')" placeholder="e.g., 35.2" />
                                    </div>

                                    <!-- Hujan -->
                                    <div class="flex items-end">
                                        <label class="flex items-center cursor-pointer p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition flex-1">
                                            <input type="checkbox" name="hujan" value="1" {{ old('hujan') ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer" />
                                            <span class="ms-3 text-sm font-medium text-gray-700">{{ __('Rain Present') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stage Section -->
                        <div class="border-b-2 border-gray-100 pb-8">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-4 text-xl font-bold text-gray-800">{{ __('Eel Stage Information') }}</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
                                <!-- Stage Type -->
                                <div>
                                    <x-input-label for="stage_type" :value="__('Eel Stage Type')" />
                                    <select id="stage_type" name="stage_type" class="block mt-2 w-full py-2.5 px-3 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm text-gray-700">
                                        <option value="">{{ __('Select Type') }}</option>
                                        <option value="Glasseel" {{ old('stage_type') == 'Glasseel' ? 'selected' : '' }}>{{ __('Glasseel') }}</option>
                                        <option value="Elver" {{ old('stage_type') == 'Elver' ? 'selected' : '' }}>{{ __('Elver') }}</option>
                                        <option value="Yellow Eel" {{ old('stage_type') == 'Yellow Eel' ? 'selected' : '' }}>{{ __('Yellow Eel') }}</option>
                                    </select>
                                    <p class="mt-2 text-xs text-gray-500">{{ __('Select the developmental stage of the eel') }}</p>
                                </div>

                                <!-- Sampling (conditional for Glasseel) -->
                                <div id="sampling-wrapper" class="hidden">
                                    <x-input-label for="sampling" :value="__('Sampling Number')" />
                                    <x-text-input id="sampling" class="block mt-2 w-full py-2.5" type="number" min="0" name="sampling" :value="old('sampling')" placeholder="e.g., 50" />
                                    <p class="mt-2 text-xs text-gray-500">{{ __('Number of glass eels sampled') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-8 border-t-2 border-gray-100">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Cancel') }}
                            </a>

                            <button type="submit" class="inline-flex items-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"></path>
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
    
    // Make the drop zone clickable for file selection
    photoDropZone.addEventListener('click', function(e) {
        if (e.target !== fishPhotoInput) {
            fishPhotoInput.click();
        }
    });
    
    photoDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoDropZone.classList.add('bg-indigo-50', 'border-indigo-500');
    });
    
    photoDropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoDropZone.classList.remove('bg-indigo-50', 'border-indigo-500');
    });
    
    photoDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        photoDropZone.classList.remove('bg-indigo-50', 'border-indigo-500');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            // Create a DataTransfer object to set files
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            fishPhotoInput.files = dt.files;
            showPhotoPreview();
        }
    });

    // Handle file input change
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

        // Trigger on load if Glasseel is already selected
        if (stageTypeSelect.value === 'Glasseel') {
            samplingWrapper.classList.remove('hidden');
        }
    }

    // Location dropdowns
    const countrySelect = document.getElementById('country');
    const provinceSelect = document.getElementById('province');
    const regencySelect = document.getElementById('regency');
    const districtSelect = document.getElementById('district');

    const userProfile = {
        country: "{{ Auth::user()->country }}",
        province: "{{ Auth::user()->province }}",
        regency: "{{ Auth::user()->district }}",
        district: "{{ Auth::user()->sub_district }}"
    };

    const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const regencyApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';
    const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/';

    const indonesiaOption = document.createElement('option');
    indonesiaOption.value = 'Indonesia';
    indonesiaOption.textContent = 'Indonesia';
    countrySelect.appendChild(indonesiaOption);

    if (userProfile.country) {
        countrySelect.value = userProfile.country;
    } else {
        countrySelect.value = 'Indonesia';
    }

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

                if (userProfile.province) {
                    const profileProvince = Array.from(provinceSelect.options).find(opt => opt.value === userProfile.province);
                    if (profileProvince) {
                        profileProvince.selected = true;
                        fetchRegencies();
                    }
                }
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

                if (userProfile.regency) {
                    const profileRegency = Array.from(regencySelect.options).find(opt => opt.value === userProfile.regency);
                    if (profileRegency) {
                        profileRegency.selected = true;
                        fetchDistricts();
                    }
                }
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

                if (userProfile.district) {
                    const profileDistrict = Array.from(districtSelect.options).find(opt => opt.value === userProfile.district);
                    if (profileDistrict) {
                        profileDistrict.selected = true;
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching districts:', error);
                districtSelect.innerHTML = '<option value="">Failed to load districts</option>';
            });
    }

    provinceSelect.addEventListener('change', fetchRegencies);
    regencySelect.addEventListener('change', fetchDistricts);
    fetchProvinces();
    fetchRegencies();
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

// Close modal when clicking outside
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
