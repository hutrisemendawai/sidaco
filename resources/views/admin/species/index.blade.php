<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Species Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Add New Species') }}</h3>
                    <form action="{{ route('admin.species.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        @csrf
                        <div class="md:col-span-3">
                            <x-input-label for="name" :value="__('Species Name')" />
                            <x-text-input id="name" name="name" type="text" class="block mt-2 w-full" :value="old('name')" required />
                            @error('name')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <x-primary-button class="w-full justify-center">{{ __('Add Species') }}</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.species.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="md:col-span-2">
                            <x-input-label for="q" :value="__('Search Species')" />
                            <x-text-input id="q" name="q" type="text" class="block mt-2 w-full" :value="request('q')" placeholder="Search by species name" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <x-primary-button class="w-full justify-center">{{ __('Filter') }}</x-primary-button>
                            <a href="{{ route('admin.species.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">Reset</a>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Species Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($species as $item)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <form action="{{ route('admin.species.update', $item) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                @method('PUT')
                                                <x-text-input name="name" type="text" class="w-full" :value="$item->name" required />
                                                <button type="submit" class="px-3 py-2 text-xs font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Save</button>
                                            </form>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex gap-2">
                                                <form action="{{ route('admin.species.toggle-status', $item) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-2 text-xs font-semibold rounded-md {{ $item->is_active ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                                                        {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.species.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this species? Existing SIDAT data will stay unchanged.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-2 text-xs font-semibold text-red-700 bg-red-100 rounded-md hover:bg-red-200">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500">No species found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $species->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
