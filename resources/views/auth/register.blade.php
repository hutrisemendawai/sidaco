<x-app-layout>
    <div class="py-12" x-data="{ activeTab: 'manual' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs -->
            <div class="flex border-b border-gray-200 mb-6 bg-white overflow-hidden shadow-sm sm:rounded-t-lg">
                <button 
                    @click="activeTab = 'manual'" 
                    :class="activeTab === 'manual' ? 'border-indigo-500 text-indigo-600 border-b-2 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="py-4 px-6 text-center text-sm font-medium transition duration-150 ease-in-out focus:outline-none flex-1">
                    {{ __('Manual Registration') }}
                </button>
                <button 
                    @click="activeTab = 'bulk-enum'" 
                    :class="activeTab === 'bulk-enum' ? 'border-indigo-500 text-indigo-600 border-b-2 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="py-4 px-6 text-center text-sm font-medium transition duration-150 ease-in-out focus:outline-none flex-1">
                    {{ __('Auto-Generate Enumerators') }}
                </button>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                <div class="p-6 text-gray-900">
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

                    <!-- Manual Registration Tab -->
                    <div x-show="activeTab === 'manual'">
                        <form method="POST" action="{{ route('register') }}" id="register-form">
                            @csrf

                            <!-- Profile Photo -->
                            <div class="mb-4">
                                <x-input-label for="photo_upload" :value="__('Profile Photo')" />
                                <div class="mt-2 flex items-center gap-4">
                                    <img id="photo_preview" src="https://ui-avatars.com/api/?name=New+User&background=0ea5e9&color=ffffff" alt="Profile Photo Preview" class="h-20 w-20 rounded-full object-cover border" />
                                    <input type="file" id="photo_upload" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                    <input type="hidden" name="profile_photo" id="profile_photo_base64">
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Image will automatically be cropped to 1:1 and optimized.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div>
                                        <x-input-label for="first_name" :value="__('First Name')" />
                                        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" />
                                        <x-text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" autocomplete="additional-name" />
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="birth_date" :value="__('Birth Date')" />
                                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                                    <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number')" required placeholder="e.g., 081234567890" />
                                    <p class="mt-1 text-sm text-gray-500">Starts with 08, 10-13 digits.</p>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <x-input-label for="address" :value="__('Address')" />
                                    <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('address') }}</textarea>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="country" :value="__('Country')" />
                                    <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="Indonesia" selected>Indonesia</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="province" :value="__('Province')" />
                                    <select id="province" name="province" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Province</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="district" :value="__('Regency/City (District)')" />
                                    <select id="district" name="district" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Regency/City</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="sub_district" :value="__('Sub-District')" />
                                    <select id="sub_district" name="sub_district" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Sub-District</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>
                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a class="text-sm text-gray-600 hover:text-gray-900 mr-4" href="{{ route('admin.users.index') }}">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create User') }}
                            </x-primary-button>
                        </div>
                    </form>
                    </div>

                    <!-- Auto-Generate Enumerators Tab -->
                    <div x-show="activeTab === 'bulk-enum'" style="display: none;">
                        <form method="POST" action="{{ route('register.bulk-enum') }}" id="bulk-enum-form" class="space-y-6">
                            @csrf

                            <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 mb-6 rounded-r-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-semibold text-indigo-800">{{ __('Automated Batch Creation Info') }}</h3>
                                        <p class="text-xs text-indigo-700 mt-1">
                                            {{ __('Using this option, accounts will be configured instantly with default/empty settings as required. Features of batch accounts:') }}
                                        </p>
                                        <ul class="list-disc list-inside text-xs text-indigo-700 mt-2 space-y-1">
                                            <li><strong>Username / Account Name:</strong> enum[year][4digit] (e.g., enum{{ date('Y') }}1234)</li>
                                            <li><strong>Email:</strong> enum[year][4digit]@seafdec.id</li>
                                            <li><strong>Password:</strong> Same as the generated Username</li>
                                            <li><strong>Account type:</strong> Enumerator (enum)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-md">
                                <x-input-label for="count" :value="__('Number of Accounts to Generate')" />
                                <x-text-input id="count" class="block mt-1 w-full" type="number" name="count" min="1" max="50" value="5" required />
                                <p class="mt-1 text-sm text-gray-500">{{ __('Enter how many accounts you want to create instantly in a single click (min: 1, max: 50).') }}</p>
                            </div>

                            <div class="flex items-center justify-end mt-8 border-t pt-6">
                                <a class="text-sm text-gray-600 hover:text-gray-900 mr-4" href="{{ route('admin.users.index') }}">
                                    {{ __('Cancel') }}
                                </a>
                                <x-primary-button class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 shadow-md">
                                    {{ __('Generate Accounts') }}
                                </x-primary-button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ---- PROFILE PHOTO AUTO CROP 1:1 AND OPTIMIZATION ----
    const photoUpload = document.getElementById('photo_upload');
    const photoPreview = document.getElementById('photo_preview');
    const profilePhotoBase64 = document.getElementById('profile_photo_base64');

    photoUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            const img = new Image();
            img.onload = function() {
                // Determine square crop dimension
                const size = Math.min(img.width, img.height);
                const startX = (img.width - size) / 2;
                const startY = (img.height - size) / 2;

                // Create canvas
                const canvas = document.createElement('canvas');
                // Target size to reduce weight, e.g., 400x400
                const targetSize = Math.min(size, 400);
                canvas.width = targetSize;
                canvas.height = targetSize;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, startX, startY, size, size, 0, 0, targetSize, targetSize);

                // Compress to WebP or JPEG
                const dataUrl = canvas.toDataURL('image/jpeg', 0.8);

                photoPreview.src = dataUrl;
                profilePhotoBase64.value = dataUrl;
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });

    // ---- LOCATION API ----
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const subDistrictSelect = document.getElementById('sub_district');

    const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const regencyApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';
    const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/';

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
        districtSelect.innerHTML = '<option value="">Loading...</option>';

        if (!provinceId) {
            districtSelect.innerHTML = '<option value="">Select Regency/City</option>';
            subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
            return;
        }

        fetch(`${regencyApiBaseUrl}${provinceId}.json`)
            .then(response => response.json())
            .then(regencies => {
                districtSelect.innerHTML = '<option value="">Select Regency/City</option>';
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.textContent = regency.name;
                    option.dataset.id = regency.id;
                    districtSelect.appendChild(option);
                });
            });
    }

    function fetchDistricts() {
        const selectedRegency = districtSelect.options[districtSelect.selectedIndex];
        const regencyId = selectedRegency ? selectedRegency.dataset.id : null;
        subDistrictSelect.innerHTML = '<option value="">Loading...</option>';

        if (!regencyId) {
            subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
            return;
        }

        fetch(`${districtApiBaseUrl}${regencyId}.json`)
            .then(response => response.json())
            .then(districts => {
                subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    subDistrictSelect.appendChild(option);
                });
            });
    }

    provinceSelect.addEventListener('change', () => {
        districtSelect.value = "";
        subDistrictSelect.value = "";
        fetchRegencies();
    });
    districtSelect.addEventListener('change', () => {
        subDistrictSelect.value = "";
        fetchDistricts();
    });

    fetchProvinces();
});
</script>
</x-app-layout>
