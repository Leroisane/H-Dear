@extends('layouts.app')

@section('title', 'Preview Undangan')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Preview Hasil Undangan</h1>
        <p class="mt-2 text-gray-600">Pastikan tampilan surat sudah sesuai sebelum diunduh.</p>
    </div>

    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">
                    Undangan berhasil digenerate! Silakan cek detail di bawah ini.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-gray-200 rounded-xl p-4 md:p-8 mb-8 shadow-inner overflow-x-auto">
        <div style="width: 210mm; min-height: 297mm; background: white; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
            {!! $htmlContent !!}
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
        <a href="{{ route('undangan.index') }}" 
           class="w-full sm:w-auto px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 hover:text-gray-900 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 text-center shadow-sm">
            ← Buat Undangan Lain
        </a>

        <a href="{{ route('undangan.download', $undangan->id) }}" 
           class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg text-center flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download PDF Resmi
        </a>
    </div>

</div>
@endsection