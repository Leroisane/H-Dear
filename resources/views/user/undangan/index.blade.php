@extends('layouts.app')

@section('title', 'Pilih Template Undangan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Pilih Template Undangan</h1>
        <p class="text-lg text-gray-600">Pilih template yang sesuai untuk acara Anda</p>
    </div>

    @if($templates->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($templates as $template)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                    
                    {{-- LOGIKA DISPLAY: Cek Gambar Dulu, Kalau Kosong Baru Inisial --}}
                    @if($template->thumbnail)
                        <div class="h-48 w-full overflow-hidden bg-gray-100">
                            <img src="{{ asset('storage/' . $template->thumbnail) }}" 
                                 alt="{{ $template->nama_template }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        @php
                            $colors = ['bg-blue-600', 'bg-indigo-600', 'bg-purple-600', 'bg-pink-600', 'bg-red-600', 'bg-orange-600'];
                            $bgColor = $colors[$loop->index % count($colors)];
                            
                            $initials = collect(explode(' ', $template->nama_template))
                                ->map(function($word) { return strtoupper(substr($word, 0, 1)); })
                                ->take(2)
                                ->join('');
                        @endphp
                        <div class="{{ $bgColor }} h-48 flex items-center justify-center">
                            <span class="text-white text-5xl font-bold tracking-widest">{{ $initials }}</span>
                        </div>
                    @endif
                                        
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $template->nama_template }}</h3>
                        <p class="text-gray-600 mb-4 text-sm flex-1">{{ Str::limit($template->deskripsi, 80) }}</p>
                        
                        <a href="{{ route('undangan.create', $template->id) }}" class="mt-auto block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors font-medium">
                            Buat Surat
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">Belum ada template</h3>
            <p class="mt-1 text-gray-500">Template undangan akan segera tersedia.</p>
        </div>
    @endif
</div>
@endsection