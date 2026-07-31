<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" x-data="{ passwordRow: '{{ old('target_user_id', '') }}' }">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-4 border border-slate-100">
                    <p class="text-xs uppercase tracking-wider text-gray-500">Total Records</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800">{{ number_format($users->total()) }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-4 border border-slate-100">
                    <p class="text-xs uppercase tracking-wider text-gray-500">Current Page</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800">{{ number_format($users->count()) }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-4 border border-slate-100">
                    <p class="text-xs uppercase tracking-wider text-gray-500">Filter</p>
                    <p class="mt-1 text-sm font-medium text-slate-700 truncate">
                        {{ request('q') ? 'Search: "' . request('q') . '"' : 'No active filter' }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                        <div class="md:col-span-4">
                            <x-input-label for="q" :value="__('Search Users')" />
                            <div class="relative mt-2">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35m0 0A7.65 7.65 0 1 0 5.82 5.82a7.65 7.65 0 0 0 10.83 10.83Z" />
                                    </svg>
                                </span>
                                <x-text-input
                                    id="q"
                                    name="q"
                                    type="text"
                                    class="block w-full pl-9"
                                    :value="request('q')"
                                    placeholder="Find by name or email"
                                />
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <x-primary-button class="w-full justify-center">{{ __('Search') }}</x-primary-button>
                            <a href="{{ route('admin.users.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Reset</a>
                        </div>
                    </form>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-slate-50 transition-colors duration-200 align-top">
                                        <td class="px-6 py-4">
                                            <p class="text-sm font-semibold text-slate-800">{{ trim($user->first_name . ' ' . $user->last_name) }}</p>
                                            <p class="text-sm text-slate-500">{{ $user->email }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="block w-full sm:w-44 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="enum" {{ $user->role === 'enum' ? 'selected' : '' }}>Enumerator</option>
                                                </select>
                                                <x-primary-button type="submit">{{ __('Save Role') }}</x-primary-button>
                                            </form>
                                            <div class="mt-2">
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->isAdmin() ? 'bg-green-100 text-green-800' : ($user->role === 'enum' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700') }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button
                                                type="button"
                                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-white bg-sky-600 rounded-md hover:bg-sky-700 transition"
                                                @click="passwordRow = passwordRow == '{{ $user->id }}' ? '' : '{{ $user->id }}'"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 5.25v-1.5a3.75 3.75 0 1 0-7.5 0v1.5m-1.5 0h10.5a1.5 1.5 0 0 1 1.5 1.5v10.5a1.5 1.5 0 0 1-1.5 1.5H6.75a1.5 1.5 0 0 1-1.5-1.5V6.75a1.5 1.5 0 0 1 1.5-1.5Z" />
                                                </svg>
                                                <span x-text="passwordRow == '{{ $user->id }}' ? 'Close Reset Panel' : 'Reset Password'"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr x-show="passwordRow == '{{ $user->id }}'" x-transition class="bg-sky-50/50">
                                        <td colspan="3" class="px-6 py-4">
                                            <form action="{{ route('admin.users.updatePassword', $user->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-4 gap-3 items-end">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="target_user_id" value="{{ $user->id }}">

                                                <div class="lg:col-span-2">
                                                    <x-input-label :value="__('New Password')" />
                                                    <x-text-input name="password" type="password" class="block mt-2 w-full" placeholder="Enter new password" required />
                                                </div>
                                                <div>
                                                    <x-input-label :value="__('Confirm Password')" />
                                                    <x-text-input name="password_confirmation" type="password" class="block mt-2 w-full" placeholder="Re-type password" required />
                                                </div>
                                                <div>
                                                    <x-primary-button type="submit" class="w-full justify-center">{{ __('Update Password') }}</x-primary-button>
                                                </div>

                                                @if ((string) old('target_user_id') === (string) $user->id)
                                                    <div class="lg:col-span-4">
                                                        <x-input-error :messages="$errors->adminUpdatePassword->get('password')" class="mt-1" />
                                                    </div>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-sm text-gray-500 text-center">
                                            No users matched your search.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Script for success/error messages -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            })
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}'
            })
        </script>
    @endif
</x-app-layout>
