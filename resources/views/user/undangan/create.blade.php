@extends('layouts.app')

@section('title', 'Buat Undangan')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Undangan</h1>
        <p class="text-gray-600">Template: <span class="font-semibold">{{ $template->nama_template }}</span></p>
    </div>

    {{-- LOGIKA PINTAR --}}
    @php
        $isSuratResmi = Str::contains($template->nama_template, ['VIP', 'Instansi', 'Rapat']);
        $isRakor = Str::contains($template->nama_template, 'Rapat');
        
        // Cek Spesifik Jenis Petugas
        $isMC = Str::contains($template->nama_template, ['MC', 'Moderator']);
        $isPemateri = Str::contains($template->nama_template, ['Pemateri', 'Narasumber']);
        $isJuri = Str::contains($template->nama_template, 'Juri');
        
        // Gabungan untuk pengecekan umum
        $isPetugas = $isMC || $isPemateri || $isJuri;
    @endphp

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('undangan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="template_id" value="{{ $template->id }}">

            <div class="mb-6 border-b border-gray-100 pb-4">
                <h2 class="text-lg font-semibold text-indigo-600 mb-2">1. Data Anda (Admin/Sekretaris)</h2>
                <p class="text-xs text-gray-500 mb-4 bg-gray-50 p-2 rounded border border-gray-200">
                    <span class="font-bold">Info:</span> Data di bagian ini <strong>tidak akan muncul</strong> di dalam surat undangan PDF.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Anda</label>
                        <input type="text" name="nama_user" value="{{ auth()->user()->name ?? old('nama_user') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email (Opsional)</label>
                        <input type="email" name="email_user" value="{{ auth()->user()->email ?? old('email_user') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <div class="mb-6 border-b border-gray-100 pb-4">
                <h2 class="text-lg font-semibold text-indigo-600 mb-4">2. Detail Acara</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Acara *</label>
                    <input type="text" name="nama_acara" value="{{ old('nama_acara') }}" placeholder="Contoh: Seminar Nasional Teknologi 2025" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Pelaksanaan *</label>
                        <input type="datetime-local" name="tanggal_acara" value="{{ old('tanggal_acara') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat / Lokasi *</label>
                        <input type="text" name="tempat_acara" value="{{ old('tempat_acara') }}" placeholder="Contoh: Aula Gedung A / Zoom Meeting" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <div class="mb-6 border-b border-gray-100 pb-4">
                <h2 class="text-lg font-semibold text-indigo-600 mb-4">3. Detail Surat</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            @if($isPetugas)
                                Nama Penerima Surat *
                            @elseif($isSuratResmi)
                                Nama Penerima Surat (Yth...) *
                            @else
                                Tujuan Undangan *
                            @endif
                        </label>
                        <input type="text" name="tujuan_undangan" value="{{ old('tujuan_undangan') }}" placeholder="Contoh: Bpk. John Doe / Kak Bruno Mars" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    @if($isMC)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Peran di Acara *</label>
                            <select name="jabatan_penerima" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                                <option value="Master of Ceremony (MC)">Master of Ceremony (MC)</option>
                                <option value="Moderator">Moderator</option>
                            </select>
                        </div>
                    
                    @elseif($isPemateri)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Peran di Acara *</label>
                            <select name="jabatan_penerima" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                                <option value="Pemateri">Pemateri</option>
                                <option value="Narasumber">Narasumber</option>
                            </select>
                        </div>

                    @elseif($isJuri)
                        <div class="md:col-span-2">
                            <input type="hidden" name="jabatan_penerima" value="Dewan Juri">
                            <div class="p-3 bg-gray-100 rounded text-sm text-gray-600 border border-gray-200">
                                <strong>Peran:</strong> Dewan Juri (Otomatis)
                            </div>
                        </div>

                    @else
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan Penerima (Opsional)</label>
                            <input type="text" name="jabatan_penerima" placeholder="Contoh: Kepala Dinas / Dosen" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    @endif


                    @if($isPemateri)
                        <div class="md:col-span-2 p-3 bg-blue-50 rounded border border-blue-100">
                            <label class="block text-sm font-medium text-blue-800 mb-1">Topik / Judul Materi</label>
                            <input type="text" name="topik_acara" placeholder="Contoh: Strategi Digital Marketing 2025" class="w-full px-3 py-2 border border-blue-200 rounded-md">
                            
                            <label class="block text-sm font-medium text-blue-800 mt-3 mb-1">Link TOR (Google Drive)</label>
                            <input type="url" name="link_dokumen" placeholder="https://drive.google.com/..." class="w-full px-3 py-2 border border-blue-200 rounded-md">
                        </div>
                    @endif

                    @if($isJuri)
                        <div class="md:col-span-2 p-3 bg-purple-50 rounded border border-purple-100">
                            <label class="block text-sm font-medium text-purple-800 mb-1">Kategori Lomba yang Dinilai</label>
                            <input type="text" name="topik_acara" placeholder="Contoh: Lomba UI/UX Design" class="w-full px-3 py-2 border border-purple-200 rounded-md">
                            
                            <label class="block text-sm font-medium text-purple-800 mt-3 mb-1">Link Panduan Penilaian / Rubrik</label>
                            <input type="url" name="link_dokumen" placeholder="https://drive.google.com/..." class="w-full px-3 py-2 border border-purple-200 rounded-md">
                        </div>
                    @endif

                    @if($isMC)
                        <div class="md:col-span-2 p-3 bg-green-50 rounded border border-green-100">
                            <label class="block text-sm font-medium text-green-800 mb-1">Link Rundown / Cue Card</label>
                            <input type="url" name="link_dokumen" placeholder="https://drive.google.com/..." class="w-full px-3 py-2 border border-green-200 rounded-md">
                        </div>
                    @endif

                    @if(Str::contains($template->nama_template, 'Instansi'))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Instansi Penerima</label>
                            <input type="text" name="instansi_penerima" placeholder="Contoh: PT. Mencari Cinta Sejati" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    @endif

                    @if($isSuratResmi)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat</label>
                            <input type="text" name="nomor_surat" placeholder="Contoh: 001/PAN-PEL/XII/2025" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    @endif

                    @if($isRakor)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agenda Pembahasan</label>
                            <input type="text" name="agenda_rapat" placeholder="Contoh: Pembahasan RAB Tahunan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-indigo-600 mb-4">4. Penutup & Tanda Tangan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengirim (TTD) *</label>
                        <input type="text" name="nama_pengirim" value="{{ old('nama_pengirim') }}" placeholder="Nama Ketua Panitia" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan Pengirim</label>
                        <input type="text" name="jabatan_pengirim" value="{{ old('jabatan_pengirim') }}" placeholder="Contoh: Ketua Pelaksana" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    @if($isSuratResmi)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dresscode</label>
                        <input type="text" name="dresscode" placeholder="Contoh: Batik Rapi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    @endif

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                        <textarea name="pesan_tambahan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="Info tambahan yang ingin disampaikan..."></textarea>
                    </div>
                </div>
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('undangan.index') }}" class="flex-1 bg-gray-100 text-gray-700 px-4 py-3 rounded-md hover:bg-gray-200 transition-colors text-center font-medium">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-3 rounded-md hover:bg-indigo-700 transition-colors font-medium shadow-md">
                    Buat Undangan Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection