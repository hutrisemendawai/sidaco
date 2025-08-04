<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tropical Anguillid Eel Data Details - ID: {{ $sidat->id }}</title>
    <link rel="icon" href="{{ asset('images/seafdeclogo.png') }}" type="image/png"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
        .detail-row { border-bottom: 1px solid #e5e7eb; }
        .detail-label { font-weight: 500; color: #4b5563; }
        .detail-value { color: #1f2937; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 bg-sky-600 text-white flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Tropical Anguillid Eel Data Details</h1>
                    <p class="text-sm opacity-90">Record ID: {{ $sidat->id }}</p>
                </div>
                <img src="{{ asset('images/seafdeclogo.png') }}" alt="Logo" class="h-12 w-auto" />
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div class="detail-row py-2"><span class="detail-label">Date:</span><span class="detail-value float-right">{{ $sidat->date->format('d F Y') }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Fisher:</span><span class="detail-value float-right">{{ $sidat->fisher_name }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Country:</span><span class="detail-value float-right">{{ $sidat->country }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Province:</span><span class="detail-value float-right">{{ $sidat->province }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">District:</span><span class="detail-value float-right">{{ $sidat->district }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">River:</span><span class="detail-value float-right">{{ $sidat->river }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Species:</span><span class="detail-value float-right">{{ $sidat->species_name }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Stage:</span><span class="detail-value float-right">{{ $sidat->stage }}</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Total Weight/Day:</span><span class="detail-value float-right">{{ number_format($sidat->total_weight_per_day, 2) }} kg</span></div>
                    <div class="detail-row py-2"><span class="detail-label">Operation Time:</span><span class="detail-value float-right">{{ $sidat->operation_time }} hours</span></div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-center text-xs text-gray-500">
                Data recorded on {{ $sidat->created_at->format('Y-m-d H:i') }}
            </div>
        </div>
    </div>
</body>
</html>
