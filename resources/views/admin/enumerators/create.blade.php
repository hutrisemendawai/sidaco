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

                    <form method="POST" action="{{ route('admin.enumerator.store') }}">
                        @csrf
                        <x-primary-button>
                            {{ __('Create Account Automatically') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
