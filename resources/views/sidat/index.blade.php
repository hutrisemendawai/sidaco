<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sidat Data Management') }}
        </h2>
    </x-slot>

    <div x-data="{ qrModalOpen: false, qrCodeSvg: '' }">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        {{-- Action Buttons & Search --}}
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <div class="flex space-x-2 mb-4 md:mb-0">
                                <a href="{{ route('sidat.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">Add New Data</a>
                                <a href="{{ route('sidat.export', $request->query()) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">Export to Excel</a>
                            </div>
                            <form action="{{ route('sidat.index') }}" method="GET" class="w-full md:w-1/2">
                                <div class="flex"><input type="text" name="search" placeholder="Search..." class="w-full border-gray-300 rounded-l-md shadow-sm" value="{{ $request->search }}"><button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-r-md font-semibold text-xs text-white uppercase hover:bg-gray-700">Search</button></div>
                            </form>
                        </div>

                        {{-- Filters --}}
                        <div x-data="{ open: {{ $request->anyFilled(['start_date', 'end_date']) ? 'true' : 'false' }} }" class="bg-gray-50 p-4 rounded-lg mb-6">
                            <button @click="open = !open" class="flex items-center justify-between w-full text-lg font-medium text-gray-700"><span>Advanced Filters</span><svg class="w-6 h-6 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                            <div x-show="open" x-transition class="mt-4"><form action="{{ route('sidat.index') }}" method="GET"><input type="hidden" name="search" value="{{ $request->search }}"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"><div><label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label><input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $request->start_date }}"></div><div><label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label><input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $request->end_date }}"></div><div class="flex items-end space-x-2"><button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700">Apply</button><a href="{{ route('sidat.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-400">Reset</a></div></div></form></div>
                        </div>

                        {{-- Table Container --}}
                        <div id="table-container" class="relative overflow-auto shadow-md rounded-lg max-h-[70vh]">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100 sticky top-0">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">QR Code</th>
                                        @if(Auth::user()->isAdmin())<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>@endif
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">River</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fisherman</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Species</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight (Kg/day)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($sidatData as $data)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4">
                                                @php
                                                    $qrUrl = route('sidat.public.show', $data->id);
                                                    $logoPath = public_path('images/seafdeclogo.png');
                                                    
                                                    if (file_exists($logoPath) && is_readable($logoPath)) {
                                                        $largeQrCode = QrCode::size(250)->merge($logoPath, .25, true)->generate($qrUrl);
                                                        $smallQrCode = QrCode::size(40)->merge($logoPath, .3, true)->generate($qrUrl);
                                                    } else {
                                                        $largeQrCode = QrCode::size(250)->generate($qrUrl);
                                                        $smallQrCode = QrCode::size(40)->generate($qrUrl);
                                                    }
                                                @endphp
                                                <button @click="qrModalOpen = true; qrCodeSvg = `{{ base64_encode($largeQrCode) }}`" class="focus:outline-none">
                                                    {!! $smallQrCode !!}
                                                </button>
                                            </td>
                                            @if(Auth::user()->isAdmin())<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->user->first_name ?? 'N/A' }}</td>@endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->date->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->river }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->fisherman_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->species_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($data->total_weight_per_day, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-4">
                                                    <a href="{{ route('sidat.edit', $data->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg></a>
                                                    <form id="delete-form-{{ $data->id }}" action="{{ route('sidat.destroy', $data->id) }}" method="POST" class="inline-block">@csrf @method('DELETE')<button type="button" onclick="confirmDelete({{ $data->id }})" class="text-red-600 hover:text-red-900" title="Delete"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-h3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" /></svg></button></form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="{{ Auth::user()->isAdmin() ? '8' : '7' }}" class="px-6 py-4 text-center text-sm text-gray-500">No data found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6 bg-white px-4 py-3 rounded-lg shadow">{{ $sidatData->links() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Code Modal -->
        <div x-show="qrModalOpen" @click.away="qrModalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div @click.away="qrModalOpen = false" class="bg-white p-6 rounded-lg shadow-xl text-center">
                <h3 class="text-lg font-medium mb-4">Scan QR Code</h3>
                <div x-html="atob(qrCodeSvg)"></div>
                <button @click="qrModalOpen = false" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-300 border rounded-md font-semibold text-xs text-gray-700 uppercase hover:bg-gray-400">Close</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))<script>Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false })</script>@endif
    <script>function confirmDelete(id){Swal.fire({title:'Are you sure?',text:"You won't be able to revert this!",icon:'warning',showCancelButton:true,confirmButtonColor:'#3b82f6',cancelButtonColor:'#ef4444',confirmButtonText:'Yes, delete it!'}).then((result)=>{if(result.isConfirmed){document.getElementById('delete-form-'+id).submit();}})}</script>
</x-app-layout>
