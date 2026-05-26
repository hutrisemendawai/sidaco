<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Enumerator Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Generate Enumerator Account') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Click the button below to automatically generate a new enumerator account. The system will create a unique username and password for you.') }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.enumerator.store') }}" x-data="{ multiple: false }">
                        @csrf

                        <!-- Multiple Accounts Toggle -->
                        <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="multiple" x-model="multiple" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ms-2 text-sm font-medium text-gray-900">{{ __('Generate Multiple Accounts') }}</span>
                            </label>

                            <div x-show="multiple" x-transition class="mt-4">
                                <x-input-label for="count" :value="__('Number of accounts to generate')" />
                                <x-text-input id="count" name="count" type="number" class="mt-1 block w-24" min="2" max="30" value="2" />
                                <p class="mt-1 text-xs text-gray-500">{{ __('Minimum 2, Maximum 30 accounts.') }}</p>
                            </div>
                        </div>

                        <!-- Optional Names (Single Account Only) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6" x-show="!multiple" x-transition>
                            <div>
                                <x-input-label for="first_name" :value="__('First Name (Optional)')" />
                                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" x-bind:disabled="multiple" />
                            </div>
                            <div>
                                <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" />
                                <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" x-bind:disabled="multiple" />
                            </div>
                            <div>
                                <x-input-label for="last_name" :value="__('Last Name (Optional)')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" x-bind:disabled="multiple" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                <span x-text="multiple ? '{{ __('Generate Accounts') }}' : '{{ __('Generate Account') }}'"></span>
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
