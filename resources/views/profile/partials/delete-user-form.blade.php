<section class="space-y-5">
    <div class="rounded-2xl border border-rose-200 bg-rose-50/70 p-4 sm:p-5">
        <h3 class="text-sm font-semibold text-rose-900">Permanent deletion</h3>
        <p class="mt-2 text-sm text-rose-900/80">
            Deleting your account removes access and permanently deletes associated resources. This cannot be undone.
        </p>
    </div>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center rounded-xl border border-rose-300 bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-7">
            @csrf
            @method('delete')

            <div class="flex items-start gap-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01m8.938-5A9 9 0 1112 3a9 9 0 018.938 9z" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">{{ __('Delete your account?') }}</h2>
                    <p class="mt-1 text-sm text-slate-600">
                        {{ __('Once deleted, all related resources and data are permanently removed. Enter your password to confirm.') }}
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full"
                    placeholder="{{ __('Enter your password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
