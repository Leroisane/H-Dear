<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        // ---------------------------------------------------------
        // 1. UNDANGAN PEMATERI
        // ---------------------------------------------------------
        Template::create([
            'nama_template' => 'Undangan Pemateri / Narasumber',
            'deskripsi' => 'Dilengkapi kolom Judul Materi & Link TOR.',
            'is_active' => true,
            'thumbnail' => 'thumbnails/pemateri.jpg',
            'html_content' => '
            <div style="font-family: \'Verdana\', sans-serif; padding: 40px; color: #333; line-height: 1.6;">
                <h2 style="color: #2980b9; border-bottom: 2px solid #2980b9; padding-bottom: 10px;">PERMOHONAN PEMATERI</h2>
                <p>Halo, <strong>{{tujuan_undangan}}</strong>!</p>
                <p>Kami dari panitia <strong>{{nama_acara}}</strong> bermaksud mengundang Anda untuk berbagi ilmu sebagai Narasumber.</p>
                
                <div style="background: #eaf2f8; padding: 15px; border-left: 5px solid #2980b9; margin: 20px 0;">
                    <strong>Topik Bahasan:</strong><br>
                    <span style="font-size: 18px; color: #2c3e50;">{{topik_acara}}</span>
                </div>

                <table style="width: 100%; margin-bottom: 20px;">
                    <tr><td style="width: 30%;"><strong>Waktu</strong></td><td>: {{tanggal_acara}}</td></tr>
                    <tr><td><strong>Tempat</strong></td><td>: {{tempat_acara}}</td></tr>
                    <tr><td><strong>Link TOR</strong></td><td>: {{link_dokumen}}</td></tr>
                </table>

                <p>Besar harapan kami Anda berkenan mengisi sesi ini. Terima kasih!</p>
                <br>
                <p>Salam,<br><strong>{{nama_pengirim}}</strong></p>
            </div>',
        ]);

        // ---------------------------------------------------------
        // 2. UNDANGAN DEWAN JURI
        // ---------------------------------------------------------
        Template::create([
            'nama_template' => 'Undangan Dewan Juri',
            'deskripsi' => 'Dilengkapi kolom Kategori Lomba & Link Rubrik.',
            'is_active' => true,
            'thumbnail' => 'thumbnails/juri.jpg',
            'html_content' => '
            <div style="font-family: \'Georgia\', serif; padding: 40px; color: #333; line-height: 1.6; border: 2px solid #8e44ad; border-radius: 10px;">
                <div style="text-align: center; color: #8e44ad; margin-bottom: 30px;">
                    <h1 style="margin:0;">OFFICIAL JURY INVITATION</h1>
                    <p>{{nama_acara}}</p>
                </div>

                <p>Yth. <strong>{{tujuan_undangan}}</strong>,</p>
                <p>Dengan hormat, kami memohon kesediaan Bapak/Ibu untuk menjadi <strong>Dewan Juri</strong> pada kompetisi kami:</p>
                
                <div style="text-align: center; margin: 20px 0;">
                    <div style="background: #8e44ad; color: white; padding: 10px 20px; border-radius: 20px; font-weight: bold; display:inline-block;">
                        Kategori: {{topik_acara}}
                    </div>
                </div>

                <table style="width: 100%; margin: 20px 0;">
                    <tr><td style="width: 35%;"><strong>Jadwal Penjurian</strong></td><td>: {{tanggal_acara}}</td></tr>
                    <tr><td><strong>Lokasi</strong></td><td>: {{tempat_acara}}</td></tr>
                    <tr><td><strong>Panduan/Rubrik</strong></td><td>: {{link_dokumen}}</td></tr>
                </table>

                <p>Penilaian objektif dari Anda sangat kami butuhkan. Terima kasih.</p>
                <br>
                <div style="text-align: right;">
                    <p>{{jabatan_pengirim}}</p>
                    <p><strong>{{nama_pengirim}}</strong></p>
                </div>
            </div>',
        ]);

        // ---------------------------------------------------------
        // 3. UNDANGAN MC / MODERATOR
        // ---------------------------------------------------------
        Template::create([
            'nama_template' => 'Undangan MC / Moderator',
            'deskripsi' => 'Dilengkapi kolom Link Rundown/Cue Card.',
            'is_active' => true,
            'thumbnail' => 'thumbnails/mc.jpg',
            'html_content' => '
            <div style="font-family: \'Segoe UI\', sans-serif; padding: 0; color: #444;">
                <div style="background: #27ae60; padding: 30px; color: white; text-align: center;">
                    <h2 style="margin:0;">TEAM INVITATION</h2>
                    <p>Let\'s make some noise!</p>
                </div>
                
                <div style="padding: 40px;">
                    <p>Hai, <strong>{{tujuan_undangan}}</strong>!</p>
                    <p>Kami butuh energi kamu untuk memandu acara <strong>{{nama_acara}}</strong> sebagai <strong>{{jabatan_penerima}}</strong>.</p>
                    
                    <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin: 20px 0;">
                        <p style="margin: 5px 0;"><strong>Waktu:</strong> {{tanggal_acara}}</p>
                        <p style="margin: 5px 0;"><strong>Tempat:</strong> {{tempat_acara}}</p>
                        <p style="margin: 5px 0;"><strong>Akses Rundown:</strong> {{link_dokumen}}</p>
                        <p style="margin: 5px 0;"><strong>Notes:</strong> {{pesan_tambahan}}</p>
                    </div>

                    <p>Mohon dipelajari rundown-nya ya. Sampai jumpa di venue!</p>
                    <br>
                    <p style="color: #27ae60; font-weight: bold;">{{nama_pengirim}}</p>
                </div>
            </div>',
        ]);


        // ---------------------------------------------------------
        // 4. VIP
        // ---------------------------------------------------------
        Template::create([
            'nama_template' => 'Undangan Tamu Kehormatan (VIP)',
            'deskripsi' => 'Khusus untuk Dosen, Rektorat, atau Tokoh Penting.',
            'is_active' => true,
            'thumbnail' => 'thumbnails/vip.jpg',
            'html_content' => '
            <div style="font-family: Arial, sans-serif; padding: 50px; line-height: 1.8; color: #333;">
                <div style="text-align: center; margin-bottom: 40px;">
                    <h2 style="letter-spacing: 2px; text-transform: uppercase; border-bottom: 2px solid #333; display: inline-block; padding-bottom: 5px;">UNDANGAN VIP</h2>
                    <p style="margin-top: 10px; font-size: 14px;">Nomor: {{nomor_surat}}</p>
                </div>
                <p>Kepada Yth. Bapak/Ibu<br><strong style="font-size: 18px;">{{tujuan_undangan}}</strong><br>{{jabatan_penerima}}</p>
                <br>
                <p>Dengan hormat,</p>
                <p style="text-align: justify;">Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu berkenan hadir sebagai Tamu Kehormatan dalam acara <strong>{{nama_acara}}</strong> yang akan kami selenggarakan pada:</p>
                <div style="background-color: #f9f9f9; padding: 20px; border-left: 5px solid #333; margin: 20px 0;">
                    <table style="width: 100%;">
                        <tr><td style="width: 30%; font-weight: bold;">Waktu</td><td>: {{tanggal_acara}}</td></tr>
                        <tr><td style="font-weight: bold;">Lokasi</td><td>: {{tempat_acara}}</td></tr>
                        <tr><td style="font-weight: bold;">Dresscode</td><td>: {{dresscode}}</td></tr>
                        <tr><td style="font-weight: bold;">Catatan</td><td>: {{pesan_tambahan}}</td></tr>
                    </table>
                </div>
                <p>Besar harapan kami atas kehadiran Bapak/Ibu untuk memberikan dukungan moril bagi kesuksesan acara ini.</p>
                <br>
                <p>{{jabatan_pengirim}},</p> 
                <p style="font-weight: bold; margin-top: 50px;">{{nama_pengirim}}</p>
            </div>',
        ]);


        // ---------------------------------------------------------
        // 5. INSTANSI
        // ---------------------------------------------------------
        Template::create([
            'nama_template' => 'Undangan Instansi Luar',
            'deskripsi' => 'Untuk Sponsor, Media Partner, atau Dinas Terkait.',
            'is_active' => true,
            'thumbnail' => 'thumbnails/instansi.jpg',
            'html_content' => '
            <div style="font-family: Georgia, serif; padding: 40px; line-height: 1.5; color: #000;">
                <table style="width: 100%; border-bottom: 4px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                    <tr>
                        <td style="text-align: center;">
                            <h2 style="margin:0; font-size: 20px;">FAKULTAS ILMU KOMPUTER UNIVERSITAS BRAWIJAYA</h2>
                            <h3 style="margin:0; font-size: 16px;">PANITIA KEGIATAN {{nama_acara}}</h3>
                            <p style="margin:0; font-size: 12px; font-style: italic;">Building Partnership for Future</p>
                        </td>
                    </tr>
                </table>
                <table style="width: 100%; margin-bottom: 20px;">
                    <tr><td style="width: 15%;">No</td><td>: {{nomor_surat}}</td><td style="text-align: right;">Malang, ' . date('d F Y') . '</td></tr>
                    <tr><td>Hal</td><td>: <strong>Undangan / Penawaran Kerjasama</strong></td><td></td></tr>
                </table>
                <div style="margin-bottom: 20px;">
                    Yth. Pimpinan <strong>{{instansi_penerima}}</strong><br>
                    u.p. {{tujuan_undangan}}<br>
                    di Tempat
                </div>
                <p>Dengan hormat,</p>
                <p style="text-align: justify;">Dalam rangka memperluas jaringan dan kolaborasi, kami bermaksud mengundang instansi yang Bapak/Ibu pimpin untuk berpartisipasi dalam kegiatan <strong>{{nama_acara}}</strong>.</p>
                <p>Adapun detail pelaksanaan kegiatan adalah sebagai berikut:</p>
                <table style="width: 100%; border: 1px solid #000; border-collapse: collapse; margin: 20px 0;">
                    <tr><td style="border: 1px solid #000; padding: 8px;">Agenda Utama</td><td style="border: 1px solid #000; padding: 8px;">{{nama_acara}}</td></tr>
                    <tr><td style="border: 1px solid #000; padding: 8px;">Waktu</td><td style="border: 1px solid #000; padding: 8px;">{{tanggal_acara}}</td></tr>
                    <tr><td style="border: 1px solid #000; padding: 8px;">Tempat</td><td style="border: 1px solid #000; padding: 8px;">{{tempat_acara}}</td></tr>
                    <tr><td style="border: 1px solid #000; padding: 8px;">Catatan</td><td style="border: 1px solid #000; padding: 8px;">{{pesan_tambahan}}</td></tr>
                </table>
                <p style="text-align: justify;">Kami sangat mengharapkan respon positif dari instansi Bapak/Ibu. Atas perhatian dan kerjasamanya kami sampaikan terima kasih.</p>
                <div style="margin-top: 40px;">
                    <p>Panitia Pelaksana,</p>
                    <br><br><br>
                    <p style="font-weight: bold;">{{nama_pengirim}}</p>
                    <p>{{jabatan_pengirim}}</p>
                </div>
            </div>',
        ]);


        // ---------------------------------------------------------
        // 6. RAKOR
        // ---------------------------------------------------------
        Template::create([
            'nama_template' => 'Undangan Rapat Koordinasi',
            'deskripsi' => 'Undangan rapat internal organisasi/kepanitiaan.',
            'is_active' => true,
            'thumbnail' => 'thumbnails/rakor.jpg',
            'html_content' => '
            <div style="font-family: \'Helvetica\', Arial, sans-serif; padding: 40px; line-height: 1.6; color: #333;">
                
                <div style="border-left: 10px solid #2c3e50; padding-left: 20px; margin-bottom: 30px;">
                    <h2 style="color: #2c3e50; margin: 0; font-size: 24px;">UNDANGAN RAPAT</h2>
                    <p style="margin: 5px 0 0 0; color: #7f8c8d; font-weight: bold;">{{nama_acara}}</p>
                    <p style="margin: 0; font-size: 14px; color: #95a5a6;">No: {{nomor_surat}}</p>
                </div>

                <div style="margin-bottom: 30px;">
                    <p>Kepada Yth. Rekan<br><strong style="font-size: 18px; color: #2980b9;">{{tujuan_undangan}}</strong><br>di Tempat</p>
                </div>

                <p>Halo rekan-rekan,</p>
                <p>Mengharap kehadiran teman-teman semua pada rapat koordinasi yang akan kita laksanakan pada:</p>

                <div style="margin: 20px 0; overflow: hidden; border-radius: 8px; border: 1px solid #e0e0e0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr style="background-color: #34495e; color: white;">
                            <th style="padding: 12px; text-align: left; width: 30%;">Item</th>
                            <th style="padding: 12px; text-align: left;">Detail</th>
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                            <td style="padding: 12px; border-bottom: 1px solid #eee;"><strong>Agenda</strong></td>
                            <td style="padding: 12px; border-bottom: 1px solid #eee; color: #e74c3c; font-weight: bold;">{{agenda_rapat}}</td>
                        </tr>
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #eee;"><strong>Waktu</strong></td>
                            <td style="padding: 12px; border-bottom: 1px solid #eee;">{{tanggal_acara}}</td>
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                            <td style="padding: 12px; border-bottom: 1px solid #eee;"><strong>Tempat</strong></td>
                            <td style="padding: 12px; border-bottom: 1px solid #eee;">{{tempat_acara}}</td>
                        </tr>
                        <tr>
                            <td style="padding: 12px;"><strong>Catatan</strong></td>
                            <td style="padding: 12px;">{{pesan_tambahan}}</td>
                        </tr>
                    </table>
                </div>

                <p>Mengingat pentingnya agenda ini, dimohon kehadirannya tepat waktu ya. Terima kasih!</p>

                <div style="margin-top: 40px; text-align: right;">
                    <p style="color: #7f8c8d; font-size: 14px;">Malang, ' . date('d F Y') . '</p>
                    <p style="margin-bottom: 50px;"><strong>{{jabatan_pengirim}}</strong></p>
                    <p style="font-size: 16px; color: #2c3e50; font-weight: bold;">{{nama_pengirim}}</p>
                </div>
            </div>',
        ]);
    }
}