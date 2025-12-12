@extends('layouts.app')

@section('title', 'Tambah Template')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Template Undangan</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Input Nama Template --}}
            <div class="mb-4">
                <label for="nama_template" class="block text-sm font-medium text-gray-700 mb-2">Nama Template *</label>
                <input type="text" id="nama_template" name="nama_template" value="{{ old('nama_template') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_template') border-red-500 @enderror">
                @error('nama_template')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Deskripsi --}}
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Thumbnail --}}
            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('thumbnail') border-red-500 @enderror">
                @error('thumbnail')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Format: JPEG, PNG, JPG. Maksimal 2MB</p>
            </div>

            {{-- Input HTML Content --}}
            <div class="mb-4">
                <label for="html_content" class="block text-sm font-medium text-gray-700 mb-2">HTML Content *</label>
                <textarea id="html_content" name="html_content" rows="15" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 font-mono text-sm @error('html_content') border-red-500 @enderror">{{ old('html_content') }}</textarea>
                @error('html_content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                {{-- Informasi Variabel (Sudah Diperbaiki) --}}
                <div class="mt-2 bg-gray-50 border border-gray-200 rounded p-3">
                    <p class="text-sm font-medium text-gray-700 mb-2">Variabel yang tersedia:</p>
                    <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                        <code class="bg-gray-100 px-2 py-1 rounded">@{{nama_pengirim}}</code>
                        <code class="bg-gray-100 px-2 py-1 rounded">@{{nama_acara}}</code>
                        <code class="bg-gray-100 px-2 py-1 rounded">@{{tempat_acara}}</code>
                        <code class="bg-gray-100 px-2 py-1 rounded">@{{tanggal_acara}}</code>
                        <code class="bg-gray-100 px-2 py-1 rounded">@{{tujuan_undangan}}</code>
                        <code class="bg-gray-100 px-2 py-1 rounded">@{{pesan_tambahan}}</code>
                    </div>
                </div>
            </div>

            {{-- Checkbox Active --}}
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Template Aktif</span>
                </label>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex space-x-4">
                <a href="{{ route('admin.templates.index') }}" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors text-center">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                    Simpan Template
                </button>
            </div>
        </form>
    </div>
</div>
@endsection