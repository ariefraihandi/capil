<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SidebarMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PtspController;
use App\Http\Controllers\BarcodeController;

use App\Http\Controllers\SiramasakanController;

Route::get('/',                                     [AuthController::class, 'showLoginForm'])->name('login.view')->middleware(RedirectIfAuthenticated::class);

Route::get('/auth',                                 [AuthController::class, 'showLoginForm'])->name('login.view')->middleware(RedirectIfAuthenticated::class);
// Route::get('/register',                             [AuthController::class, 'showRegisterForm'])->name('register.view')->middleware(RedirectIfAuthenticated::class);
// Route::get('/register',                             [AuthController::class, 'showRegisterForm'])->name('register.view')->middleware(RedirectIfAuthenticated::class);

Route::get('/register',                             [AuthController::class, 'showRegisterForm'])->name('register.view')->middleware(RedirectIfAuthenticated::class);
Route::post('/register/submit',                     [AuthController::class, 'submitRegister'])->name('register.submit');
Route::get('/logout',                               [AuthController::class, 'logout'])->name('logout');
Route::post('/login',                               [AuthController::class, 'login'])->name('submitLogin');


// Route::middleware([AuthMiddleware::class, SidebarMiddleware::class])->group(function () {
   
    Route::get('/admin/permohonan',                 [SiramasakanController::class, 'index'])->name('admin.permohonan');
   

    Route::get('/admin/user/access',                [AdminController::class, 'showRole'])->name('admin.user.access');
    Route::get('/admin/user/list',                  [AdminController::class, 'showUserList'])->name('admin.user.list');
    Route::get('/admin/menu/menulist',              [AdminController::class, 'showMenu'])->name('admin.menu.menulist');
    Route::get('/admin/menu/submenulist',           [AdminController::class, 'showsubMenu'])->name('admin.menu.submenulist');
    Route::get('/admin/menu/childmenulist',         [AdminController::class, 'showchildMenu'])->name('admin.menu.childmenulist');
    Route::get('/admin/menu/role',                  [AdminController::class, 'showRoleList'])->name('admin.menu.role');    
// });
        
