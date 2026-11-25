<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SarprasTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Pastikan seeder dijalankan
        $this->seed(\Database\Seeders\SarprasAndSurveiSeeder::class);
    }

    public function test_public_sarpras_page_displays_facilities_from_database(): void
    {
        $response = $this->get('/profil/sarpras');

        $response->assertStatus(200);
        $response->assertSee('Sarana & Prasarana');
        $response->assertSee('Mushola Al-Ikhlas');
        $response->assertSee('Laboratorium Komputer');
    }

    public function test_sarpras_dashboard_access_and_overview(): void
    {
        $response = $this->withSession([
            'survei.user_id' => 3,
            'survei.username' => 'sarpras',
            'survei.nama' => 'Admin Sarana Prasarana',
            'survei.role' => 'sarpras',
        ])->get(route('survei.dashboard.index'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard Sarana');
        $response->assertSee('Fasilitas Sarpras');
        $response->assertSee('Pertanyaan Survei');
    }

    public function test_sarpras_can_create_facility_with_upload(): void
    {
        $file = UploadedFile::fake()->image('lapangan_voli.jpg', 600, 400);

        $response = $this->withSession([
            'survei.user_id' => 3,
            'survei.username' => 'sarpras',
            'survei.nama' => 'Admin Sarana Prasarana',
            'survei.role' => 'sarpras',
        ])->post(route('survei.dashboard.sarpras.store'), [
            'nama_fasilitas' => 'Lapangan Voli Outdoor',
            'kategori' => 'Olahraga',
            'kondisi' => 'Baik',
            'jumlah' => 1,
            'keterangan' => 'Samping gedung C',
            'deskripsi' => 'Lapangan voli standar dengan jaring dan garis pembatas lengkap untuk kegiatan ekstrakurikuler.',
            'foto' => $file,
        ]);

        $response->assertRedirect(route('survei.dashboard.sarpras.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('sarana_prasarana', [
            'nama_fasilitas' => 'Lapangan Voli Outdoor',
            'kategori' => 'Olahraga',
            'kondisi' => 'Baik',
        ]);
    }

    public function test_sarpras_can_create_survey_question_for_sarpras_aspect(): void
    {
        $response = $this->withSession([
            'survei.user_id' => 3,
            'survei.username' => 'sarpras',
            'survei.nama' => 'Admin Sarana Prasarana',
            'survei.role' => 'sarpras',
        ])->post(route('survei.dashboard.sarpras.pertanyaan.store'), [
            'teks_pertanyaan' => 'Apakah sarana parkir kendaraan di sekolah mencukupi dan tertata rapi?',
            'jenis' => 'Skala',
            'urutan' => 10,
            'inti' => 0,
        ]);

        $response->assertRedirect(route('survei.dashboard.sarpras.pertanyaan'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pertanyaan', [
            'aspek_id' => 4, // Khusus aspek sarpras
            'teks_pertanyaan' => 'Apakah sarana parkir kendaraan di sekolah mencukupi dan tertata rapi?',
            'jenis' => 'Skala',
        ]);
    }

    public function test_sarpras_survey_results_only_shows_sarpras_aspect(): void
    {
        $response = $this->withSession([
            'survei.user_id' => 3,
            'survei.username' => 'sarpras',
            'survei.nama' => 'Admin Sarana Prasarana',
            'survei.role' => 'sarpras',
        ])->get(route('survei.dashboard.hasil'));

        $response->assertStatus(200);
        $response->assertSee('Hasil Survei Khusus Role Sarpras');
        $response->assertSee('Sarana dan Prasarana');
        // Memastikan aspek lain tidak tampil di tabel hasil sarpras
        $response->assertDontSee('Proses Pembelajaran');
        $response->assertDontSee('Layanan Bimbingan Konseling');
    }

    public function test_respondent_can_submit_survey_and_persists_to_database(): void
    {
        $pertanyaan = DB::table('pertanyaan')
            ->where('aspek_id', 4)
            ->where('aktif', 1)
            ->whereNull('deleted_at')
            ->first();

        $this->assertNotNull($pertanyaan);

        $response = $this->withSession([
            'survei.user_id' => 8,
            'survei.username' => 'siswa',
            'survei.nama' => 'Pengguna Siswa',
            'survei.role' => 'siswa',
        ])->post(route('survei.isi.simpan'), [
            'jawaban' => [
                $pertanyaan->pertanyaan_id => 5,
            ],
            'isian' => 'Fasilitas sarana prasarana sekolah sudah sangat memadai.',
        ]);

        $response->assertRedirect(route('survei.selesai'));

        $this->assertDatabaseHas('partisipasi', [
            'survei_id' => 1,
        ]);

        $this->assertDatabaseHas('jawaban', [
            'pertanyaan_id' => $pertanyaan->pertanyaan_id,
            'skor' => 5,
        ]);
    }
}
