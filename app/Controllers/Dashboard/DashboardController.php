<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\RencanaKerjaAtasanModel;
use App\Models\LogKerjaModel;
use App\Models\BuktiDukungModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->requireLogin();
        $data = [

            'nama' => session('nama'),
            'nip' => session('nip'),
            'email' => session('email'),
            'no_wa' => session('no_wa'),

        ];

        return view('dashboard/utama/data_saya', ['pegawai' => $data]);
    }

    public function utama()
    {
        $this->requireLogin();
        $data = [
            'nama' => session('nama'),
            'nip' => session('nip'),
            'email' => session('email'),
            'no_wa' => session('no_wa'),
        ];

        return view('dashboard/utama/data_saya', ['pegawai' => $data]);
    }

    public function data_saya()
    {
        $this->requireLogin();
        $data = [

            'nama' => session('nama'),
            'nip' => session('nip'),
            'email' => session('email'),
            'no_wa' => session('no_wa'),


        ];

        return view('dashboard/utama/data_saya', ['pegawai' => $data]);
    }


    public function bukti_dukung_bravo()
    {
        return view('dashboard/utama/bukti_dukung_bravo');
    }

    public function survey_kepuasan()
    {
        return view('dashboard/utama/survey_kepuasan');
    }

    public function pengembangan()
    {
        $this->requireLogin();

        return view('dashboard/pengembangan');
    }

    public function log()
    {
        $this->requireLogin();

        return view('dashboard/log_harian');
    }

    public function view_rencana_kerja_atasan()
    {
        $this->requireLogin();
        $renakersanModel = new RencanaKerjaAtasanModel();

        $id_pegawai = session('user_id');

        $data['rencana_kerja'] = $renakersanModel->where('id_pegawai', $id_pegawai)->findAll();

        return view('dashboard/logkerja/rencana_kerja_atasan', $data);
    }

    public function form_rencana_kerja_atasan()
    {
        $this->requireLogin();

        return view('dashboard/logkerja/input_rencana_kerja_atasan');
    }

    public function riwayat_log_kerja()
    {
        $this->requireLogin();

        return view('dashboard/logkerja/riwayat_log_kerja');
    }


    public function profil()
    {
        $pegawaiModel = new PegawaiModel();

        $data = [
            'pegawai' => $pegawaiModel->getDetail(session()->get('user_id')),
        ];

        return view('dashboard/pages/profile/profile', $data);
    }

    public function formEditProfile()
    {
        $bidangModel = new BidangModel();
        $jabatanModel = new JabatanModel();
        $pegawaiModel = new PegawaiModel();
        $userModel = new UserModel();

        $id = session()->get('user_id');

        $pegawai = $pegawaiModel->find($id);
        $user = $userModel->where('id', $pegawai['id'])->first();

        $data = [
            'bidangs' => $bidangModel->findAll(),
            'jabatans' => $jabatanModel->findAll(),
            'satker_ids' => unserialize(SATKER_IDS),
            'bidang_kpi_id' => BIDANG_KPI_ID,
            'pegawai' => $pegawaiModel->find($id),
            'account' => $user,
        ];

        return view('dashboard/pages/profile/form_edit_profile', $data);
    }

    protected function requireLogin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    }

    public function submit_rencana_kerja_atasan()
    {

        $renakersanModel = new RencanaKerjaAtasanModel();

        $id_pegawai = session('user_id');
        $rencana = $this->request->getPost('rencanaKerja');

        $renakersanModel->insert(
            [
                'rencana_kerja' => $rencana,
                'id_pegawai' => $id_pegawai,
            ]
        );

        return redirect()->to('dashboard/log/rencana_hasil_kerja_atasan');
    }

    public function delete_rencana_hasil_kerja_atasan($id)
    {
        $renakersanModel = new RencanaKerjaAtasanModel();

        $renakersanModel->delete($id);

        return redirect()->to('dashboard/log/rencana_hasil_kerja_atasan');
    }

    public function view_log_kerja_saya()
    {
        $logkerjamodel = new LogKerjaModel();

        // $data['log_kerja'] = $logkerjamodel->where('id_pegawai', session('user_id'))->findAll();

        return  view('dashboard/logkerja/log_kerja_saya');
    }

    public function form_log_kerja_saya()
    {
        return view('dashboard/logkerja/input_log_kerja');
    }

    public function edit_log_kerja_saya($id)
    {
        $logKerjaModel = new LogKerjaModel();
        $buktiDukungModel = new BuktiDukungModel();
        $data = [
            'log_kerja' => $logKerjaModel->find($id),
            'lampiran_old' => $buktiDukungModel->where('reference_id', $id)->findAll(),
        ];

        return view('dashboard/logkerja/input_log_kerja', $data);
    }


    public function submit_log_kerja()
    {
        $logkerjamodel = new LogKerjaModel();
        $buktiDukungModel = new BuktiDukungModel();
        $randomid = bin2hex(random_bytes(8));

        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal'         => 'required|valid_date[Y-m-d]',
            'jam_mulai'       => 'permit_empty',
            'jam_selesai'     => 'permit_empty',
            'deskripsi'       => 'required|max_length[100]',
            'output'          => 'required|max_length[100]',
            'lokasi'          => 'permit_empty|max_length[100]',
            'bukti_file.*'    => 'permit_empty|uploaded[bukti_file.*]|max_size[bukti_file.*,2048]|ext_in[bukti_file.*,jpg,jpeg,png,pdf]',
            'bukti_deskripsi' => 'permit_empty'
        ], [
            'bukti_file.*.uploaded' => 'File gagal diupload',
            'bukti_file.*.max_size' => 'Ukuran file maksimal 2MB',
            'bukti_file.*.ext_in'   => 'Hanya file gambar atau PDF yang diizinkan'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari input form
        $id             = $this->request->getPost('id') ?? $randomid;
        $tanggal        = $this->request->getPost('tanggal');
        $jamMulai       = $this->request->getPost('jam_mulai');
        $jamSelesai     = $this->request->getPost('jam_selesai');
        $deskripsi      = $this->request->getPost('deskripsi');
        $output         = $this->request->getPost('output');
        $lokasi         = $this->request->getPost('lokasi');
        $deskripsiBukti = $this->request->getPost('bukti_deskripsi');
        $buktiFiles     = $this->request->getFileMultiple('bukti_file');

        $data = [
            'id' => $id,
            'tanggal' => $tanggal,
            'start' => $jamMulai,
            'end' => $jamSelesai,
            'uraian' => $deskripsi,
            'output' => $output,
            'lokasi' => $lokasi,
            'id_pegawai' => session('user_id'),
        ];

        if ($id != $randomid) {
            // jika id ada isinya (edit form)
            $logkerjamodel->update($id, $data);
        } else {
            // jika id tidak ada isinya (input form)
            $logkerjamodel->insert($data);
        }


        // Simpan file bukti jika ada
        // $uploadedData = [];
        $uploadPath = WRITEPATH . UPLOAD_PATH; // simpan di writable/uploads/bukti

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        foreach ($buktiFiles as $index => $file) {
            $file_id = bin2hex(random_bytes(5));
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $ext = $file->getClientExtension();
                $newName = 'bukti_' . $file_id . '.' . $ext;
                $file->move($uploadPath, $newName);


                $uploadedData = [
                    'id' => $file_id,
                    'deskripsi' => $deskripsiBukti[$index] ?? null,
                    'file_path' => UPLOAD_PATH . $newName,
                    'directory' => UPLOAD_PATH,
                    'filename'  => $newName,
                    'reference_id' =>  $id,
                    // 'kegiatan_id' => $kegiatanId // Jika kamu pakai relasi ke tabel kegiatan
                ];

                $buktiDukungModel->insert($uploadedData);
            }
        }


        return redirect()->to('/dashboard/log/saya')->with('success', 'Data kegiatan berhasil disimpan.');
    }


    public function pantauan_log_kerja()
    {
        $logKerjaModel = new LogKerjaModel();

        $user = [
            'level_jabatan_utama' => session()->get('level')['utama'],
            'level_jabatan_rangkap' => session()->get('level')['rangkap'],
            'bidang_id' => session()->get('bidang')['utama'],
            'bidang_rangkap_id' => session()->get('bidang')['rangkap'],
            'tim_id' => session()->get('tim')['utama'],
            'tim_rangkap_id' => session()->get('tim')['rangkap'],
            'ppk_id' => session()->get('ppk')['utama'],
            'ppk_rangkap_id' => session()->get('ppk')['rangkap'],
            'nip' => session()->get('nip'),
        ];

        $data['log_pekerjaan'] = $logKerjaModel->getByAccess($user);

        return  view('dashboard/logkerja/pantauan_pekerjaan', $data);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
