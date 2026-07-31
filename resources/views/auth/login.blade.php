<x-guest-layout>
    <div class="mx-auto w-full max-w-sm">
        <div class="mb-8">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-600/80">Welcome back</p>
            <h2 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900">Sign in to continue</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">Use your registered account to access submissions, approvals, and reporting tools.</p>
        </div>

        <x-auth-session-status
            class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
            :status="session('status')"
        />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

            <div>
                <x-input-label for="email" :value="__('Email address')" class="text-sm font-medium text-slate-700" />
                <x-text-input
                    id="email"
                    class="mt-2 block w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="name@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-slate-700" />

                <x-text-input
                    id="password"
                    class="mt-2 block w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
            >
                {{ __('Log in') }}
            </button>
        </form>
    </div>
</x-guest-layout>
