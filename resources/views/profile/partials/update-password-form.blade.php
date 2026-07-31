<section>
    <form id="profile-password-form" method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2 block w-full" autocomplete="new-password" />
            <p class="mt-2 text-xs text-slate-500">Use at least 8 characters with a mix of letters, numbers, and symbols.</p>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="submit" data-password-save class="profile-primary-btn inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-white transition">
                <svg data-password-spinner class="hidden h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity="0.25" stroke-width="3"></circle>
                    <path d="M22 12a10 10 0 00-10-10" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                </svg>
                <span data-password-label>{{ __('Update Password') }}</span>
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="rounded-lg bg-emerald-50 px-3 py-2 text-xs font-medium text-emerald-700"
                >{{ __('Password updated successfully.') }}</p>
            @endif
        </div>
    </form>

    <script>
        (() => {
            const form = document.getElementById('profile-password-form');
            if (!form || form.dataset.enhanced === 'true') {
                return;
            }
            form.dataset.enhanced = 'true';

            const button = form.querySelector('[data-password-save]');
            const label = form.querySelector('[data-password-label]');
            const spinner = form.querySelector('[data-password-spinner]');

            form.addEventListener('submit', () => {
                if (!button) {
                    return;
                }

                button.disabled = true;
                button.classList.add('opacity-70', 'cursor-not-allowed');

                if (label) {
                    label.textContent = 'Updating...';
                }

                if (spinner) {
                    spinner.classList.remove('hidden');
                }
            });
        })();
    </script>
</section>
