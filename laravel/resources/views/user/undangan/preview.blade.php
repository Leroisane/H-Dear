@extends('layouts.app')

@section('title', 'Preview Undangan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Preview Undangan</h1>
        <p class="text-gray-600">Undangan berhasil dibuat! Lihat preview dan download PDF</p>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
        <div class="p-8 border border-gray-200 overflow-auto">
            {{-- Menampilkan HTML hasil olahan Controller --}}
            {!! $htmlContent !!}
        </div>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('undangan.index') }}" class="flex-1 bg-gray-100 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-200 transition-colors text-center font-medium">
            Buat Undangan Baru
        </a>
        <a href="{{ route('undangan.download', $undangan->id) }}" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors text-center font-medium shadow-md">
            Download PDF
        </a>
    </div>

    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    Undangan Anda telah berhasil dibuat. Klik tombol "Download PDF" untuk mengunduh undangan dalam format PDF yang siap dicetak atau dibagikan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection