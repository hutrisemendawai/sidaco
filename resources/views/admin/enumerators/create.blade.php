<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Create Enumerator Account') }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">{{ __('Generate new enumerator accounts for data collectors') }}</p>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8 bg-white">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-8 p-6 bg-green-50 border-l-4 border-green-500 rounded-lg">
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="font-semibold text-green-800 text-lg">{{ __('Success!') }}</h3>
                            </div>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Enumerator Account Section -->
                    <div class="border-b-2 border-gray-100 pb-8">
                        <div class="flex items-center mb-8">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ __('Generate Enumerator Account') }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ __('Automatically create accounts with unique credentials for data collectors') }}</p>
                            </div>
                        </div>

                    <form method="POST" action="{{ route('admin.enumerator.store') }}" x-data="{ multiple: false }" class="space-y-8">
                        @csrf

                        <!-- Account Generation Mode -->
                        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-lg border border-purple-200">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="checkbox" name="multiple" x-model="multiple" class="w-5 h-5 rounded border-purple-300 text-purple-600 shadow-sm focus:ring-purple-500 cursor-pointer">
                                <span class="ms-3 text-base font-semibold text-gray-800 group-hover:text-purple-700 transition">{{ __('Generate Multiple Accounts') }}</span>
                            </label>
                            <p class="text-sm text-gray-600 mt-2 ml-8">{{ __('Choose whether to create a single account or multiple accounts at once') }}</p>

                            <!-- Multiple Accounts Count Input -->
                            <div x-show="multiple" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200" class="mt-6 max-w-xs">
                                <x-input-label for="count" :value="__('Number of Accounts')" />
                                <x-text-input id="count" name="count" type="number" class="block mt-2 w-full py-2.5" min="2" max="30" value="2" />
                                <p class="mt-2 text-xs text-gray-500">
                                    <span class="font-medium">{{ __('Range:') }}</span> {{ __('Minimum 2, Maximum 30 accounts') }}
                                </p>
                            </div>
                        </div>

                        <!-- Single Account Information -->
                        <div x-show="!multiple" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200" class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg border border-blue-200">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Account Information (Optional)') }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-4">{{ __('Leave blank to auto-generate or enter optional account details') }}</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <x-text-input id="first_name" name="first_name" type="text" class="block mt-2 w-full py-2.5" placeholder="Optional" />
                                </div>
                                <div>
                                    <x-input-label for="middle_name" :value="__('Middle Name')" />
                                    <x-text-input id="middle_name" name="middle_name" type="text" class="block mt-2 w-full py-2.5" placeholder="Optional" />
                                </div>
                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="block mt-2 w-full py-2.5" placeholder="Optional" />
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-8 border-t-2 border-gray-100">
                            <a href="{{ route('admin.enumerators.index') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Back') }}
                            </a>

                            <button type="submit" class="inline-flex items-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                                </svg>
                                <span x-text="multiple ? '{{ __('Generate Accounts') }}' : '{{ __('Generate Account') }}'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
