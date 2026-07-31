<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/seafdeclogo.png') }}" type="image/png"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-ambient relative isolate min-h-screen overflow-hidden">
            <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-white/60 to-transparent"></div>
            <div class="animate-auth-drift absolute left-[-5rem] top-16 h-40 w-40 rounded-full bg-emerald-200/60 blur-3xl"></div>
            <div class="animate-auth-drift absolute bottom-10 right-[-4rem] h-56 w-56 rounded-full bg-cyan-200/50 blur-3xl"></div>

            <div class="relative flex min-h-screen items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
                <div class="auth-card-shadow w-full max-w-6xl overflow-hidden rounded-[30px] border border-white/70 bg-white/85 backdrop-blur-xl">
                    <div class="grid lg:grid-cols-[minmax(0,1.05fr)_minmax(360px,440px)]">
                        <div class="auth-panel auth-grid-noise relative hidden min-h-full overflow-hidden lg:flex lg:flex-col lg:justify-between lg:px-10 lg:py-10 lg:text-slate-900">
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.18),_transparent_28%),radial-gradient(circle_at_bottom_left,_rgba(16,185,129,0.24),_transparent_36%)]"></div>
                            <div class="relative">
                                <a href="/" class="inline-flex items-center gap-3 rounded-full bg-white/10 px-4 py-2.5 ring-1 ring-white/15 backdrop-blur-sm">
                                    <x-application-logo class="h-10 w-auto opacity-90" />
                                    <div>
                                        <p class="text-[11px] font-medium uppercase tracking-[0.32em] text-slate-700/75">SEAFDEC</p>
                                        <p class="text-sm font-semibold text-slate-900">{{ config('app.name', 'SIDACO') }}</p>
                                    </div>
                                </a>
                            </div>

                            <div class="relative max-w-lg">
                                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-700/75">Data coordination workspace</p>
                                <h1 class="mt-5 max-w-md text-4xl font-semibold leading-tight tracking-tight text-slate-900">Secure access for daily eel catch reporting and review.</h1>
                                <p class="mt-5 max-w-md text-sm leading-7 text-slate-800/90">Move from field submissions to approval and monitoring in a single focused flow, with a lighter interface that stays quick to load.</p>
                            </div>

                            <div class="relative grid max-w-md grid-cols-2 gap-4 text-sm text-slate-800/90">
                                <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-4 backdrop-blur-sm">
                                    <p class="text-[11px] uppercase tracking-[0.24em] text-slate-700/75">Secure</p>
                                    <p class="mt-2 font-medium text-slate-900">Credential-based access with existing Laravel auth flow.</p>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-4 backdrop-blur-sm">
                                    <p class="text-[11px] uppercase tracking-[0.24em] text-slate-700/75">Fast</p>
                                    <p class="mt-2 font-medium text-slate-900">Static gradients, no heavy media, no extra runtime scripts.</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative bg-slate-50/90 px-6 py-8 text-slate-900 sm:px-10 sm:py-10 lg:px-12 lg:py-12">
                            <div class="mb-8 flex items-center gap-3 lg:hidden">
                                <a href="/" class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-950/5 ring-1 ring-emerald-950/10">
                                    <x-application-logo class="h-8 w-auto opacity-90" />
                                </a>
                                <div>
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-emerald-700/70">SEAFDEC</p>
                                    <p class="text-sm font-semibold text-slate-900">{{ config('app.name', 'SIDACO') }}</p>
                                </div>
                            </div>

                            <div class="animate-auth-fade-up text-slate-900">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
