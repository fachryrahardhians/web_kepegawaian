<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\BidangModel;
use App\Models\PpkModel;
use App\Models\TimModel;
use App\Models\BuktiDukungModel;
use App\Models\LogKerjaModel;
use Kint\Value\Context\BaseContext;


class ApiController extends BaseController
{
    public function getppk()
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

    public function gettim()
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

    public function bukaFileBuktiDukung($id)
    {
        $buktiDukungModel = new BuktiDukungModel();
        // temukan data berdasarkan id
        $target = $buktiDukungModel->find($id);
        // restruktur nama file 
        $targetPath = WRITEPATH . UPLOAD_PATH . $target['filename'];

        if (!is_file($targetPath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Dokumen tidak ditemukan.");
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($targetPath))
            ->setBody(file_get_contents($targetPath));
    }

    public function hapusFileBuktiDukung($id)
    {
        $buktiDukungModel = new BuktiDukungModel();
        // get data yang ingin dihapus
        $target = $buktiDukungModel->find($id);
        // hapus file terkait berdasarkan filepath / directory / filename
        $targetPath = WRITEPATH . UPLOAD_PATH . basename($target['filename']);

        if (file_exists($targetPath) && is_file($targetPath)) {
            unlink($targetPath);
        }
        // hapus data bukti dukung dari database     
        $buktiDukungModel->delete($id);
    }

    public function getLogKerjaSaya()
    {
        $logKerjaModel = new LogKerjaModel();
        $idPegawai = Session()->get('user_id');
        $data = $logKerjaModel->where('id_pegawai', $idPegawai)->findAll();

        // Petakan nama field menjadi 'nama'
        $result = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'tanggal' => $item['tanggal'],
                'start' => $item['start'],
                'end' => $item['end'],
                'uraian' => $item['uraian'],
                'output' => $item['output'],
                'lokasi' => $item['lokasi'],
            ];
        }, $data);

        return $this->response->setJSON($result);
    }

    public function deleteLogKerja($id)
    {
        $logKerjaModel = new LogKerjaModel();
        $buktiDukungModel = new BuktiDukungModel();
        // $id = $this->request->getVar('id');

        // get data bukti dukung terlebih dahulu
        $bukti = $buktiDukungModel->where('reference_id', $id)->findAll();
        // delete bukti dukung 
        foreach ($bukti as $item) {
            $targetPath = WRITEPATH . UPLOAD_PATH . basename($item['filename']);

            if (file_exists($targetPath) && is_file($targetPath)) {
                unlink($targetPath);
            }
            // hapus data bukti dukung dari database     
            $buktiDukungModel->delete($item['id']);
        }
        // delete data log kerja 
        $logKerjaModel->delete($id);
    }
}
