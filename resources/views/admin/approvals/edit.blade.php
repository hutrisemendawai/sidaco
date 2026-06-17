<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Review & Edit Pending Data') }}
            </h2>
            <a href="{{ route('admin.approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; {{ __('Back to Approvals') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Requester info banner --}}
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center gap-4 shadow-sm">
                <img src="{{ $sidat->user->avatarUrl() }}" alt="Avatar" class="h-12 w-12 rounded-full object-cover border-2 border-white shadow-sm" />
                <div>
                    <p class="text-sm font-semibold text-blue-800">{{ __('Submitted by:') }} {{ $sidat->user->first_name }} {{ $sidat->user->last_name }}</p>
                    <p class="text-xs text-blue-600">{{ $sidat->user->email }} &mdash; {{ __('Submitted on') }} {{ $sidat->created_at->format('d M Y, H:i') }}</p>
                    @if($sidat->updatedBy)
                        <p class="text-xs text-blue-500 mt-1 italic">{{ __('Last edited by:') }} {{ $sidat->updatedBy->first_name }} {{ $sidat->updatedBy->last_name }} {{ __('on') }} {{ $sidat->updated_at->format('d M Y, H:i') }}</p>
                    @endif
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-8">
                    @include('sidat.partials.form', [
                        'sidat' => $sidat,
                        'action' => route('admin.approvals.update', $sidat->id),
                        'method' => 'PUT',
                        'submitText' => __('Save Changes'),
                        'cancelUrl' => route('admin.approvals.index'),
                        'showApprove' => true,
                        'showReject' => true
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
