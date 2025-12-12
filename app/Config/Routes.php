<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Auth\AuthController::login');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login/submit', 'Auth\AuthController::actionLogin');
// $routes->get('/register', 'Auth\AuthController::registration');
// $routes->post('/register/submit', 'Auth\AuthController::actionRegister');
$routes->get('/register', 'Auth\AuthController::registrasi');
$routes->post('/registrasi/submit', 'Auth\AuthController::submitRegistrasi');
$routes->get('/logout', 'Dashboard\DashboardController::logout');


$routes->group('dashboard', function ($routes) {
    $routes->get('/', 'Dashboard\DashboardController::index', ['filter' => 'auth']);
    $routes->get('utama', 'Dashboard\DashboardController::utama', ['filter' => 'auth'], ['filter' => 'auth']);
    $routes->get('utama/data-saya', 'Dashboard\DashboardController::data_saya', ['filter' => 'auth']);
    $routes->get('utama/bukti-dukung-bravo', 'Dashboard\DashboardController::bukti_dukung_bravo', ['filter' => 'auth']);
    $routes->get('utama/survey-kepuasan', 'Dashboard\DashboardController::survey_kepuasan', ['filter' => 'auth']);
    $routes->get('pengembangan', 'Dashboard\DashboardController::pengembangan', ['filter' => 'auth']);
    // $routes->get('log', 'Dashboard\DashboardController::log');
    $routes->get('log/saya', 'Dashboard\DashboardController::view_log_kerja_saya', ['filter' => 'auth']);
    $routes->get('log/pantauan', 'Dashboard\DashboardController::pantauan_log_kerja', ['filter' => 'auth']);
    $routes->get('log/form_log_kerja', 'Dashboard\DashboardController::form_log_kerja_saya', ['filter' => 'auth']);
    $routes->get('log/edit_log_kerja/(:any)', 'Dashboard\DashboardController::edit_log_kerja_saya/$1', ['filter' => 'auth']);
    $routes->post('log/submit', 'Dashboard\DashboardController::submit_log_kerja', ['filter' => 'auth']);

    $routes->get('log/rencana_hasil_kerja_atasan', 'Dashboard\DashboardController::view_rencana_kerja_atasan', ['filter' => 'auth']);
    $routes->get('log/form_rencana_kerja_atasan', 'Dashboard\DashboardController::form_rencana_kerja_atasan', ['filter' => 'auth']);

    $routes->get('log/riwayat_log_kerja', 'Dashboard\DashboardController::riwayat_log_kerja', ['filter' => 'auth']);
    $routes->get('log/rencana_hasil_kerja_atasan/delete/(:num)', 'Dashboard\DashboardController::delete_rencana_hasil_kerja_atasan/$1', ['filter' => 'auth']);
    $routes->post('log/submit_rencana_kerja_atasan', 'Dashboard\DashboardController::submit_rencana_kerja_atasan', ['filter' => 'auth']);
    $routes->get('profil', 'Dashboard\DashboardController::profil', ['filter' => 'auth']);
    $routes->get('profil/edit', 'Dashboard\DashboardController::formEditProfile', ['filter' => 'auth']);
    $routes->post('profil/edit/submit', 'Dashboard\DashboardController::submitEditProfile', ['filter' => 'auth']);
});

$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin\AdminController::login');
    $routes->post('login/submit', 'Admin\AdminController::loginAction');
    $routes->get('logout', 'Admin\AdminController::logOut',);
    $routes->get('index', 'Admin\AdminController::index', ['filter' => 'auth:admin']);
    $routes->get('stats', 'Admin\AdminController::index', ['filter' => 'auth:admin']);
    $routes->group('pegawai', function ($routes) {
        $routes->get('/', 'Admin\AdminController::view_all_pegawai', ['filter' => 'auth:admin']);
        $routes->get('tambah', 'Admin\AdminController::form_input_pegawai', ['filter' => 'auth:admin']);
        $routes->get('edit/(:any)', 'Admin\AdminController::form_edit_pegawai/$1', ['filter' => 'auth:admin']);
        $routes->get('detail/(:any)', 'Admin\Controller::detailPegawai/$1', [], ['filter' => 'auth:admin']);
        $routes->post('submit', 'Admin\AdminController::submit_form_pegawai', ['filter' => 'auth:admin']);
        $routes->get('getPpk', 'Admin\AdminController::getPpk', ['filter' => 'auth:admin']);
        $routes->get('getTim', 'Admin\AdminController::getTim', ['filter' => 'auth:admin']);
    });

    $routes->group('api', function ($routes) {
        $routes->delete('pegawai/inactive/(:any)', 'Api\ApiController::pegawaiInactive/$1', ['filter' => 'auth:admin']);
        $routes->delete('pegawai/activate/(:any)', 'Api\ApiController::pegawaiActivate/$1', ['filter' => 'auth:admin']);
        $routes->get('pegawai/detail/(:any)', 'Api\ApiController::pegawaiDetail/$1', ['filter' => 'auth:admin']);
        $routes->post('bidang/submit', 'Admin\AdminController::submitBidang', ['filter' => 'auth:admin']);
        $routes->post('tim/submit', 'Admin\AdminController::submitTim', ['filter' => 'auth:admin']);
        $routes->post('ppk/submit', 'Admin\AdminController::submitPpk', ['filter' => 'auth:admin']);
        $routes->get('get/tim', 'Admin\AdminController::getTim', ['filter' => 'auth:admin']);
    });

    $routes->group('struktur', function ($routes) {
        $routes->get('bidang', 'Admin\AdminController::view_all_bidang', ['filter' => 'auth:admin']);
        $routes->get('bidang/tambah', 'Admin\AdminController::formTambahBidang', ['filter' => 'auth:admin']);
        $routes->get('bidang/edit/(:any)', 'Admin\AdminController::formEditBidang/$1', ['filter' => 'auth:admin']);
        $routes->get('tim', 'Admin\AdminController::view_all_tim', ['filter' => 'auth:admin']);
        $routes->get('tim/tambah', 'Admin\AdminController::formTambahTim', ['filter' => 'auth:admin']);
        $routes->get('tim/edit/(:any)', 'Admin\AdminController::formEditTim/$1', ['filter' => 'auth:admin']);
        $routes->get('ppk', 'Admin\AdminController::view_all_ppk', ['filter' => 'auth:admin']);
        $routes->get('ppk/tambah', 'Admin\AdminController::formTambahPpk', ['filter' => 'auth:admin']);
        $routes->get('ppk/edit/(:any)', 'Admin\AdminController::formEditPpk/$1', ['filter' => 'auth:admin']);
    });
});

$routes->group(
    'api',
    function ($routes) {
        $routes->get('get/ppk', 'Api\ApiController::getppk');
        $routes->get('get/tim', 'Api\ApiController::gettim');
        $routes->get('log/get', 'Api\ApiController::getLogKerjaSaya', ['filter' => 'auth']);
        $routes->delete('log/delete/(:any)', 'Api\ApiController::deleteLogKerja/$1', ['filter' => 'auth']);
        $routes->delete('log/delete/lampiran/(:any)', 'Api\ApiController::hapusFileBuktiDukung/$1', ['filter' => 'auth']);
        $routes->get('log/view/lampiran/(:any)', 'Api\ApiController::bukaFileBuktiDukung/$1', ['filter' => 'auth']);
    }
);
$routes->get('/test-db', function () {
    $db = \Config\Database::connect();
    echo $db->getVersion(); // Harusnya muncul versi MySQL
});
