<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div>
            <x-input-label for="photo_upload" :value="__('Profile Photo')" />
            <div class="mt-2 flex items-center gap-4">
                <img id="photo_preview" src="{{ $user->avatarUrl() }}" alt="Profile Photo" class="h-20 w-20 rounded-full object-cover border" />
                <input type="file" id="photo_upload" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                <input type="hidden" name="profile_photo" id="profile_photo_base64">
            </div>
            <p class="mt-1 text-sm text-gray-500">Image will automatically be cropped to 1:1 and optimized.</p>
        </div>

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first-name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <!-- Middle Name -->
        <div>
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" :value="old('middle_name', $user->middle_name)" autocomplete="additional-name" />
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="last-name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <!-- Birth Date -->
        <div>
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Country -->
        <div>
            <x-input-label for="country" :value="__('Country')" />
            <select id="country" name="country" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="Indonesia" selected>Indonesia</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>

        <!-- Province -->
        <div>
            <x-input-label for="province" :value="__('Province')" />
            <select id="province" name="province" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required data-selected="{{ old('province', $user->province) }}">
                <option value="">Select Province</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('province')" />
        </div>

        <!-- District (Regency/City) -->
        <div>
            <x-input-label for="district" :value="__('Regency/City (District)')" />
            <select id="district" name="district" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required data-selected="{{ old('district', $user->district) }}">
                <option value="">Select Regency/City</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('district')" />
        </div>

        <!-- Sub-District -->
        <div>
            <x-input-label for="sub_district" :value="__('Sub-District')" />
            <select id="sub_district" name="sub_district" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required data-selected="{{ old('sub_district', $user->sub_district) }}">
                <option value="">Select Sub-District</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('sub_district')" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

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

    const selectedProv = provinceSelect.getAttribute('data-selected');
    const selectedDist = districtSelect.getAttribute('data-selected');
    const selectedSubDist = subDistrictSelect.getAttribute('data-selected');

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
                    if (province.name === selectedProv) {
                        option.selected = true;
                    }
                    provinceSelect.appendChild(option);
                });

                if (provinceSelect.value) fetchRegencies();
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
                    if (regency.name === selectedDist) {
                        option.selected = true;
                    }
                    districtSelect.appendChild(option);
                });

                if (districtSelect.value) fetchDistricts();
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
                    if (district.name === selectedSubDist) {
                        option.selected = true;
                    }
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
</section>
