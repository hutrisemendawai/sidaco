<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIDACO') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/seafdeclogo.png') }}" type="image/x-icon"/>

        <!-- Fonts (Inter & Plus Jakarta Sans) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- GSAP and Tailwind Elements -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        
        <!-- Chart.js for Dashboard Charts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        
        <!-- jQuery for AJAX -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            }
            .sidebar-link-active {
                background-color: #f0fdf4; /* emerald-50 */
                color: #065f46; /* emerald-800 */
                font-weight: 600;
            }
            .sidebar-link-active svg {
                color: #059669; /* emerald-600 */
            }
        </style>
    </head>
    <body class="h-full bg-[#f4f7f6] antialiased text-slate-800 font-medium">
        <div class="min-h-screen flex" x-data="{ mobileSidebarOpen: false }">
            
            <!-- DESKTOP SIDEBAR -->
            <aside class="w-72 flex-shrink-0 hidden lg:flex flex-col justify-start space-y-8 bg-white rounded-3xl border border-gray-100 shadow-sm m-4 mr-0 p-6 relative overflow-hidden" id="desktop-sidebar">
                <!-- Top Brand Area -->
                <div class="flex flex-col space-y-6">
                    <div class="flex items-center space-x-3 px-2">
                        <div class="p-2.5 bg-emerald-50 rounded-2xl border border-emerald-100 transition-transform duration-300 hover:rotate-6 flex-shrink-0">
                            <img src="{{ asset('images/seafdeclogo.png') }}" alt="SIDACO Logo" class="h-8 w-auto">
                        </div>
                        <div>
                            <span class="text-xl font-bold tracking-tight text-emerald-950 block">SIDACO</span>
                            <span class="text-[10px] text-gray-500 font-semibold tracking-wider uppercase block -mt-1">Eel Data System</span>
                        </div>
                    </div>

                    <!-- Navigation Items -->
                    <div class="flex flex-col space-y-7">
                        <!-- MENU Section -->
                        <div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase px-3 block mb-3">Menu</span>
                            <nav class="space-y-1">
                                @if(!Auth::user()->isEnum())
                                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                                        </svg>
                                        <span class="text-sm">Dashboard</span>
                                    </a>

                                    <a href="{{ route('sidat.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('sidat.*') ? 'sidebar-link-active' : '' }}">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            <span class="text-sm">Eel Database</span>
                                        </div>
                                    </a>
                                @endif

                                @if(Auth::user()->isEnum())
                                    <a href="{{ route('enum.sidat.create') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('enum.sidat.*') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-sm">Input Data</span>
                                    </a>
                                @endif

                                @if(Auth::user()->isAdmin())
                                    <div class="h-[1px] bg-gray-100 my-2 mx-3"></div>
                                    
                                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('admin.users.index') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="text-sm">User Management</span>
                                    </a>

                                    <a href="{{ route('admin.approvals.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('admin.approvals.*') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="text-sm">Data Approvals</span>
                                    </a>

                                    <a href="{{ route('register') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('register') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                        <span class="text-sm">Create Provider</span>
                                    </a>
                                @endif
                            </nav>
                        </div>

                        <!-- GENERAL Section -->
                        <div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase px-3 block mb-3">General</span>
                            <nav class="space-y-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 text-gray-600 transition-all group {{ request()->routeIs('profile.edit') ? 'sidebar-link-active' : '' }}">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">Settings</span>
                                </a>

                                <form method="POST" action="{{ route('logout') }}" id="sidebar-logout">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 text-gray-600 hover:text-rose-700 transition-all group">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-rose-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span class="text-sm">Logout</span>
                                    </button>
                                </form>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- MOBILE SIDEBAR DRAWER -->
            <div 
                x-show="mobileSidebarOpen" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 lg:hidden"
                style="display: none;"
                @keydown.escape.window="mobileSidebarOpen = false"
            >
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="mobileSidebarOpen = false"></div>

                <!-- Content Drawer -->
                <div 
                    x-show="mobileSidebarOpen" 
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full"
                    class="fixed inset-y-0 left-0 w-80 bg-white p-6 shadow-2xl flex flex-col justify-between"
                >
                    <div class="flex flex-col space-y-6">
                        <!-- Brand/Close -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-emerald-50 rounded-xl">
                                    <img src="{{ asset('images/seafdeclogo.png') }}" alt="SIDACO Logo" class="h-6 w-auto">
                                </div>
                                <span class="text-lg font-bold text-emerald-950">SIDACO</span>
                            </div>
                            <button @click="mobileSidebarOpen = false" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Menu items repeat -->
                        <div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase mb-3 block px-3">Menu</span>
                            <nav class="space-y-1">
                                @if(!Auth::user()->isEnum())
                                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                                        </svg>
                                        <span class="text-sm">Dashboard</span>
                                    </a>

                                    <a href="{{ route('sidat.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('sidat.*') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        <span class="text-sm">Eel Database</span>
                                    </a>
                                @endif

                                @if(Auth::user()->isEnum())
                                    <a href="{{ route('enum.sidat.create') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('enum.sidat.*') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-sm">Input Data</span>
                                    </a>
                                @endif

                                @if(Auth::user()->isAdmin())
                                    <div class="h-[1px] bg-gray-100 my-2 mx-3"></div>
                                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('admin.users.index') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="text-sm">User Management</span>
                                    </a>
                                    <a href="{{ route('admin.approvals.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('admin.approvals.*') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="text-sm">Data Approvals</span>
                                    </a>
                                    <a href="{{ route('register') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('register') ? 'sidebar-link-active' : '' }}">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                        <span class="text-sm">Create Provider</span>
                                    </a>
                                @endif
                            </nav>
                        </div>

                        <!-- General section repeat -->
                        <div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider uppercase mb-3 block px-3">General</span>
                            <nav class="space-y-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-slate-50 text-gray-600 group {{ request()->routeIs('profile.edit') ? 'sidebar-link-active' : '' }}">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">Settings</span>
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-rose-50 hover:text-rose-700 text-gray-600 group">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-rose-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span class="text-sm">Logout</span>
                                    </button>
                                </form>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT AREA -->
            <div class="flex-1 flex flex-col min-w-0 min-h-screen">
                
                <!-- TOP BAR -->
                <header class="h-20 bg-white border-b border-gray-100/80 px-6 sm:px-8 flex items-center justify-between flex-shrink-0 mx-4 mt-4 rounded-2xl shadow-sm border border-gray-100" id="main-topbar">
                    <!-- Hamburger & Search Container -->
                    <div class="flex items-center space-x-4 flex-1">
                        <button @click="mobileSidebarOpen = true" class="lg:hidden p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-50 select-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                    </div>

                    <!-- Actions & User Profile -->
                    <div class="flex items-center space-x-5 select-none">
                        <!-- Divider -->
                        <div class="hidden sm:block h-6 w-[1px] bg-gray-150"></div>

                        <!-- User Profile Link -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center text-left group focus:outline-none py-1.5 px-3 rounded-full hover:bg-slate-50 transition-all select-none">
                            <div class="me-3 hidden md:block">
                                <span class="text-sm font-semibold text-slate-900 group-hover:text-emerald-800 transition-colors block text-right">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                <span class="text-[10px] text-gray-500 font-semibold tracking-wide block -mt-1 text-right">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="relative flex-shrink-0">
                                <img src="{{ Auth::user()->avatarUrl() }}" alt="Avatar" class="h-9 w-9 rounded-full object-cover border border-gray-150 ring-2 ring-emerald-50 ring-offset-0 transition-transform duration-300 group-hover:scale-105">
                                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></div>
                            </div>
                        </a>
                    </div>
                </header>

                <!-- PAGE CONTENT SLOT -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto px-6 sm:px-8 py-6" id="main-content-slot">
                    
                    <!-- COMPATIBLE TITLE HEADER -->
                    @if (isset($header))
                        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0" id="compat-page-header">
                            <div>
                                <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">
                                    {{ $header }}
                                </h1>
                                <p class="text-xs text-gray-500 font-semibold mt-1">
                                    Tropical Anguillid Eel Data and Stock Assessment Dashboard.
                                </p>
                            </div>
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- GSAP ENTRANCE ANIMATIONS -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize premium entrance animations
                if (window.gsap) {
                    const tl = gsap.timeline({ defaults: { ease: "power3.out" } });

                    // Sidebar entrance
                    if (document.getElementById("desktop-sidebar")) {
                        tl.from("#desktop-sidebar", {
                            x: -50,
                            opacity: 0,
                            duration: 1.1,
                        });
                    }

                    // Topbar entrance
                    if (document.getElementById("main-topbar")) {
                        tl.from("#main-topbar", {
                            y: -30,
                            opacity: 0,
                            duration: 0.9,
                        }, "-=0.8");
                    }

                    // Header text and slot container entrance (only if element exists)
                    if (document.getElementById("compat-page-header")) {
                        tl.from("#compat-page-header", {
                            y: 20,
                            opacity: 0,
                            duration: 0.8,
                        }, "-=0.6");
                    }

                    // Animate list items/elements inside main slot if they have appropriate classes
                    const mainContentSlot = document.getElementById("main-content-slot");
                    if (mainContentSlot && mainContentSlot.children.length > 0) {
                        gsap.from("#main-content-slot > div", {
                            y: 30,
                            opacity: 0,
                            duration: 1.0,
                            stagger: 0.15,
                        }, "-=0.5");
                    }
                }
            });
        </script>
    </body>
</html>
