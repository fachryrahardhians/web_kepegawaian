<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\UserModel;
use App\Models\auth\AccountModel;
use App\Models\JabatanModel;
use App\Models\BidangModel;
use Config\Session;

class AuthController extends BaseController
{
    public function registrasi()
    {
        $bidangModel = new BidangModel();
        $jabatanModel = new JabatanModel();

        $data = [
            'bidangs' => $bidangModel->findAll(),
            'jabatans' => $jabatanModel->findAll(),
            'satker_ids' => unserialize(SATKER_IDS),
            'bidang_kpi_id' => BIDANG_KPI_ID,
            'pegawai' => null,
        ];

        return view('Auth/registrasi_page', $data);
    }

    public function submitRegistrasi()
    {
        $randomid = bin2hex(random_bytes(16));
        $pegawaiModel = new PegawaiModel();
        $userModel = new UserModel();
        $isRangkapJabatan = $this->request->getPost('toggleRangkap');

        $pegawaiModel->insert(
            [
                'id' => $id ?? $randomid,
                'nama' => $this->request->getPost('nama_lengkap'),
                'nip' => $this->request->getPost('nip'),
                'golongan' => $this->request->getPost('golongan'),
                'no_wa' => $this->request->getPost('wa'),
                'email' => $this->request->getPost('email'),
                'account_id' => $id ?? $randomid,
                'jabatan_id' => $this->request->getPost('jabatan_utama'),
                'bidang_id' => $this->request->getPost('bidang_utama'),
                'tim_id' => $this->request->getPost('tim_utama') ?? 0,
                'ppk_id' => $this->request->getPost('ppk_utama') ?? 0,
                'jabatan_rangkap_id' => $isRangkapJabatan ? $this->request->getPost('jabatan_rangkap') : 0,
                'bidang_rangkap_id' => $isRangkapJabatan ? $this->request->getPost('bidang_rangkap') : 0,
                'tim_rangkap_id' => $isRangkapJabatan ? $this->request->getPost('tim_rangkap') : 0,
                'ppk_rangkap_id' => $isRangkapJabatan ? $this->request->getPost('ppk_rangkap') : 0,
            ]
        );

        $userModel->insert(
            [
                'id' =>  $randomid,
                'username' => $this->request->getPost('nip'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]
        );


        return redirect()->to('login');
    }


    public function login()
    {
        return view('Auth/login_page');
    }

    public function registration()
    {
        return view('Auth/register_page');
    }

    public function actionRegister()
    {

        $randomid = bin2hex(random_bytes(16));

        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'nip' => 'required',
            'no_wa' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'repeat_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new PegawaiModel();

        $userModel->insert([
            'id' => $randomid,
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'no_wa' => $this->request->getPost('no_wa'),
            'email' => $this->request->getPost('email'),
            'account_id' => $randomid,
            // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);

        $accountModel = new AccountModel();

        $accountModel->insert([
            'id' =>  $randomid,
            'username' => $this->request->getPost('nip'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function actionLogin()
    {
        $session = Session();
        $accountModel = new AccountModel();
        $pegawaiModel = new PegawaiModel();

        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan nip
        $user = $accountModel->where('username', $nip)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('errors', 'NIP tidak ditemukan.');
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('errors', 'Password salah.');
        }

        if (!$user['status']) {
            return redirect()->back()->withInput()->with('errors', 'Akun Anda Non Aktif');
        }

        // Ambil data pegawai (relasi ke user)
        // $pegawai = $pegawaiModel->where('nip', $this->request->getPost('nip'))->first();
        $pegawai = $pegawaiModel->getWithJabatan($nip);

        if (!$pegawai) {
            return redirect()->back()->withInput()->with('errors', 'User Tidak Ditemukan');
        }

        // Simpan ke session
        $session->set([
            'user_id'      => $pegawai['id'],
            'nip'          => $pegawai['nip'],
            'email'        => $pegawai['email'],
            'nama' => $pegawai['nama'] ?? 'Tidak diketahui',
            'no_wa' => $pegawai['no_wa'],
            'logged_in'    => true,
            'level' => [
                'utama' => $pegawai['level_jabatan_utama'] ?? '0',
                'rangkap' => $pegawai['level_jabatan_rangkap'] ?? '0',
            ],
            'jabatan' => [
                'utama' => $pegawai['nama_jabatan_utama'],
                'rangkap' => $pegawai['nama_jabatan_rangkap'],
            ],
            'bidang' => [
                'utama' => $pegawai['bidang_id'],
                'rangkap' => $pegawai['bidang_rangkap_id'],
            ],
            'tim' => [
                'utama' => $pegawai['tim_id'],
                'rangkap' => $pegawai['tim_rangkap_id'],
            ],
            'ppk' => [
                'utama' => $pegawai['ppk_id'],
                'rangkap' => $pegawai['ppk_rangkap_id'],
            ],
            'levels' => [
                $pegawai['level_jabatan_utama'] ?? '0',
                $pegawai['level_jabatan_rangkap'] ?? '0',
            ],

        ]);

        return redirect()->to('/dashboard');
    }
}
