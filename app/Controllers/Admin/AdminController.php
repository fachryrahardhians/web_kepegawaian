<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\JabatanModel;
use App\Models\BidangModel;
use App\Models\PpkModel;
use App\Models\TimModel;
use App\Models\UserModel;

use function PHPUnit\Framework\isEmpty;

class AdminController extends BaseController
{

    public function login()
    {
        return view('admin/pages/auth/login_page');
    }

    public function loginAction()
    {
        $session = Session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('errors', 'User tidak ditemukan.');
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('errors', 'Password salah.');
        }

        if ($user['isadmin'] != '1') {
            return redirect()->back()->withInput()->with('errors', 'User Tidak Ditemukan');
        }

        $session->set([
            'admin_login'   => true,
            'admin_name'    => $user['username'],
            'admin_id'      => $user['id']
        ]);

        return redirect()->to('admin/index');
    }


    public function index()
    {
        return view('admin/pages/home/index');
    }

    public function view_all_pegawai()
    {
        $pegawaiModel = new PegawaiModel();

        $data['pegawai'] = $pegawaiModel->getWithBidang();

        return view('admin/pages/pegawai/view_list_pegawai', $data);
    }


    public function form_input_pegawai()
    {
        $bidangModel = new BidangModel();
        $jabatanModel = new JabatanModel();

        $data = [
            'bidangs' => $bidangModel->findAll(),
            'jabatans' => $jabatanModel->findAll(),
            'satker_ids' => unserialize(SATKER_IDS),
            'bidang_kpi_id' => BIDANG_KPI_ID,
            'pegawai' => null,
            'account' => null,
        ];

        return view('admin/pages/pegawai/form_input_pegawai', $data);
    }

    public function form_edit_pegawai($id)
    {
        $bidangModel = new BidangModel();
        $jabatanModel = new JabatanModel();
        $pegawaiModel = new PegawaiModel();
        $userModel = new UserModel();

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

        return view('admin/pages/pegawai/form_input_pegawai', $data);
    }

    public function submit_form_pegawai()
    {
        $randomid = bin2hex(random_bytes(16));
        $pegawaiModel = new PegawaiModel();
        $userModel = new UserModel();
        $id = $this->request->getPost('id');
        $isRangkapJabatan = $this->request->getPost('toggleRangkap');

        $data = [
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
        ];

        $dataAccount = [
            'status' => $this->request->getPost('status_acc'),
        ];

        if ($id) {
            // jika sudah ada id, berarti edit data yang sudah ada
            $pegawaiModel->update($id, $data);
            $userModel->update($id, $dataAccount);
        } else {
            // jika belum ada id , berarti input data baru 
            // insert data user ( akun )
            $userModel->insert([
                'id' =>  $randomid,
                'username' => $this->request->getPost('nip'),
                'password' => password_hash($this->request->getPost('nip'), PASSWORD_DEFAULT),
                'status' => $this->request->getPost('status_acc'),
            ]);

            // insert data pegawai
            $pegawaiModel->insert($data);
        }


        // todo diberi validasi untuk form disini


        return redirect()->to('admin/pegawai')->with('show_alert', 'Data Pegawai Berhasil Disimpan');
    }

    public function view_all_bidang()
    {
        $bidangModel = new BidangModel();

        $data = [
            'bidang' => $bidangModel->findAll(),
        ];

        return view('admin/pages/struktur/bidang/view_all_bidang', $data);
    }

    public function formTambahBidang()
    {
        return view('admin/pages/struktur/bidang/form_bidang');
    }

    public function formEditBidang($id)
    {
        $bidangModel = new BidangModel();

        $data = [
            'bidang' => $bidangModel->find($id),
        ];

        return view('admin/pages/struktur/bidang/form_bidang', $data);
    }

    public function submitBidang()
    {
        $bidangModel = new BidangModel();

        $id = $this->request->getPost('id') ?? '';
        $nama_bidang = $this->request->getPost('name');

        if ($id != '') {
            $bidangModel->update($id, ['nama_bidang' => $nama_bidang,]);
        } else {
            $bidangModel->insert(['nama_bidang' => $nama_bidang,]);
        }

        return redirect()->to('admin/struktur/bidang');
    }

    public function view_all_tim()
    {
        $timModel = new TimModel();

        $data = [
            'tim' => $timModel->getJoinBidang(),
        ];

        return view('admin/pages/struktur/tim/view_all_tim', $data);
    }

    public function formTambahTim()
    {
        $bidangModel = new BidangModel();

        $data = [
            'bidang' => $bidangModel->findAll(),
        ];

        return view('admin/pages/struktur/tim/form_tim', $data);
    }


    public function submitTim()
    {
        $timModel = new TimModel();

        $id = $this->request->getPost('id');
        $timName = $this->request->getPost('name');
        $bidangId = $this->request->getPost('bidang');

        if (!empty($id)) {
            $timModel->update($id, [
                'nama_tim' => $timName,
                'bidang_id' => $bidangId,
            ]);    // action untuk edit
        } else {
            // action untuk input 
            $timModel->insert([
                'nama_tim' => $timName,
                'bidang_id' => $bidangId,
            ]);
        }
        return redirect()->to('admin/struktur/tim');
    }

    public function formEditTim($id)
    {
        $bidangModel = new BidangModel();
        $timModel = new TimModel();

        $data = [
            'bidang' => $bidangModel->findAll(),
            'tim' => $timModel->find($id),
        ];

        return view('admin/pages/struktur/tim/form_tim', $data);
    }

    public function view_all_ppk()
    {
        $ppkModel = new PpkModel();

        $data = [
            'ppk' => $ppkModel->getJoinBidangTim(),
        ];

        return view('admin/pages/struktur/ppk/view_all_ppk', $data);
    }

    public function formTambahPpk()
    {
        $bidangModel = new BidangModel();

        $data = [
            'bidang' => $bidangModel->findAll(),
            'satker_ids' => unserialize(SATKER_IDS),
            'bidang_kpi_id' => BIDANG_KPI_ID,
        ];

        return view('admin/pages/struktur/ppk/form_ppk', $data);
    }

    public function formEditPpk($id)
    {
        $bidangModel = new BidangModel();
        $ppkModel = new PpkModel();

        $data = [
            'bidang' => $bidangModel->findAll(),
            'ppk' => $ppkModel->find($id),
            'satker_ids' => unserialize(SATKER_IDS),
            'bidang_kpi_id' => BIDANG_KPI_ID,
        ];

        return view('admin/pages/struktur/ppk/form_ppk', $data);
    }

    public function submitPpk()
    {
        $ppkModel = new PpkModel();

        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('name');
        $bidang = $this->request->getPost('bidang');
        $satker = $this->request->getPost('tim');

        if (!empty($id)) {
            $ppkModel->update($id, ['nama_ppk' => $nama, 'bidang_id' => $bidang, 'satker_id' => $satker ?? '0',]);
        } else {
            $ppkModel->insert(['nama_ppk' => $nama, 'bidang_id' => $bidang, 'satker_id' => $satker ?? '0',]);
        }

        return redirect()->to('admin/struktur/ppk');
    }

    public function logOut()
    {
        session()->destroy();

        return redirect()->to('admin');
    }

    public function getTim()
    {
        $timModel = new TimModel();
        $bidangId = $this->request->getVar('bidang_id');
        $data = $timModel->where('bidang_id', $bidangId)->findAll();

        // Petakan nama field menjadi 'nama'
        $result = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'nama' => $item['nama_tim']
            ];
        }, $data);

        return $this->response->setJSON($result);
    }


    public function getPpk()
    {
        $ppkModel = new PpkModel();
        $timId = $this->request->getVar('tim_id');
        $data = $ppkModel->where('satker_id', $timId)->findAll();

        $result = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'nama' => $item['nama_ppk']
            ];
        }, $data);

        return $this->response->setJSON($result);
    }
}