Route::middleware([AuthMiddleware::class])->group(function () {
    Route::post('/permohonan/download',             [PtspController::class, 'permohonanStore'])->name('pemohon.download'); 
    Route::get('/permohonan/delete',                [PtspController::class, 'permohonanDelete'])->name('delete.permohonan');
   
    // Route::get('/syarat',                           [PtspController::class, 'show'])->name('syarat.show');
    // Route::get('/ptsp/syarat',                      [PtspController::class, 'tambahSyarat'])->name('tambah.syarat');
    // Route::get('/delete/perkara',                   [PtspController::class, 'deletePerkara'])->name('perkara.delete');
    // Route::get('/syaratPerkara/{id}/move-up',       [PtspController::class, 'moveUp'])->name('syaratPerkara.moveUp');
    // Route::get('/syaratPerkara/{id}/move-down',     [PtspController::class, 'moveDown'])->name('syaratPerkara.moveDown');
    // Route::post('/syarat-perkara/update',           [PtspController::class, 'updateSyarat'])->name('syarat.update');
    // Route::get('/syarat/delete',                    [PtspController::class, 'destroySyarat'])->name('syarat.destroy');

    // Route::post('/perkara/store',                   [PtspController::class, 'perkaraStore'])->name('perkara.store');   
    // Route::post('/perkara/update/{id}',             [PtspController::class, 'updatePerkara']);
    // Route::post('/syarat/store',                    [PtspController::class, 'storeSyarat'])->name('syarat.store');
    
    // Route::get('/cetak/pemohoninformasi/{id}',      [PtspController::class, 'cetakPermohonanInformasi'])->name('cetak.permohonan');    
    // Route::get('/delete/pemohoninformasi',          [PtspController::class, 'deletePemohon'])->name('pemohon.delete');    
    // Route::get('/delete/feedback',                  [PtspController::class, 'deleteFeedback'])->name('feedback.delete');
    
    
    Route::post('/pemohon/upload/document',         [PtspController::class, 'uploadDocument'])->name('pemohon.store');
    Route::get('cetak/receipt/ubahstatus/{id}',     [SiramasakanController::class, 'cetakUbahStatus'])->name('receipt.ubahstatus');
    Route::post('/update-status',                   [SiramasakanController::class, 'updateStatus'])->name('update.status.capil');   

    // Route::get('/kepegawaian/cuti/atasan',          [CutiController::class, 'showCutiDetailAtasanLangsung'])->name('kepegawaian.cuti.atasan');
    // Route::get('/kepegawaian/cuti/pejabat',         [CutiController::class, 'showCutiDetailpejabat'])->name('kepegawaian.cuti.pejabat');
    // Route::get('/kepegawaian/cuti/penomoran',       [CutiController::class, 'showCutiDetailPenomoran'])->name('kepegawaian.cuti.penomoran');
    // Route::get('/cuti/delete',                      [CutiController::class, 'destroy'])->name('cuti.delete');
    // Route::get('/cuti/delete',                      [CutiController::class, 'destroy'])->name('submit-cutiSakit');

    Route::post('/admin/user/changeaccess',         [AdminController::class, 'changeAccess'])->name('admin.user.changeaccess');    
    Route::post('/menu',                            [AdminController::class, 'addMenu'])->name('menu.add');
    Route::post('/add-submenu',                     [AdminController::class, 'addSubmenu'])->name('add.submenu');
    Route::post('/add-childsubmenu',                [AdminController::class, 'addChildSubmenu'])->name('add.ChildSubmenu');
    Route::get('/delete/menu',                      [AdminController::class, 'deleteMenu'])->name('delete.menu');
    Route::get('/delete/childsubmenu',              [AdminController::class, 'deleteChildSubMenu'])->name('delete.ChildSubmenu');
    Route::post('/instansi/store',                  [AdminController::class, 'instansiStore'])->name('instansi.store');

    Route::post('/role/add',                        [AdminController::class, 'addRole'])->name('role.add');
    Route::post('/role/edit',                       [AdminController::class, 'editRole'])->name('role.edit');
    Route::get('/delete/role',                      [AdminController::class, 'deleteRole'])->name('role.delete');
    Route::post('/change/role',                     [AdminController::class, 'changerole'])->name('changeRole');
    // Route::post('/account/avatar',                  [UserController::class, 'uploadAvatar'])->name('upload.avatar');
    // Route::post('/account/update',                  [UserController::class, 'accountUpdate'])->name('account.update');    
   
    // Route::post('/pegawai/add',                     [KepegawaianController::class, 'pegawaiAdd'])->name('pegawai.add');
    // Route::get('/kepegawaian/pegawai/destroy',      [KepegawaianController::class, 'destroyPegawai'])->name('pegawai.destroy');
    // Route::post('/save-atasan',                     [KepegawaianController::class, 'saveAtasan'])->name('save-atasan');
    // Route::post('/update-kehadiran',                [KepegawaianController::class, 'saveAtasan'])->name('update-kehadiran');
    // Route::post('/awalkerja/update',                [KepegawaianController::class, 'updateAwalKerja'])->name('awalkerja.update');
    
    // Route::post('/edit-cuti-sisa',                  [CutiController::class, 'editCutiSisa'])->name('editCutiSisa');
    // Route::post('/submit-cutitahunan',              [CutiController::class, 'submitCutiTahunan'])->name('submit-cutiTahunan');
    // Route::post('/submit-cutiapprove',              [CutiController::class, 'cutiApprove'])->name('cuti.approve');
    // Route::post('/submit-cutiperubahan',            [CutiController::class, 'cutiPerubahan'])->name('cuti.perubahan');
    // Route::post('/submit-cutipenanguhan',           [CutiController::class, 'cutiPenanguhan'])->name('cuti.penanguhan');
    // Route::post('/submit-cutitolak',                [CutiController::class, 'cutiTolak'])->name('cuti.tolak');
    // Route::post('/cuti-tolak-pejabat',              [CutiController::class, 'cutiTolakPejabat'])->name('cuti.tolak.pejabat');
    // Route::post('/cuti/tangguh/pejabat',            [CutiController::class, 'tangguhPejabat'])->name('cuti.tangguh.pejabat');
    // Route::post('/cuti/penanguhan/update',          [CutiController::class, 'updatePenanguhan'])->name('cuti.penanguhan.update');
    // Route::get('/send/notifyCuti',                  [CutiController::class, 'notifyCuti'])->name('notifyCuti');

    // Route::post('/submit-penomoran',                [CutiController::class, 'penomoranStore'])->name('penomoran.store');    
    // Route::post('/hitung-hari-cuti',                [CutiController::class, 'hitungHariCuti']);
    //Move
        Route::post('/move-menu',                   [AdminController::class, 'moveMenu'])->name('move.menu');
        Route::post('/move-submenu',                [AdminController::class, 'moveSubmenu'])->name('move.submenu');
        Route::post('/move-childsubmenu',           [AdminController::class, 'moveChildSubmenu'])->name('moveChildSubmenu');
    //!Move
    // Route::post('/store-device-token',              [NotificationController::class, 'storeDeviceToken']);
    // Route::post('/check-device',                    [NotificationController::class, 'checkDevice']);
    // Route::post('/send-notification/{userId}',      [NotificationController::class, 'sendNotificationToUser']);    
    
    

    // Route::post('/send/cuti/notif',                [CutiController::class, 'sendCutiNotifications'])->name('sendCutiNotifications');
    
    
    

    Route::get('/getdata/menu',                     [AdminController::class, 'getDataMenu'])->name('menu.getData');
    Route::get('/getdata/submenu',                  [AdminController::class, 'getDatasubMenu'])->name('getDatasubMenu');
    Route::get('/getdata/childmenu',                [AdminController::class, 'getDataChildMenu'])->name('getDataChildMenu');
    Route::get('/getdata/rolelist',                 [AdminController::class, 'getDataRoleList'])->name('roleList.getData');
    // Route::get('/getdata/user',                     [AdminController::class, 'userGetData'])->name('user.getData');
    // Route::get('/getdata/pegawai',                  [KepegawaianController::class, 'pegawaiGetData'])->name('pegawai.getData');
    // Route::get('/getdata/cutisisa',                 [CutiController::class, 'sisaCutigetData'])->name('cutis.getData');
    // Route::get('/getdata/cuti/permohonan',          [CutiController::class, 'permohonanCutigetData'])->name('cutis.permohonangetData');
    // Route::get('/getdata/cuti/permohonan/ata',      [CutiController::class, 'permohonanCutiForAtasan'])->name('cutis.permohonangetAtasanData');
    // Route::get('/getdata/cuti/pernomoran',          [CutiController::class, 'penomoranCutiData'])->name('cutis.permohonaNomorData');
    // Route::get('/getdata/cuti/list',                [CutiController::class, 'daftarCutigetData'])->name('cutis.daftarCutidetData');
    // Route::get('/getdata/perkara',                  [PtspController::class, 'getPerkaraData'])->name('perkara.data');
    // Route::get('pemohon-informasi-data',            [PtspController::class, 'getPemohonInformasiData'])->name('pemohon.informasi.data');
    // Route::get('pemohon-produk-data',               [PtspController::class, 'getPemohonUbahDataData'])->name('pemohon.ubahStatus.data');
    // Route::get('/getdata/kritir',                   [PtspController::class, 'kritirData'])->name('kritis.data');
    // Route::get('/pemohon/{id}/info',                [PtspController::class, 'getPemohonInfo'])->name('pemohon.info');    
    // Route::get('/perkara/{id}',                     [PtspController::class, 'getPerkaraNameById']);
    // Route::post('/cetak-laporan/informasi',         [PtspController::class, 'cetakLaporan'])->name('cetak.laporan.informasi');
    // Route::get('/cetak-laporan/pdf',                [PtspController::class, 'cetakLaporanPDF'])->name('cetak.informasi');


    


    // Route::post('/cancel/siramasakan',              [PtspController::class, 'batalkanPengajuan'])->name('batal.siramasakan');
    // Route::post('/pemohon/edit',                    [PtspController::class, 'pemohonEdit'])->name('pemohon.edit');
    
    // Route::post('/wasbid/store',                    [WasbidController::class, 'storeWasbid'])->name('wasbid.store');
    // Route::post('/wasbid/edit',                     [WasbidController::class, 'editWasbid'])->name('wasbid.update');
    // Route::post('/wasbid/edit/eviden',              [WasbidController::class, 'editEviden'])->name('wasbid.updateEviden');
});


Route::get('/barcode/capil/scan',                   [BarcodeController::class, 'getSignDataSiramasakan'])->name('barcodestatus.scan');


