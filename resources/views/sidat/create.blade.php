<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Add New Tropical Anguillid Eel Data') }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">{{ __('Please fill in all required fields to record new SIDAT monitoring data') }}</p>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8 bg-white">
                    @include('sidat.partials.form', [
                        'action' => route('sidat.store'),
                        'submitText' => __('Save Data'),
                        'cancelUrl' => route('dashboard')
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
