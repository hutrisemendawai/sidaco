<x-app-layout>
    <div class="py-8 sm:py-10 profile-page-shell">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
            <section class="profile-hero-card overflow-hidden rounded-3xl border border-emerald-100/80 bg-white shadow-sm">
                <div class="profile-hero-bg px-6 py-7 sm:px-8 sm:py-8 lg:px-10">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center gap-4 sm:gap-5">
                            <img
                                src="{{ $user->avatarUrl() }}"
                                alt="{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Profile photo' }}"
                                class="h-16 w-16 rounded-2xl border border-white/70 object-cover shadow-md sm:h-20 sm:w-20"
                            />
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-emerald-700/70">Settings</p>
                                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Profile &amp; Account</h1>
                                <p class="mt-1 text-sm text-slate-600">Manage your identity, location, password, and account safety in one place.</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <span class="profile-chip">{{ $user->country ?? 'Country not set' }}</span>
                            <span class="profile-chip">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <div class="grid gap-6 xl:grid-cols-[minmax(0,1.8fr)_minmax(320px,1fr)]">
                <section class="profile-panel rounded-3xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-8">
                    <div class="profile-section-head">
                        <p class="profile-kicker">Account</p>
                        <h2 class="profile-title">Personal information</h2>
                        <p class="profile-subtitle">Keep your profile complete so data ownership and records stay accurate.</p>
                    </div>
                    <div class="mt-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                <div class="space-y-6">
                    <section class="profile-panel rounded-3xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-8">
                        <div class="profile-section-head">
                            <p class="profile-kicker">Security</p>
                            <h2 class="profile-title">Password</h2>
                            <p class="profile-subtitle">Use a strong password and update it regularly.</p>
                        </div>
                        <div class="mt-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </section>

                    <section class="profile-panel rounded-3xl border border-rose-200/80 bg-white p-5 shadow-sm sm:p-8">
                        <div class="profile-section-head">
                            <p class="profile-kicker text-rose-700/90">Danger zone</p>
                            <h2 class="profile-title">Delete account</h2>
                            <p class="profile-subtitle">This action is irreversible. Make sure you understand the impact before continuing.</p>
                        </div>
                        <div class="mt-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
