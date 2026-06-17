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

@if($showReject ?? false)
    <form method="POST" action="{{ route('admin.approvals.reject', $sidat->id) }}" id="reject-form"
        onsubmit="return confirm('Reject and permanently delete this data?')">
        @csrf
        @method('DELETE')
    </form>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-8" id="sidat-form">
    @csrf
    @if($method ?? false)
        @method($method)
    @endif

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
                <x-text-input id="date" class="block mt-2 w-full py-2.5" type="date" name="date" :value="old('date', isset($sidat) ? $sidat->date->format('Y-m-d') : date('Y-m-d'))" required />
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
                <x-text-input id="river" list="river-options" class="block mt-2 w-full py-2.5" type="text" name="river" :value="old('river', $sidat->river ?? '')" required placeholder="Type or select a river" />
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
                <x-text-input id="stage" class="block mt-2 w-full py-2.5" type="text" name="stage" :value="old('stage', $sidat->stage ?? '')" required />
            </div>

            <!-- Fisherman Name -->
            <div>
                <x-input-label for="fisher_name" :value="__('Fisher Name')" />
                <x-text-input id="fisher_name" class="block mt-2 w-full py-2.5" type="text" name="fisher_name" :value="old('fisher_name', $sidat->fisher_name ?? '')" required />
            </div>

            <!-- Number of Fisher -->
            <div>
                <x-input-label for="number_of_fisher" :value="__('Number Of Fisher')" />
                <x-text-input id="number_of_fisher" class="block mt-2 w-full py-2.5" type="number" name="number_of_fisher" :value="old('number_of_fisher', $sidat->number_of_fisher ?? '')" required />
            </div>

            <!-- Type Of Fishing Gear -->
            <div>
                <x-input-label for="type_of_fishing_gear" :value="__('Type Of Fishing Gear')" />
                <x-text-input id="type_of_fishing_gear" class="block mt-2 w-full py-2.5" type="text" name="type_of_fishing_gear" :value="old('type_of_fishing_gear', $sidat->type_of_fishing_gear ?? '')" required />
            </div>

            <!-- Number of Fishing Gear -->
            <div>
                <x-input-label for="number_of_fishing_gear" :value="__('Number Of Fishing Gear')" />
                <x-text-input id="number_of_fishing_gear" class="block mt-2 w-full py-2.5" type="number" name="number_of_fishing_gear" :value="old('number_of_fishing_gear', $sidat->number_of_fishing_gear ?? '')" required />
            </div>

            <!-- Species Name -->
            <div>
                <x-input-label for="species_name" :value="__('Species Name')" />
                <x-text-input id="species_name" class="block mt-2 w-full py-2.5" type="text" name="species_name" :value="old('species_name', $sidat->species_name ?? '')" required />
            </div>

            <!-- Operation Time -->
            <div>
                <x-input-label for="operation_time" :value="__('Operation Time (hours/day)')" />
                <x-text-input id="operation_time" class="block mt-2 w-full py-2.5" type="number" step="0.1" name="operation_time" :value="old('operation_time', $sidat->operation_time ?? '')" required />
            </div>

            <!-- Total Weight -->
            <div>
                <x-input-label for="total_weight_per_day" :value="__('Total Weight (kg/day)')" />
                <x-text-input id="total_weight_per_day" class="block mt-2 w-full py-2.5" type="number" step="0.01" name="total_weight_per_day" :value="old('total_weight_per_day', $sidat->total_weight_per_day ?? '')" required />
            </div>

            <!-- Price per kg -->
            <div>
                <x-input-label for="price_per_kg" :value="__('Price (per kg)')" />
                <x-text-input id="price_per_kg" class="block mt-2 w-full py-2.5" type="number" step="0.01" name="price_per_kg" :value="old('price_per_kg', $sidat->price_per_kg ?? '')" required />
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
            <!-- Fish Photo -->
            <div class="lg:col-span-1">
                <x-input-label for="fish_photo" :value="__('Fish Photo (Optional)')" />
                
                <!-- Photo Preview -->
                <div id="photo-preview-container" class="mt-2 {{ isset($sidat) && $sidat->fish_photo ? '' : 'hidden' }}">
                    <img id="photo-preview" src="{{ isset($sidat) && $sidat->fish_photo ? asset('storage/' . $sidat->fish_photo) : '' }}" alt="Photo Preview" class="w-full h-64 object-cover rounded-lg cursor-pointer border-2 border-blue-300 hover:border-blue-500 transition shadow-md" onclick="openPhotoModal()" />
                    <button type="button" onclick="clearPhotoPreview()" class="mt-3 w-full px-4 py-2 text-sm font-medium bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Clear Photo</button>
                    @if(isset($sidat) && $sidat->fish_photo)
                        <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                    @endif
                </div>

                <!-- Upload Zone -->
                <div id="photo-upload-zone" class="mt-2 {{ isset($sidat) && $sidat->fish_photo ? 'hidden' : 'flex' }} justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('fish_photo').click()">
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
                    <p class="mt-2 text-sm text-red-600 flex items-center italic">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Water Quality Parameters -->
            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Suhu (Temperature) -->
                <div>
                    <x-input-label for="suhu" :value="__('Temperature (°C)')" />
                    <x-text-input id="suhu" class="block mt-2 w-full py-2.5" type="number" step="0.1" name="suhu" :value="old('suhu', $sidat->suhu ?? '')" placeholder="e.g., 28.5" />
                </div>

                <!-- pH Air -->
                <div>
                    <x-input-label for="ph_air" :value="__('pH (Water)')" />
                    <x-text-input id="ph_air" class="block mt-2 w-full py-2.5" type="number" step="0.1" min="0" max="14" name="ph_air" :value="old('ph_air', $sidat->ph_air ?? '')" placeholder="0-14" />
                </div>

                <!-- Salinitas -->
                <div>
                    <x-input-label for="salinitas" :value="__('Salinity (PSU)')" />
                    <x-text-input id="salinitas" class="block mt-2 w-full py-2.5" type="number" step="0.1" min="0" name="salinitas" :value="old('salinitas', $sidat->salinitas ?? '')" placeholder="e.g., 35.2" />
                </div>

                <!-- Hujan -->
                <div class="flex items-end">
                    <label class="flex items-center cursor-pointer p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition flex-1">
                        <input type="checkbox" name="hujan" value="1" {{ old('hujan', $sidat->hujan ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer" />
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
                    @foreach(['Glasseel', 'Elver', 'Yellow Eel'] as $type)
                        <option value="{{ $type }}" {{ old('stage_type', $sidat->stage_type ?? '') == $type ? 'selected' : '' }}>{{ __($type) }}</option>
                    @endforeach
                </select>
                <p class="mt-2 text-xs text-gray-500">{{ __('Select the developmental stage of the eel') }}</p>
            </div>

            <!-- Sampling (conditional for Glasseel) -->
            <div id="sampling-wrapper" class="hidden">
                <x-input-label for="sampling" :value="__('Sampling Number')" />
                <x-text-input id="sampling" class="block mt-2 w-full py-2.5" type="number" min="0" name="sampling" :value="old('sampling', $sidat->sampling ?? '')" placeholder="e.g., 50" />
                <p class="mt-2 text-xs text-gray-500">{{ __('Number of glass eels sampled') }}</p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center justify-between pt-8 border-t-2 border-gray-100">
        <div class="flex gap-4">
            <a href="{{ $cancelUrl ?? route('sidat.index') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('Cancel') }}
            </a>
            
            @if(isset($showReject) && $showReject)
                <button type="button" onclick="confirmReject()" class="inline-flex items-center px-6 py-3 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition">
                    {{ __('Reject & Delete') }}
                </button>
            @endif
        </div>

        <div class="flex gap-4">
            @if(isset($showApprove) && $showApprove)
                <button type="submit" name="approve" value="1" class="inline-flex items-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 rounded-lg hover:from-green-700 hover:to-green-800 transition shadow-md hover:shadow-lg">
                    {{ __('Approve & Save') }}
                </button>
            @endif

            <button type="submit" class="inline-flex items-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"></path>
                </svg>
                {{ $submitText ?? __('Save Data') }}
            </button>
        </div>
    </div>
</form>

@if(isset($showReject) && $showReject)
    <form method="POST" action="{{ route('admin.approvals.reject', $sidat->id) }}" id="reject-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    <script>
        function confirmReject() {
            if (confirm('Are you sure you want to reject and permanently delete this data?')) {
                document.getElementById('reject-form').submit();
            }
        }
    </script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    // File upload preview
    const fishPhotoInput = document.getElementById('fish_photo');
    const photoDropZone = document.getElementById('photo-upload-zone');
    const photoPreviewContainer = document.getElementById('photo-preview-container');
    const photoPreview = document.getElementById('photo-preview');
    const removePhotoInput = document.getElementById('remove_photo');
    
    if (photoDropZone) {
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
                const dt = new DataTransfer();
                dt.items.add(files[0]);
                fishPhotoInput.files = dt.files;
                showPhotoPreview();
            }
        });
    }

    if (fishPhotoInput) {
        fishPhotoInput.addEventListener('change', showPhotoPreview);
    }

    function showPhotoPreview() {
        if (fishPhotoInput.files && fishPhotoInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreviewContainer.classList.remove('hidden');
                photoDropZone.classList.add('hidden');
                if (removePhotoInput) removePhotoInput.value = "0";
            };
            reader.readAsDataURL(fishPhotoInput.files[0]);
        }
    }

    window.clearPhotoPreview = function() {
        fishPhotoInput.value = '';
        photoPreviewContainer.classList.add('hidden');
        photoDropZone.classList.remove('hidden');
        photoDropZone.classList.add('flex');
        if (removePhotoInput) removePhotoInput.value = "1";
    };

    // Stage logic
    const stageTypeSelect = document.getElementById('stage_type');
    const samplingWrapper = document.getElementById('sampling-wrapper');
    
    if (stageTypeSelect && samplingWrapper) {
        function toggleSampling() {
            if (stageTypeSelect.value === 'Glasseel') {
                samplingWrapper.classList.remove('hidden');
            } else {
                samplingWrapper.classList.add('hidden');
            }
        }
        stageTypeSelect.addEventListener('change', toggleSampling);
        toggleSampling();
    }

    // Location API logic
    const countrySelect = document.getElementById('country');
    const provinceSelect = document.getElementById('province');
    const regencySelect = document.getElementById('regency');
    const districtSelect = document.getElementById('district');

    const existingData = {
        country: "{{ old('country', isset($sidat) ? ($sidat->country ?? 'Indonesia') : (Auth::user() && Auth::user()->isEnum() ? (Auth::user()->country ?? 'Indonesia') : 'Indonesia')) }}",
        province: "{{ old('province', isset($sidat) ? ($sidat->province ?? '') : (Auth::user() && Auth::user()->isEnum() ? (Auth::user()->province ?? '') : '')) }}",
        regency: "{{ old('regency', isset($sidat) ? ($sidat->regency ?? '') : (Auth::user() && Auth::user()->isEnum() ? (Auth::user()->district ?? '') : '')) }}",
        district: "{{ old('district', isset($sidat) ? ($sidat->district ?? '') : (Auth::user() && Auth::user()->isEnum() ? (Auth::user()->sub_district ?? '') : '')) }}"
    };

    const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const regencyApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';
    const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/';

    function initLocation() {
        // Only handles Indonesia for now
        const option = document.createElement('option');
        option.value = 'Indonesia';
        option.textContent = 'Indonesia';
        countrySelect.appendChild(option);
        countrySelect.value = 'Indonesia';

        fetch(provinceApiUrl)
            .then(res => res.json())
            .then(provinces => {
                provinceSelect.innerHTML = '<option value="">Select Province</option>';
                provinces.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.name; opt.dataset.id = p.id; opt.textContent = p.name;
                    if (p.name === existingData.province) opt.selected = true;
                    provinceSelect.appendChild(opt);
                });
                if (provinceSelect.value) loadRegencies();
            });
    }

    function loadRegencies() {
        const sel = provinceSelect.options[provinceSelect.selectedIndex];
        if (!sel || !sel.dataset.id) return;
        regencySelect.innerHTML = '<option value="">Loading...</option>';
        fetch(`${regencyApiBaseUrl}${sel.dataset.id}.json`)
            .then(res => res.json())
            .then(regencies => {
                regencySelect.innerHTML = '<option value="">Select Regency/City</option>';
                regencies.forEach(r => {
                    const opt = document.createElement('option');
                    opt.value = r.name; opt.dataset.id = r.id; opt.textContent = r.name;
                    if (r.name === existingData.regency) opt.selected = true;
                    regencySelect.appendChild(opt);
                });
                if (regencySelect.value) loadDistricts();
            });
    }

    function loadDistricts() {
        const sel = regencySelect.options[regencySelect.selectedIndex];
        if (!sel || !sel.dataset.id) return;
        districtSelect.innerHTML = '<option value="">Loading...</option>';
        fetch(`${districtApiBaseUrl}${sel.dataset.id}.json`)
            .then(res => res.json())
            .then(districts => {
                districtSelect.innerHTML = '<option value="">Select District</option>';
                districts.forEach(d => {
                    const opt = document.createElement('option');
                    opt.value = d.name; opt.textContent = d.name;
                    if (d.name === existingData.district) opt.selected = true;
                    districtSelect.appendChild(opt);
                });
            });
    }

    provinceSelect.addEventListener('change', loadRegencies);
    regencySelect.addEventListener('change', loadDistricts);
    initLocation();
});

// Photo modal functions
window.openPhotoModal = function() {
    const photoSrc = document.getElementById('photo-preview').src;
    const modalImg = document.getElementById('modal-photo');
    const photoModal = document.getElementById('photoModal');
    if (photoSrc && modalImg && photoModal) {
        modalImg.src = photoSrc;
        photoModal.classList.remove('hidden');
    }
}

window.closePhotoModal = function() {
    document.getElementById('photoModal').classList.add('hidden');
}
</script>

<!-- Photo Modal -->
<div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75">
    <div class="bg-white rounded-xl max-w-4xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl">
        <div class="flex justify-between items-center p-4 border-b bg-gray-50">
            <h3 class="text-lg font-bold text-gray-800">{{ __('Photo View') }}</h3>
            <button type="button" onclick="closePhotoModal()" class="text-gray-500 hover:text-gray-700 p-1 hover:bg-gray-200 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-2 bg-gray-100 flex-1 overflow-auto flex items-center justify-center">
            <img id="modal-photo" src="" alt="Photo" class="max-w-full h-auto rounded shadow-lg" />
        </div>
    </div>
</div>
