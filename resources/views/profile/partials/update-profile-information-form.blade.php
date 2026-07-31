<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" class="space-y-7">
        @csrf
        @method('patch')

        <div class="profile-subpanel space-y-5">
            <div class="profile-subpanel-head">
                <h3 class="profile-subpanel-title">Profile photo</h3>
                <p class="profile-subpanel-text">Upload a clear square photo. We optimize and crop it to keep the app consistent.</p>
            </div>

            <div class="profile-upload-wrap">
                <img id="photo_preview" src="{{ $user->avatarUrl() }}" alt="Profile photo" class="h-20 w-20 rounded-2xl border border-white/80 object-cover shadow-md sm:h-24 sm:w-24" />
                <div class="flex-1">
                    <label for="photo_upload" class="profile-file-label">
                        <span class="profile-file-title">Choose image</span>
                        <span id="photo_filename" class="profile-file-name">No file selected</span>
                    </label>
                    <input type="file" id="photo_upload" accept="image/*" class="sr-only" />
                    <input type="hidden" name="profile_photo" id="profile_photo_base64">
                    <p class="mt-2 text-xs text-slate-500">Accepted formats: JPG, PNG, WEBP. Maximum recommended source size: 5MB.</p>
                </div>
            </div>
        </div>

        <div class="profile-subpanel space-y-6">
            <div class="profile-subpanel-head">
                <h3 class="profile-subpanel-title">Identity</h3>
                <p class="profile-subpanel-text">This information is used throughout records and reporting ownership.</p>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-2 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="given-name" />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>

                <div>
                    <x-input-label for="middle_name" :value="__('Middle Name')" />
                    <x-text-input id="middle_name" name="middle_name" type="text" class="mt-2 block w-full" :value="old('middle_name', $user->middle_name)" autocomplete="additional-name" />
                    <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-2 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="family-name" />
                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                </div>

                <div>
                    <x-input-label for="birth_date" :value="__('Birth Date')" />
                    <x-text-input id="birth_date" name="birth_date" type="date" class="mt-2 block w-full" :value="old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                </div>
            </div>
        </div>

        <div class="profile-subpanel space-y-6">
            <div class="profile-subpanel-head">
                <h3 class="profile-subpanel-title">Contact</h3>
                <p class="profile-subpanel-text">Keep your contact information current for account recovery and notifications.</p>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2 rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs text-amber-900">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="ms-1 font-semibold underline decoration-amber-600 underline-offset-2 hover:text-amber-700">
                                {{ __('Re-send verification email') }}
                            </button>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-xs font-medium text-emerald-700">{{ __('A new verification link has been sent to your email address.') }}</p>
                        @endif
                    @endif
                </div>

                <div>
                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                    <x-text-input id="phone_number" name="phone_number" type="text" class="mt-2 block w-full" :value="old('phone_number', $user->phone_number)" required autocomplete="tel" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                </div>
            </div>
        </div>

        <div class="profile-subpanel space-y-6">
            <div class="profile-subpanel-head">
                <h3 class="profile-subpanel-title">Location</h3>
                <p class="profile-subpanel-text">For Indonesia, administrative levels are loaded automatically. Other countries use manual fields.</p>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-input-label for="country" :value="__('Country')" />
                    <select id="country" name="country" class="mt-2 block w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                        @php
                            $selectedCountry = old('country', $user->country ?? 'Indonesia');
                        @endphp
                        @foreach(['Indonesia', 'Philippines', 'Myanmar', 'Vietnam'] as $countryOption)
                            <option value="{{ $countryOption }}" {{ $selectedCountry === $countryOption ? 'selected' : '' }}>{{ $countryOption }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('country')" />
                </div>

                <div id="province-select-wrapper">
                    <x-input-label for="province_select" :value="__('Province')" />
                    <select id="province_select" name="province" class="mt-2 block w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required data-selected="{{ old('province', $user->province) }}">
                        <option value="">Select Province</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('province')" />
                </div>

                <div id="province-input-wrapper" class="hidden">
                    <x-input-label for="province_input" :value="__('Province')" />
                    <x-text-input id="province_input" name="province" type="text" class="mt-2 block w-full" :value="old('province', $user->province)" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('province')" />
                </div>

                <div id="district-select-wrapper">
                    <x-input-label for="district_select" :value="__('Regency/City (District)')" />
                    <select id="district_select" name="district" class="mt-2 block w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required data-selected="{{ old('district', $user->district) }}">
                        <option value="">Select Regency/City</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('district')" />
                </div>

                <div id="district-input-wrapper" class="hidden">
                    <x-input-label for="district_input" :value="__('Regency/City (District)')" />
                    <x-text-input id="district_input" name="district" type="text" class="mt-2 block w-full" :value="old('district', $user->district)" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('district')" />
                </div>

                <div id="sub-district-select-wrapper" class="md:col-span-2">
                    <x-input-label for="sub_district_select" :value="__('Sub-District')" />
                    <select id="sub_district_select" name="sub_district" class="mt-2 block w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required data-selected="{{ old('sub_district', $user->sub_district) }}">
                        <option value="">Select Sub-District</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('sub_district')" />
                </div>

                <div id="sub-district-input-wrapper" class="hidden md:col-span-2">
                    <x-input-label for="sub_district_input" :value="__('Sub-District')" />
                    <x-text-input id="sub_district_input" name="sub_district" type="text" class="mt-2 block w-full" :value="old('sub_district', $user->sub_district)" disabled />
                    <x-input-error class="mt-2" :messages="$errors->get('sub_district')" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="address" :value="__('Address')" />
                    <textarea id="address" name="address" class="mt-2 block w-full rounded-xl border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" rows="4" required>{{ old('address', $user->address) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="submit" data-profile-save class="profile-primary-btn inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold text-white transition">
                <svg data-save-spinner class="hidden h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity="0.25" stroke-width="3"></circle>
                    <path d="M22 12a10 10 0 00-10-10" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                </svg>
                <span data-save-label>{{ __('Save Changes') }}</span>
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="rounded-lg bg-emerald-50 px-3 py-2 text-xs font-medium text-emerald-700"
                >{{ __('Profile updated successfully.') }}</p>
            @endif
        </div>
    </form>

    <script>
        (() => {
            const form = document.getElementById('profile-update-form');
            if (!form || form.dataset.enhanced === 'true') {
                return;
            }
            form.dataset.enhanced = 'true';

            const saveButton = form.querySelector('[data-profile-save]');
            const saveLabel = form.querySelector('[data-save-label]');
            const saveSpinner = form.querySelector('[data-save-spinner]');

            form.addEventListener('submit', () => {
                if (!saveButton) {
                    return;
                }

                saveButton.disabled = true;
                saveButton.classList.add('opacity-70', 'cursor-not-allowed');

                if (saveLabel) {
                    saveLabel.textContent = 'Saving...';
                }

                if (saveSpinner) {
                    saveSpinner.classList.remove('hidden');
                }
            });

            const photoUpload = document.getElementById('photo_upload');
            const photoPreview = document.getElementById('photo_preview');
            const profilePhotoBase64 = document.getElementById('profile_photo_base64');
            const photoFilename = document.getElementById('photo_filename');

            if (photoUpload && photoPreview && profilePhotoBase64) {
                photoUpload.addEventListener('change', (event) => {
                    const file = event.target.files && event.target.files[0];
                    if (!file) {
                        return;
                    }

                    if (photoFilename) {
                        photoFilename.textContent = file.name;
                    }

                    const reader = new FileReader();
                    reader.onload = (loadEvent) => {
                        const img = new Image();

                        img.onload = () => {
                            const size = Math.min(img.width, img.height);
                            const startX = (img.width - size) / 2;
                            const startY = (img.height - size) / 2;

                            const canvas = document.createElement('canvas');
                            const targetSize = Math.min(size, 420);
                            canvas.width = targetSize;
                            canvas.height = targetSize;

                            const ctx = canvas.getContext('2d');
                            if (!ctx) {
                                return;
                            }

                            ctx.drawImage(img, startX, startY, size, size, 0, 0, targetSize, targetSize);

                            const dataUrl = canvas.toDataURL('image/jpeg', 0.82);
                            photoPreview.src = dataUrl;
                            profilePhotoBase64.value = dataUrl;
                        };

                        img.src = loadEvent.target.result;
                    };

                    reader.readAsDataURL(file);
                });
            }

            const countrySelect = document.getElementById('country');
            const provinceSelect = document.getElementById('province_select');
            const districtSelect = document.getElementById('district_select');
            const subDistrictSelect = document.getElementById('sub_district_select');
            const provinceInput = document.getElementById('province_input');
            const districtInput = document.getElementById('district_input');
            const subDistrictInput = document.getElementById('sub_district_input');
            const provinceSelectWrapper = document.getElementById('province-select-wrapper');
            const districtSelectWrapper = document.getElementById('district-select-wrapper');
            const subDistrictSelectWrapper = document.getElementById('sub-district-select-wrapper');
            const provinceInputWrapper = document.getElementById('province-input-wrapper');
            const districtInputWrapper = document.getElementById('district-input-wrapper');
            const subDistrictInputWrapper = document.getElementById('sub-district-input-wrapper');

            if (!countrySelect || !provinceSelect || !districtSelect || !subDistrictSelect || !provinceInput || !districtInput || !subDistrictInput) {
                return;
            }

            const provinceApiUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
            const regencyApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/';
            const districtApiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/';

            const selectedProv = provinceSelect.getAttribute('data-selected') || '';
            const selectedDist = districtSelect.getAttribute('data-selected') || '';
            const selectedSubDist = subDistrictSelect.getAttribute('data-selected') || '';

            function setIndonesiaMode(isIndonesia) {
                provinceSelectWrapper.classList.toggle('hidden', !isIndonesia);
                districtSelectWrapper.classList.toggle('hidden', !isIndonesia);
                subDistrictSelectWrapper.classList.toggle('hidden', !isIndonesia);
                provinceInputWrapper.classList.toggle('hidden', isIndonesia);
                districtInputWrapper.classList.toggle('hidden', isIndonesia);
                subDistrictInputWrapper.classList.toggle('hidden', isIndonesia);

                provinceSelect.disabled = !isIndonesia;
                districtSelect.disabled = !isIndonesia;
                subDistrictSelect.disabled = !isIndonesia;
                provinceInput.disabled = isIndonesia;
                districtInput.disabled = isIndonesia;
                subDistrictInput.disabled = isIndonesia;

                provinceSelect.required = isIndonesia;
                districtSelect.required = isIndonesia;
                subDistrictSelect.required = isIndonesia;
                provinceInput.required = !isIndonesia;
                districtInput.required = !isIndonesia;
                subDistrictInput.required = !isIndonesia;
            }

            function setLoadingState(select, text) {
                select.innerHTML = `<option value="">${text}</option>`;
            }

            async function fetchProvinces() {
                setLoadingState(provinceSelect, 'Loading provinces...');

                try {
                    const response = await fetch(provinceApiUrl);
                    const provinces = await response.json();

                    provinceSelect.innerHTML = '<option value="">Select Province</option>';
                    provinces.forEach((province) => {
                        const option = document.createElement('option');
                        option.value = province.name;
                        option.dataset.id = province.id;
                        option.textContent = province.name;
                        option.selected = province.name === selectedProv;
                        provinceSelect.appendChild(option);
                    });

                    if (provinceSelect.value) {
                        await fetchRegencies();
                    } else {
                        districtSelect.innerHTML = '<option value="">Select Regency/City</option>';
                        subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
                    }
                } catch (error) {
                    provinceSelect.innerHTML = '<option value="">Unable to load provinces</option>';
                    districtSelect.innerHTML = '<option value="">Select Regency/City</option>';
                    subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
                }
            }

            async function fetchRegencies() {
                const selectedProvince = provinceSelect.options[provinceSelect.selectedIndex];
                const provinceId = selectedProvince ? selectedProvince.dataset.id : null;

                setLoadingState(districtSelect, 'Loading regencies...');
                subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';

                if (!provinceId) {
                    districtSelect.innerHTML = '<option value="">Select Regency/City</option>';
                    return;
                }

                try {
                    const response = await fetch(`${regencyApiBaseUrl}${provinceId}.json`);
                    const regencies = await response.json();

                    districtSelect.innerHTML = '<option value="">Select Regency/City</option>';
                    regencies.forEach((regency) => {
                        const option = document.createElement('option');
                        option.value = regency.name;
                        option.dataset.id = regency.id;
                        option.textContent = regency.name;
                        option.selected = regency.name === selectedDist;
                        districtSelect.appendChild(option);
                    });

                    if (districtSelect.value) {
                        await fetchDistricts();
                    }
                } catch (error) {
                    districtSelect.innerHTML = '<option value="">Unable to load regencies</option>';
                }
            }

            async function fetchDistricts() {
                const selectedRegency = districtSelect.options[districtSelect.selectedIndex];
                const regencyId = selectedRegency ? selectedRegency.dataset.id : null;

                setLoadingState(subDistrictSelect, 'Loading sub-districts...');

                if (!regencyId) {
                    subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
                    return;
                }

                try {
                    const response = await fetch(`${districtApiBaseUrl}${regencyId}.json`);
                    const districts = await response.json();

                    subDistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';
                    districts.forEach((district) => {
                        const option = document.createElement('option');
                        option.value = district.name;
                        option.textContent = district.name;
                        option.selected = district.name === selectedSubDist;
                        subDistrictSelect.appendChild(option);
                    });
                } catch (error) {
                    subDistrictSelect.innerHTML = '<option value="">Unable to load sub-districts</option>';
                }
            }

            async function switchLocationMode() {
                const isIndonesia = countrySelect.value === 'Indonesia';
                setIndonesiaMode(isIndonesia);

                if (isIndonesia) {
                    await fetchProvinces();
                }
            }

            provinceSelect.addEventListener('change', async () => {
                districtSelect.value = '';
                subDistrictSelect.value = '';
                await fetchRegencies();
            });

            districtSelect.addEventListener('change', async () => {
                subDistrictSelect.value = '';
                await fetchDistricts();
            });

            countrySelect.addEventListener('change', switchLocationMode);
            switchLocationMode();
        })();
    </script>
</section>
