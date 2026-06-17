<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tropical Anguillid Eel Data - ID: {{ $sidat->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">
    <div class="min-h-screen py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg shadow-lg p-6 mb-6">
                <div>
                    <h1 class="text-3xl font-bold">Tropical Anguillid Eel Data Details</h1>
                    <p class="text-emerald-100 mt-2">Record ID: #{{ $sidat->id }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Photo Section -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-100 p-4">
                            <h3 class="text-lg font-semibold text-gray-800">Fish Photo</h3>
                        </div>
                        <div class="p-4">
                            @if($sidat->fish_photo)
                                <img src="{{ asset('storage/' . $sidat->fish_photo) }}" alt="Fish Photo" class="w-full h-80 object-cover rounded-lg shadow-md">
                                <p class="text-xs text-gray-500 mt-2 text-center">Photo uploaded on {{ $sidat->updated_at->format('d M Y') }}</p>
                            @else
                                <div class="w-full h-80 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-gray-500">No photo uploaded</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="lg:col-span-2">
                    <!-- Location Information -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 text-white">
                            <h3 class="text-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                Location Information
                            </h3>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Country</p>
                                <p class="text-lg text-gray-900">{{ $sidat->country }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Province</p>
                                <p class="text-lg text-gray-900">{{ $sidat->province }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Regency</p>
                                <p class="text-lg text-gray-900">{{ $sidat->regency }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">District</p>
                                <p class="text-lg text-gray-900">{{ $sidat->district }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">River</p>
                                <p class="text-lg text-gray-900">{{ $sidat->river }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Stage</p>
                                <p class="text-lg text-gray-900">{{ $sidat->stage }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fishing Information -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4 text-white">
                            <h3 class="text-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.657 14.243a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM11 17a1 1 0 102 0v-1a1 1 0 10-2 0v1zM5.757 15.657a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zM5.757 4.343a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707z"></path></svg>
                                Fishing Information
                            </h3>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Date</p>
                                <p class="text-lg text-gray-900">{{ $sidat->date->format('d F Y') }} ({{ $sidat->day }})</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Fisherman Name</p>
                                <p class="text-lg text-gray-900">{{ $sidat->fisher_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Number of Fishermen</p>
                                <p class="text-lg text-gray-900">{{ $sidat->number_of_fisher }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Fishing Gear Type</p>
                                <p class="text-lg text-gray-900">{{ $sidat->type_of_fishing_gear }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Number of Fishing Gear</p>
                                <p class="text-lg text-gray-900">{{ $sidat->number_of_fishing_gear }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Operation Time (hours)</p>
                                <p class="text-lg text-gray-900">{{ number_format($sidat->operation_time, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Catch Information -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 p-4 text-white">
                            <h3 class="text-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path></svg>
                                Catch Information
                            </h3>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Species</p>
                                <p class="text-lg text-gray-900">{{ $sidat->species_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Stage Type</p>
                                <p class="text-lg text-gray-900">{{ $sidat->stage_type ?? 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Total Weight/Day (kg)</p>
                                <p class="text-lg text-gray-900">{{ number_format($sidat->total_weight_per_day, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Price per kg</p>
                                <p class="text-lg text-gray-900">{{ number_format($sidat->price_per_kg, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Sampling</p>
                                <p class="text-lg text-gray-900">{{ $sidat->sampling ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Water Quality Information -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 p-4 text-white">
                            <h3 class="text-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a1 1 0 001 1h12a1 1 0 001-1V6a2 2 0 00-2-2H4zm0 4v4a2 2 0 002 2h8a2 2 0 002-2v-4H4z" clip-rule="evenodd"></path></svg>
                                Water Quality Measurements
                            </h3>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Temperature (°C)</p>
                                <p class="text-lg text-gray-900">{{ $sidat->suhu ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">pH (Water)</p>
                                <p class="text-lg text-gray-900">{{ $sidat->ph_air ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Salinity (ppt)</p>
                                <p class="text-lg text-gray-900">{{ $sidat->salinitas ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Rain</p>
                                <p class="text-lg text-gray-900">
                                    @if($sidat->hujan)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path></svg>
                                            Yes
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">No</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gray-700 p-4 text-white">
                            <h3 class="text-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                Record Metadata
                            </h3>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Created By</p>
                                <div class="flex items-center mt-2">
                                    <img src="{{ $sidat->user->avatarUrl() }}" alt="{{ $sidat->user->first_name }}" class="w-8 h-8 rounded-full mr-2 object-cover">
                                    <span class="text-gray-900">{{ $sidat->user->first_name }} {{ $sidat->user->last_name }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">{{ $sidat->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Last Updated By</p>
                                @if($sidat->updatedBy)
                                    <div class="flex items-center mt-2">
                                        <img src="{{ $sidat->updatedBy->avatarUrl() }}" alt="{{ $sidat->updatedBy->first_name }}" class="w-8 h-8 rounded-full mr-2 object-cover">
                                        <span class="text-gray-900">{{ $sidat->updatedBy->first_name }} {{ $sidat->updatedBy->last_name }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $sidat->updated_at->format('d M Y, H:i') }}</p>
                                @else
                                    <p class="text-gray-500 mt-2">No updates</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
