<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UndanganController extends Controller
{
    public function index()
    {
        $templates = Template::where('is_active', true)->get();
        return view('user.undangan.index', compact('templates'));
    }

    public function create($templateId)
    {
        $template = Template::findOrFail($templateId);
        return view('user.undangan.create', compact('template'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
            'nomor_surat' => 'nullable|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'jabatan_pengirim' => 'nullable|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'tempat_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'tujuan_undangan' => 'required|string|max:255',
            'jabatan_penerima' => 'nullable|string|max:255',
            'instansi_penerima' => 'nullable|string|max:255',
            'agenda_rapat' => 'nullable|string|max:255',
            'dresscode' => 'nullable|string|max:255',
            'pesan_tambahan' => 'nullable|string',
            'nama_user' => 'required|string|max:255',
            'email_user' => 'nullable|email',
            'topik_acara' => 'nullable|string|max:255',
            'link_dokumen' => 'nullable|url'
        ]);

        $undangan = Undangan::create($validated);
        return redirect()->route('undangan.preview', $undangan->id);
    }

    public function preview($id)
    {
        $undangan = Undangan::with('template')->findOrFail($id);
        $htmlContent = $this->renderHtml($undangan);
        return view('user.undangan.preview', compact('undangan', 'htmlContent'));
    }

    public function download($id)
    {
        $undangan = Undangan::with('template')->findOrFail($id);
        $htmlContent = $this->renderHtml($undangan);
        
        $pdf = Pdf::loadHTML($htmlContent);
        // Set ukuran kertas agar muat banyak konten
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('undangan-' . str_replace(' ', '-', $undangan->nama_acara) . '.pdf');
    }

    // --- FUNGSI TUKAR GULING DATA (DENGAN ANTI-EMOJI) ---
    private function renderHtml($undangan)
    {
        $html = $undangan->template->html_content;

        // Ambil pesan tambahan
        $pesanTambahan = $undangan->pesan_tambahan;
        if (empty($pesanTambahan)) {
            $pesanTambahan = '-';
        }

        $nomorSurat = $undangan->nomor_surat ? $undangan->nomor_surat : '-';
        $jabatanPengirim = $undangan->jabatan_pengirim ?? 'Ketua Pelaksana';

        $variables = [
            // Bersihkan Input dari Emoji agar PDF Aman
            '{{nama_pengirim}}' => $this->cleanText($undangan->nama_pengirim),
            '{{nama_acara}}' => $this->cleanText($undangan->nama_acara),
            '{{tempat_acara}}' => $this->cleanText($undangan->tempat_acara),
            '{{tanggal_acara}}' => \Carbon\Carbon::parse($undangan->tanggal_acara)->isoFormat('D MMMM Y, HH:mm') . ' WIB',
            '{{tujuan_undangan}}' => $this->cleanText($undangan->tujuan_undangan),
            
            '{{nomor_surat}}' => $this->cleanText($nomorSurat), 
            '{{jabatan_pengirim}}' => $this->cleanText($jabatanPengirim),
            '{{jabatan_penerima}}' => $this->cleanText($undangan->jabatan_penerima ?? ''),
            '{{instansi_penerima}}' => $this->cleanText($undangan->instansi_penerima ?? ''),
            '{{agenda_rapat}}' => $this->cleanText($undangan->agenda_rapat ?? '-'),
            '{{dresscode}}' => $this->cleanText($undangan->dresscode ?? '-'),
            '{{pesan_tambahan}}' => $this->cleanText($pesanTambahan),
            '{{topik_acara}}' => $this->cleanText($undangan->topik_acara ?? '-'),
            
            '{{link_dokumen}}' => $undangan->link_dokumen 
                ? '<a href="'.$undangan->link_dokumen.'" style="color: blue; text-decoration: underline;">Klik di sini</a>' 
                : '-',
        ];

        return str_replace(array_keys($variables), array_values($variables), $html);
    }

    private function cleanText($text)
    {
        return preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $text);
    }
}