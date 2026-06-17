<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Tropical Anguillid Eel Data') }}
        </h2>
        <p class="text-sm text-gray-600 mt-1">{{ __('Update the monitoring data record for this eel collection site') }}</p>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8 bg-white">
                    @include('sidat.partials.form', [
                        'sidat' => $sidat,
                        'action' => route('sidat.update', $sidat->id),
                        'method' => 'PUT',
                        'submitText' => __('Update Data'),
                        'cancelUrl' => route('sidat.index')
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
