<?php

use App\Http\Controllers\Kehadiran\KehadiranIbadahController;
use App\Http\Controllers\Kehadiran\KehadiranKomselController;
use App\Http\Controllers\Kehadiran\KehadiranPermuridanController;
use App\Http\Controllers\AdminCabang\DashboardController as AdminCabangDashboardController;
use App\Http\Controllers\AdminCabang\Database\DatabaseJemaatController as DatabaseDatabaseJemaatController;
use App\Http\Controllers\AdminCabang\Database\JemaatController as AdminCabangDatabaseJemaatController;
use App\Http\Controllers\AdminCabang\Database\PendetaController as DatabasePendetaController;
use App\Http\Controllers\AdminCabang\IbadahController;
use App\Http\Controllers\AdminCabang\Kehadiran\AdminCabangKehadiranIbadahController;
use App\Http\Controllers\AdminCabang\Kehadiran\AdminCabangKehadiranKomselController;
use App\Http\Controllers\AdminCabang\Kehadiran\AdminCabangKehadiranPermuridanController;
use App\Http\Controllers\AdminCabang\RequestSertifikat\RequestSertifikatBaptisController;
use App\Http\Controllers\AdminCabang\RequestSertifikat\RequestSertifikatPenyerahanAnakController;
use App\Http\Controllers\AdminCabang\RequestSertifikat\RequestSertifikatPernikahanController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratCustomController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratKeputusanController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratKeteranganController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratPenunjukanController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratTugasController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanApprovalController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanKopSuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanBodySuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanFooterSuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanMasterSuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanTembusanController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanTTDController;
use App\Http\Controllers\Administrasi\Proposal\ProposalDoaController;
use App\Http\Controllers\Administrasi\Proposal\ProposalEventController;
use App\Http\Controllers\Administrasi\Proposal\ProposalKonserController;
use App\Http\Controllers\Administrasi\Proposal\ProposalLainController;
use App\Http\Controllers\Administrasi\Proposal\ProposalSeminarController;
use App\Http\Controllers\Administrasi\Sertifikat\Pengaturan\PengaturanSertifikatBaptis;
use App\Http\Controllers\Administrasi\Sertifikat\Pengaturan\PengaturanSertifikatPenyerahanAnak;
use App\Http\Controllers\Administrasi\Sertifikat\Pengaturan\PengaturanSertifikatPernikahan;
use App\Http\Controllers\Administrasi\Sertifikat\SertifikatBaptis;
use App\Http\Controllers\Administrasi\Sertifikat\SertifikatPenyerahanAnak;
use App\Http\Controllers\Administrasi\Sertifikat\SertifikatPernikahanController;
use App\Http\Controllers\Administrasi\Surat\SuratCustomController;
use App\Http\Controllers\Administrasi\Surat\SuratKeputusanController;
use App\Http\Controllers\Administrasi\Surat\SuratKeteranganController;
use App\Http\Controllers\Administrasi\Surat\SuratPenunjukanController;
use App\Http\Controllers\Administrasi\Surat\SuratTugasController;
use App\Http\Controllers\Approval\ApproveSurat\ApprovalSuratTugasController;
use App\Http\Controllers\Approval\ApproveSurat\ApproveSuratCustom;
use App\Http\Controllers\Approval\ApproveSurat\ApproveSuratKeputusan;
use App\Http\Controllers\Approval\ApproveSurat\ApproveSuratKeterangan;
use App\Http\Controllers\Approval\ApproveSurat\ApproveSuratPenunjukan;
use App\Http\Controllers\Approval\DashboardController as ApprovalDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Database\CabangController;
use App\Http\Controllers\Database\DatacabangController;
use App\Http\Controllers\Database\JemaatController;
use App\Http\Controllers\Database\PemuridanCabangController;
use App\Http\Controllers\Database\PendetaController;
use App\Http\Controllers\Database\PermuridanController;
use App\Http\Controllers\Database\PengaturanController;
use App\Http\Controllers\DatabaseJemaatController;
use App\Http\Controllers\GeneralSetting\UsersController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\Pengaturan\Surat\PengaturanSuratKeputusanController;
use App\Http\Controllers\Pengaturan\Surat\PengaturanSuratPenunjukanController;
use App\Http\Controllers\Pengaturan\Surat\PengaturanSuratTugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PWA\ContactController;
use App\Http\Controllers\Report\ReportIbadahController;
use App\Http\Controllers\Report\ReportKomselController;
use App\Http\Controllers\Report\ReportPermuridanController;
use App\Models\SertifikatPernikahan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ------------------------------------------------------------------------
// List route
// ------------------------------------------------------------------------
Route::get('/', [AuthController::class, 'login']);
// login
Route::prefix('login')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'login_action']);
});

// login
Route::get('/logout', [AuthController::class, 'logout']);

// lupa password
Route::prefix('lupapassword')->group(function () {
    Route::get('/', [LupaPasswordController::class, 'lupapassword']);
    Route::post('/', [LupaPasswordController::class, 'lupapassword_action']);
    Route::prefix('ganti_password')->group(function () {
        Route::get('/{user_id}', [LupaPasswordController::class, 'ganti_password']);
        Route::post('/{user_id}', [LupaPasswordController::class, 'ganti_password_action']);
    });
});

// foto
Route::get('/get', [ProfileController::class, 'get_file']);

Route::prefix('administrasi/sertifikat')->group(function () {
    Route::get('/baptis/{sertifikat_baptis_id}/print-view', [SertifikatBaptis::class, 'print_view']);
    Route::get('/penyerahan-anak/{sertifikat_penyerahan_anak_id}/print-view', [SertifikatPenyerahanAnak::class, 'print_view']);
    Route::get('/pernikahan/{sertifikat_pernikahan_id}/print-view', [SertifikatPernikahanController::class, 'print_view']);
});

Route::middleware(['auth'])->group(function () {
    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile']);
        Route::post('/edit-password', [ProfileController::class, 'edit_password']);
        Route::post('/edit-profile', [ProfileController::class, 'edit_profile']);
    });


    Route::middleware(['role:Superadmin'])->group(function () {
        Route::prefix('superadmin')->group(function () {

            // dashboard
            Route::prefix('')->group(function () {
                // Route::get('/', [DashboardController::class, 'dashboard']);
                Route::get('/dashboard', [DashboardController::class, 'dashboard']);
            });

            // Database
            Route::prefix('/database')->group(function () {
                Route::prefix('/database-cabang')->group(function () {
                    Route::get('/', [CabangController::class, 'cabang']);
                    Route::prefix('/cabang/{cabang_id}/sub_cabang')->group(function () {
                        Route::get('/', [CabangController::class, 'sub_cabang']);
                        Route::post('/', [CabangController::class, 'tambah_sub_cabang']);
                        Route::post('/{sub_cabang_id}', [CabangController::class, 'edit_sub_cabang']);
                        Route::get('/{sub_cabang_id}/hapus', [CabangController::class, 'hapus_sub_cabang']);
                        Route::get('/{sub_cabang_id}/upgrade_cabang', [CabangController::class, 'upgrade_cabang']);
                    });
                    Route::prefix('/cabang')->group(function () {
                        Route::post('/', [CabangController::class, 'tambah_cabang']);
                        Route::post('/{cabang_id}', [CabangController::class, 'edit_cabang']);
                        Route::get('/hapus/{cabang_id}', [CabangController::class, 'hapus_cabang']);
                    });
                    Route::prefix('/ibadah')->group(function () {
                        Route::post('/', [CabangController::class, 'tambah_ibadah']);
                        Route::post('/{ibadah_id}', [CabangController::class, 'edit_ibadah']);
                        Route::get('/hapus/{ibadah_id}', [CabangController::class, 'hapus_ibadah']);
                    });
                    Route::prefix('/komsel')->group(function () {
                        Route::post('/', [CabangController::class, 'tambah_komsel']);
                        Route::post('/{komsel_id}', [CabangController::class, 'edit_komsel']);
                        Route::get('/hapus/{komsel_id}', [CabangController::class, 'hapus_komsel']);
                    });
                    Route::prefix('/kelompok-pa')->group(function () {
                        Route::post('/', [CabangController::class, 'tambah_kelompok_pa']);
                        Route::post('/{kelompok_pa_id}', [CabangController::class, 'edit_kelompok_pa']);
                        Route::get('/hapus/{kelompok_pa_id}', [CabangController::class, 'hapus_kelompok_pa']);
                    });
                    Route::prefix('/event')->group(function () {
                        Route::post('/', [CabangController::class, 'tambah_event']);
                        Route::post('/{event_id}', [CabangController::class, 'edit_event']);
                        Route::get('/hapus/{event_id}', [CabangController::class, 'hapus_event']);
                    });
                });
                //superadmin
                Route::prefix('/database-permuridan')->group(function () {
                    Route::get('/', [PermuridanController::class, 'permuridan']);
                    Route::post('/editpass/{id}', [PermuridanController::class, 'editpass']);

                    Route::prefix('/kakak-pa')->group(function () {
                        Route::post('/', [PermuridanController::class, 'tambah_kakak_pa']);
                        Route::post('/{user_id}', [PermuridanController::class, 'edit_kakak_pa']);
                        Route::prefix('/{user_id}/anak-pa')->group(function () {
                            Route::get('/', [PermuridanController::class, 'anak_pa_by_kakak_pa']);
                            Route::post('/', [PermuridanController::class, 'tambah_anak_pa']);
                            Route::post('/{anak_pa_user_id}', [PermuridanController::class, 'edit_anak_pa']);
                            Route::get('{anak_pa_user_id}/hapus', [PermuridanController::class, 'hapus_anak_pa']);
                        });
                        Route::get('hapus/{user_id}', [PermuridanController::class, 'hapus_kakak_pa']);
                    });
                    // Route::prefix('/anak-pa')->group(function () {
                    //     Route::post('/', [PermuridanController::class, 'tambah_anak_pa']);
                    //     Route::post('/{user_id}', [PermuridanController::class, 'edit_anak_pa']);
                    //     Route::get('hapus/{user_id}', [PermuridanController::class, 'hapus_anak_pa']);
                    // });
                    Route::prefix('/bahan')->group(function () {
                        Route::post('/', [PermuridanController::class, 'tambah_bahan']);
                        Route::post('/{bahan_pa_id}', [PermuridanController::class, 'edit_bahan']);
                        Route::get('hapus/{bahan_pa_id}', [PermuridanController::class, 'hapus_bahan']);
                    });
                    Route::prefix('/bab')->group(function () {
                        Route::post('/', [PermuridanController::class, 'tambah_bab']);
                        Route::post('/{bab_pa_id}', [PermuridanController::class, 'edit_bab']);
                        Route::get('hapus/{bab_pa_id}', [PermuridanController::class, 'hapus_bab']);
                    });
                });
                //superadmin
                Route::prefix('/database-jemaat')->group(function () {
                    Route::get('/', [JemaatController::class, 'jemaat']);
                    Route::post('/', [JemaatController::class, 'tambah_jemaat']);
                    Route::post('/{jemaat_id}', [JemaatController::class, 'edit_jemaat']);
                    Route::get('/{jemaat_id}/hapus', [JemaatController::class, 'hapus_jemaat']);
                });
                Route::prefix('/database-pendeta')->group(function () {
                    Route::get('/', [PendetaController::class, 'pendeta']);
                    Route::post('/', [PendetaController::class, 'tambah_pendeta']);
                    Route::post('/{pendeta_id}', [PendetaController::class, 'edit_pendeta']);
                    Route::get('/{pendeta_id}/hapus', [PendetaController::class, 'hapus_pendeta']);
                });

                Route::prefix('/database-pengaturan')->group(function () {
                    Route::get('/', [PengaturanController::class, 'pengaturan']);
                });
            });

            // Administrasi
            Route::prefix('/administrasi')->group(function () {

                // surat
                Route::prefix('/surat')->group(function () {
                    Route::get('/lihat/{surat_id}', [SuratKeteranganController::class, 'lihat_surat']);
                    Route::get('/pdf/{surat_id}', [SuratKeteranganController::class, 'pdf']);
                    Route::post('/edit-master-surat/{surat_id}', [SuratKeteranganController::class, 'ubah_master_surat']);

                    Route::prefix('/surat-keterangan')->group(function () {
                        Route::get('/', [SuratKeteranganController::class, 'surat_keterangan']);
                        Route::post('/ubah-status/{surat_id}', [SuratKeteranganController::class, 'ubah_status']);
                    });
                    Route::prefix('/surat-keputusan')->group(function () {
                        Route::get('/', [SuratKeputusanController::class, 'surat_keputusan']);
                        Route::get('/lihat/{surat_keputusan_id}', [SuratKeputusanController::class, 'lihat_surat']);
                        Route::post('/ubah-template/{surat_keputusan_id}', [SuratKeputusanController::class, 'ubah_pengaturan']);
                        Route::post('/ubah-status/{surat_keputusan_id}', [SuratKeputusanController::class, 'ubah_status']);
                    });
                    Route::prefix('/surat-penunjukan')->group(function () {
                        Route::get('/', [SuratPenunjukanController::class, 'surat_penunjukan']);
                        Route::get('/lihat/{surat_keputusan_id}', [SuratPenunjukanController::class, 'lihat_surat']);
                        Route::post('/ubah-template/{surat_keputusan_id}', [SuratPenunjukanController::class, 'ubah_pengaturan']);
                        Route::post('/ubah-status/{surat_id}', [SuratPenunjukanController::class, 'ubah_status']);
                    });
                    Route::prefix('/surat-tugas')->group(function () {
                        Route::get('/', [SuratTugasController::class, 'surat_tugas']);
                        Route::get('/lihat/{surat_keputusan_id}', [SuratTugasController::class, 'lihat_surat']);
                        Route::post('/ubah-template/{surat_keputusan_id}', [SuratTugasController::class, 'ubah_pengaturan']);
                        Route::post('/ubah-status/{surat_id}', [SuratTugasController::class, 'ubah_status']);
                    });
                    Route::prefix('/surat-custom')->group(function () {
                        Route::get('/', [SuratCustomController::class, 'surat_custom']);
                        Route::post('/ubah-status/{surat_id}', [SuratCustomController::class, 'ubah_status']);
                    });
                });

                //Proposal
                Route::prefix('/proposal')->group(function () {
                    Route::post('/{proposal_id}', [ProposalEventController::class, 'edit_status_proposal']);

                    Route::prefix('/event')->group(function () {
                        Route::get('/', [ProposalEventController::class, 'proposal_event']);
                    });
                    Route::prefix('/doa')->group(function () {
                        Route::get('/', [ProposalDoaController::class, 'proposal_doa']);
                    });
                    Route::prefix('/seminar')->group(function () {
                        Route::get('/', [ProposalSeminarController::class, 'proposal_seminar']);
                    });
                    Route::prefix('/konser')->group(function () {
                        Route::get('/', [ProposalKonserController::class, 'proposal_konser']);
                    });
                    Route::prefix('/lain')->group(function () {
                        Route::get('/', [ProposalLainController::class, 'proposal_lain']);
                    });
                });
                // Superadmin
                Route::prefix('/sertifikat')->group(function () {
                    Route::prefix('/pengaturan')->group(function () {
                        Route::prefix('/sertifikat-baptis')->group(function () {
                            Route::get('/', [PengaturanSertifikatBaptis::class, 'list']);
                            Route::post('/', [PengaturanSertifikatBaptis::class, 'edit']);
                            Route::get('/print-view', [PengaturanSertifikatBaptis::class, 'print_view']);
                        });
                        Route::prefix('/sertifikat-penyerahan-anak')->group(function () {
                            Route::get('/', [PengaturanSertifikatPenyerahanAnak::class, 'list']);
                            Route::post('/', [PengaturanSertifikatPenyerahanAnak::class, 'edit']);
                            Route::get('/print-view', [PengaturanSertifikatPenyerahanAnak::class, 'print_view']);
                        });
                        Route::prefix('/sertifikat-pernikahan')->group(function () {
                            Route::get('/', [PengaturanSertifikatPernikahan::class, 'list']);
                            Route::post('/', [PengaturanSertifikatPernikahan::class, 'edit']);
                            Route::get('/print-view', [PengaturanSertifikatPernikahan::class, 'print_view']);
                        });
                    });
                    Route::prefix('/baptis')->group(function () {
                        Route::get('/', [SertifikatBaptis::class, 'list']);
                        Route::post('/', [SertifikatBaptis::class, 'tambah']);
                        Route::post('/{sertifikat_baptis_id}', [SertifikatBaptis::class, 'edit']);
                        Route::get('/{sertifikat_baptis_id}/hapus', [SertifikatBaptis::class, 'hapus']);
                        Route::get('/{sertifikat_baptis_id}/print-view', [SertifikatBaptis::class, 'print_view']);
                    });
                    Route::prefix('/penyerahan-anak')->group(function () {
                        Route::get('/', [SertifikatPenyerahanAnak::class, 'list']);
                        Route::post('/', [SertifikatPenyerahanAnak::class, 'tambah']);
                        Route::post('/{sertifikat_penyerahan_anak_id}', [SertifikatPenyerahanAnak::class, 'edit']);
                        Route::get('/{sertifikat_penyerahan_anak_id}/hapus', [SertifikatPenyerahanAnak::class, 'hapus']);
                        Route::get('/{sertifikat_penyerahan_anak_id}/print-view', [SertifikatPenyerahanAnak::class, 'print_view']);
                    });
                    Route::prefix('/pernikahan')->group(function () {
                        Route::get('/', [SertifikatPernikahanController::class, 'list']);
                        Route::post('/', [SertifikatPernikahanController::class, 'tambah']);
                        Route::post('/{sertifikat_pernikahan_id}', [SertifikatPernikahanController::class, 'edit']);
                        Route::get('/{sertifikat_pernikahan_id}/hapus', [SertifikatPernikahanController::class, 'hapus']);
                        Route::get('/{sertifikat_pernikahan_id}/print-view', [SertifikatPernikahanController::class, 'print_view']);
                    });
                });
            });

            // Kehadiran
            Route::prefix('/kehadiran')->group(function () {
                Route::prefix('/ibadah')->group(function () {
                    Route::get('/', [KehadiranIbadahController::class, 'ibadah']);
                    Route::post('/', [KehadiranIbadahController::class, 'tambah_ibadah']);
                    Route::post('/edit/{ibadah_detail_id}', [KehadiranIbadahController::class, 'edit_ibadah']);
                    Route::get('/hapus/{ibadah_detail_id}', [KehadiranIbadahController::class, 'hapus_ibadah']);
                    Route::get('/{id}', [KehadiranIbadahController::class, 'detailibadah']);
                });
                Route::prefix('/permuridan')->group(function () {
                    Route::get('/', [KehadiranPermuridanController::class, 'permuridan']);
                    Route::post('/', [KehadiranPermuridanController::class, 'tambah_permuridan']);
                    Route::get('/{permuridan_id}/hapus', [KehadiranPermuridanController::class, 'hapus_permuridan']);
                    Route::prefix('/{permuridan_id}/detail')->group(function () {
                        Route::get('/', [KehadiranPermuridanController::class, 'permuridan_detail']);
                        Route::post('/', [KehadiranPermuridanController::class, 'tambah_permuridan_detail']);
                        Route::get('/{permuridan_detail_id}/hapus', [KehadiranPermuridanController::class, 'hapus_permuridan_detail']);
                        Route::get('/{permuridan_detail_id}/ganti-flag-hadir', [KehadiranPermuridanController::class, 'ganti_flag_permuridan_detail']);
                    });
                });
                Route::prefix('/komsel')->group(function () {
                    Route::get('/', [KehadiranKomselController::class, 'komsel']);
                    Route::post('/', [KehadiranKomselController::class, 'tambah_komsel']);
                    Route::post('/{komsel_detail_id}', [KehadiranKomselController::class, 'edit_komsel']);
                    Route::get('/hapus/{komsel_detail_id}', [KehadiranKomselController::class, 'hapus_komsel']);
                });
            });

            //Report
            Route::prefix('/report')->group(function () {
                Route::prefix('/ibadah')->group(function () {
                    Route::get('/', [ReportIbadahController::class, 'report']);
                    Route::get('/export', [ReportIbadahController::class, 'export_excel']);
                });
                Route::prefix('/komsel')->group(function () {
                    Route::get('/', [ReportKomselController::class, 'report']);
                    Route::get('/export', [ReportKomselController::class, 'export_excel']);
                });
                Route::prefix('/permuridan')->group(function () {
                    Route::get('/', [ReportPermuridanController::class, 'report']);
                    Route::get('/export', [ReportPermuridanController::class, 'export_excel']);
                    Route::prefix('/{permuridan_id}')->group(function () {
                        Route::get('/detail', [ReportPermuridanController::class, 'permuridan_detail']);
                        Route::get('/export', [ReportPermuridanController::class, 'export_permuridan_detail']);
                    });
                });
            });
            // Setting
            Route::prefix('/admin')->group(function () {
                Route::get('/', [UsersController::class, 'user']);
                Route::post('/', [UsersController::class, 'tambah_user']);
                Route::post('/{user_id}', [UsersController::class, 'edit_user']);
                Route::get('hapus/{user_id}', [UsersController::class, 'hapus_user']);
            });

            Route::prefix('/approval-surat')->group(function () {
                Route::get('/', [PengaturanApprovalController::class, 'approval']);
                Route::post('/edit-approval/{id}', [PengaturanApprovalController::class, 'edit_approval']);
                Route::post('/', [PengaturanApprovalController::class, 'tambah_approval']);
                Route::post('/tambah-approval', [PengaturanApprovalController::class, 'tambah_approval']);
                Route::get('/hapus/{id}', [PengaturanApprovalController::class, 'hapus_approval']);
            });


            // PWA
            Route::prefix('/pwa')->group(function () {
                Route::prefix('/contact')->group(function () {
                    Route::get('/', [ContactController::class, 'contact']);
                    Route::post('/', [ContactController::class, 'edit_contact']);
                });
            });
            Route::prefix('/pengaturan')->group(function () {
                Route::prefix('/command')->group(function () {
                    Route::get('/', [CommandController::class, 'command_ui']);
                    Route::get('/pwa/deploy', [CommandController::class, 'pwa_deploy']);
                    Route::get('/superadmin/deploy', [CommandController::class, 'superadmin_deploy']);
                });

                Route::prefix('/kop-surat')->group(function () {
                    Route::get('/', [PengaturanKopSuratController::class, 'kop_surat']);
                    Route::get('/export', [PengaturanKopSuratController::class, 'export']);
                    Route::post('/', [PengaturanKopSuratController::class, 'tambah_kop']);
                    Route::post('/{kop_id}', [PengaturanKopSuratController::class, 'edit_kop']);
                    Route::get('/hapus/{id}', [PengaturanKopSuratController::class, 'hapus_kop']);
                });
                Route::prefix('/body-surat')->group(function () {
                    Route::get('/', [PengaturanBodySuratController::class, 'body_surat']);
                    Route::post('/tambah-body', [PengaturanBodySuratController::class, 'tambah_body']);
                    Route::get('/{id}', [PengaturanBodySuratController::class, 'view_body']);
                    Route::post('/edit-body/{id}', [PengaturanBodySuratController::class, 'edit_body']);
                    Route::get('/hapus/{id}', [PengaturanBodySuratController::class, 'hapus_body']);
                });
                Route::prefix('/master-surat')->group(function () {
                    Route::get('/', [PengaturanMasterSuratController::class, 'master_surat']);
                    Route::get('lihat/{template_master_id}', [PengaturanMasterSuratController::class, 'lihat_master_surat']);
                    Route::get('/tambah-master', [PengaturanMasterSuratController::class, 'tambah_master_view']);
                    Route::get('/berhasil-tambah', [PengaturanMasterSuratController::class, 'berhasil']);
                    Route::get('/hapus/{template_master_id}', [PengaturanMasterSuratController::class, 'hapus']);
                });
                Route::prefix('/tembusan-surat')->group(function () {
                    Route::get('/', [PengaturanTembusanController::class, 'tembusan_surat']);
                    Route::post('/', [PengaturanTembusanController::class, 'tambah_tembusan_surat']);
                    Route::post('/edit-tembusan/{id}', [PengaturanTembusanController::class, 'edit_tembusan']);
                    Route::get('/hapus/{tembusan_id}', [PengaturanTembusanController::class, 'hapus_tembusan_surat']);
                });

                Route::prefix('/footer-surat')->group(function () {
                    Route::get('/', [PengaturanFooterSuratController::class, 'footer_surat']);
                    Route::post('/', [PengaturanFooterSuratController::class, 'tambah_footer_surat']);
                    Route::post('/edit-footer/{id}', [PengaturanFooterSuratController::class, 'edit_footer']);
                    Route::get('/hapus/{template_footer_id}', [PengaturanFooterSuratController::class, 'hapus_footer_surat']);
                });
                Route::prefix('/ttd-surat')->group(function () {
                    Route::get('/', [PengaturanTTDController::class, 'ttd_surat']);
                    Route::post('/tambah-ttd', [PengaturanTTDController::class, 'tambah_ttd_surat']);
                    Route::post('/edit-ttd/{id}', [PengaturanTTDController::class, 'edit_ttd_surat']);
                    Route::get('/hapus/{ttd_id}', [PengaturanTTDController::class, 'hapus_ttd_surat']);
                });

                Route::prefix('/surat')->group(function () {
                    Route::prefix('/keputusan')->group(function () {
                        Route::get('/', [PengaturanSuratKeputusanController::class, 'list']);

                        Route::get('/tambah', [PengaturanSuratKeputusanController::class, 'tambah']);
                        Route::post('/tambah', [PengaturanSuratKeputusanController::class, 'tambah_action']);
                        Route::get('/{pengaturan_surat_keputusan_id}/edit', [PengaturanSuratKeputusanController::class, 'edit']);
                        Route::post('/{pengaturan_surat_keputusan_id}/edit', [PengaturanSuratKeputusanController::class, 'edit_action']);

                        Route::get('/{pengaturan_surat_keputusan_id}/lihat', [PengaturanSuratKeputusanController::class, 'lihat']);
                        Route::get('/{pengaturan_surat_keputusan_id}/hapus', [PengaturanSuratKeputusanController::class, 'hapus']);
                    });
                    Route::prefix('/penunjukan')->group(function () {
                        Route::get('/', [PengaturanSuratPenunjukanController::class, 'list']);

                        Route::get('/tambah', [PengaturanSuratPenunjukanController::class, 'tambah']);
                        Route::post('/tambah', [PengaturanSuratPenunjukanController::class, 'tambah_action']);
                        Route::get('/{pengaturan_surat_penunjukan_id}/edit', [PengaturanSuratPenunjukanController::class, 'edit']);
                        Route::post('/{pengaturan_surat_penunjukan_id}/edit', [PengaturanSuratPenunjukanController::class, 'edit_action']);

                        Route::get('/{pengaturan_surat_penunjukan_id}/lihat', [PengaturanSuratPenunjukanController::class, 'lihat']);
                        Route::get('/{pengaturan_surat_penunjukan_id}/hapus', [PengaturanSuratPenunjukanController::class, 'hapus']);
                    });
                    Route::prefix('/tugas')->group(function () {
                        Route::get('/', [PengaturanSuratTugasController::class, 'list']);

                        Route::get('/tambah', [PengaturanSuratTugasController::class, 'tambah']);
                        Route::post('/tambah', [PengaturanSuratTugasController::class, 'tambah_action']);
                        Route::get('/{pengaturan_surat_tugas_id}/edit', [PengaturanSuratTugasController::class, 'edit']);
                        Route::post('/{pengaturan_surat_tugas_id}/edit', [PengaturanSuratTugasController::class, 'edit_action']);

                        Route::get('/{pengaturan_surat_tugas_id}/lihat', [PengaturanSuratTugasController::class, 'lihat']);
                        Route::get('/{pengaturan_surat_tugas_id}/hapus', [PengaturanSuratTugasController::class, 'hapus']);
                    });
                });

                Route::prefix('/audit-trail')->group(function () {
                    Route::get('/', [\App\Http\Controllers\Pengaturan\LogController::class, 'audit_trail']);
                });
                Route::prefix('/system-errors')->group(function () {
                    Route::get('/', [\App\Http\Controllers\Pengaturan\LogController::class, 'system_errors']);
                    Route::get('/{id}', [\App\Http\Controllers\Pengaturan\LogController::class, 'system_error_detail']);
                });

                Route::prefix('/maintenance')->group(function () {
                    Route::get('/', [\App\Http\Controllers\Pengaturan\MaintenanceController::class, 'index']);
                });
            });
        });
    });



    Route::middleware(['role:Admin Cabang'])->group(function () {
        Route::prefix('admin-cabang')->group(function () {
            Route::get('/', [DashboardController::class, 'dashboard']);
            Route::get('/dashboard', [AdminCabangDashboardController::class, 'dashboard']);
            Route::get('/ibadah', [IbadahController::class, 'ibadah']);
            // Database
            Route::prefix('/database')->group(function () {
                Route::prefix('/database-cabang')->group(function () {
                    Route::get('/', [DatacabangController::class, 'cabang']);
                    Route::prefix('/ibadah')->group(function () {
                        Route::post('/', [DatacabangController::class, 'tambah_ibadah']);
                        Route::post('/{ibadah_id}', [DatacabangController::class, 'edit_ibadah']);
                        Route::get('/hapus/{ibadah_id}', [DatacabangController::class, 'hapus_ibadah']);
                    });
                    Route::prefix('/komsel')->group(function () {
                        Route::post('/', [DatacabangController::class, 'tambah_komsel']);
                        Route::post('/{komsel_id}', [DatacabangController::class, 'edit_komsel']);
                        Route::get('/hapus/{komsel_id}', [DatacabangController::class, 'hapus_komsel']);
                    });
                    Route::prefix('/kelompok-pa')->group(function () {
                        Route::post('/', [DatacabangController::class, 'tambah_kelompok_pa']);
                        Route::post('/{kelompok_pa_id}', [DatacabangController::class, 'edit_kelompok_pa']);
                        Route::get('/hapus/{kelompok_pa_id}', [DatacabangController::class, 'hapus_kelompok_pa']);
                    });
                    Route::prefix('/event')->group(function () {
                        Route::post('/', [DatacabangController::class, 'tambah_event']);
                        Route::post('/{event_id}', [DatacabangController::class, 'edit_event']);
                        Route::get('/hapus/{event_id}', [DatacabangController::class, 'hapus_event']);
                    });
                });
                //admin-cabang
                Route::prefix('/database-permuridan')->group(function () {
                    Route::get('/', [PemuridanCabangController::class, 'permuridan']);
                    Route::post('/editpass/{id}', [PemuridanCabangController::class, 'editpass']);

                    Route::prefix('/kakak-pa')->group(function () {
                        Route::post('/', [PemuridanCabangController::class, 'tambah_kakak_pa']);
                        Route::post('/{user_id}', [PemuridanCabangController::class, 'edit_kakak_pa']);
                        Route::get('hapus/{user_id}', [PemuridanCabangController::class, 'hapus_kakak_pa']);
                        // prefix anak-pa
                        Route::prefix('{user_id}/anak-pa')->group(function () {
                            Route::get('/', [PemuridanCabangController::class, 'list_anak_pa']);
                            Route::post('/', [PemuridanCabangController::class, 'tambah_anak_pa']);
                            Route::post('/{anak_pa_user_id}', [PemuridanCabangController::class, 'edit_anak_pa']);
                            Route::get('hapus/{anak_pa_user_id}', [PemuridanCabangController::class, 'hapus_anak_pa']);
                        });
                    });
                    Route::prefix('/anak-pa')->group(function () {
                        Route::post('/', [PemuridanCabangController::class, 'tambah_anak_pa']);
                        Route::post('/{user_id}', [PemuridanCabangController::class, 'edit_anak_pa']);
                        Route::get('hapus/{user_id}', [PemuridanCabangController::class, 'hapus_anak_pa']);
                    });
                });
                Route::prefix('/database-pendeta')->group(function () {
                    Route::get('/', [DatabasePendetaController::class, 'pendeta']);
                    Route::post('/', [DatabasePendetaController::class, 'tambah_pendeta']);
                    Route::post('/{pendeta_id}', [DatabasePendetaController::class, 'edit_pendeta']);
                    Route::get('/{pendeta_id}/hapus', [DatabasePendetaController::class, 'hapus_pendeta']);
                });
                //admin_cabang
                Route::prefix('/database-jemaat')->group(function () {
                    Route::get('/', [AdminCabangDatabaseJemaatController::class, 'jemaat']);
                    Route::post('/', [AdminCabangDatabaseJemaatController::class, 'tambah_jemaat']);
                    Route::post('/{jemaat_id}', [AdminCabangDatabaseJemaatController::class, 'edit_jemaat']);
                    Route::get('/{jemaat_id}/hapus', [AdminCabangDatabaseJemaatController::class, 'hapus_jemaat']);
                });
            });

            Route::prefix('/kehadiran')->group(function () {
                Route::prefix('/ibadah')->group(function () {
                    Route::get('/', [AdminCabangKehadiranIbadahController::class, 'ibadah']);
                    Route::post('/', [AdminCabangKehadiranIbadahController::class, 'tambah_ibadah']);
                    Route::post('/edit/{ibadah_detail_id}', [AdminCabangKehadiranIbadahController::class, 'edit_ibadah']);
                    Route::get('/hapus/{ibadah_detail_id}', [AdminCabangKehadiranIbadahController::class, 'hapus_ibadah']);
                    Route::get('/{id}', [AdminCabangKehadiranIbadahController::class, 'api_ibadah_detail']);
                });
                Route::prefix('/permuridan')->group(function () {
                    Route::get('/', [AdminCabangKehadiranPermuridanController::class, 'permuridan']);
                    Route::post('/', [AdminCabangKehadiranPermuridanController::class, 'tambah_permuridan']);
                    Route::get('/{permuridan_id}/hapus', [AdminCabangKehadiranPermuridanController::class, 'hapus_permuridan']);
                    Route::prefix('/{permuridan_id}/detail')->group(function () {
                        Route::get('/', [AdminCabangKehadiranPermuridanController::class, 'permuridan_detail']);
                        Route::post('/', [AdminCabangKehadiranPermuridanController::class, 'tambah_permuridan_detail']);
                        Route::get('/{permuridan_detail_id}/hapus', [AdminCabangKehadiranPermuridanController::class, 'hapus_permuridan_detail']);
                        Route::get('/{permuridan_detail_id}/ganti-flag-hadir', [AdminCabangKehadiranPermuridanController::class, 'ganti_flag_permuridan_detail']);
                    });
                });
                Route::prefix('/komsel')->group(function () {
                    Route::get('/', [AdminCabangKehadiranKomselController::class, 'komsel']);
                    Route::post('/', [AdminCabangKehadiranKomselController::class, 'tambah_komsel']);
                    Route::post('/{komsel_detail_id}', [AdminCabangKehadiranKomselController::class, 'edit_komsel']);
                    Route::get('/hapus/{komsel_detail_id}', [AdminCabangKehadiranKomselController::class, 'hapus_komsel']);
                });
            });

            Route::prefix('/request-surat')->group(function () {

                Route::prefix('/surat-keterangan')->group(function () {
                    Route::get('/', [RequestSuratKeteranganController::class, 'request_surat']);
                    Route::post('/', [RequestSuratKeteranganController::class, 'tambah_request_surat']);
                });

                Route::prefix('/surat-penunjukan')->group(function () {
                    Route::get('/', [RequestSuratPenunjukanController::class, 'request_surat']);
                    Route::post('/', [RequestSuratPenunjukanController::class, 'tambah_request_surat']);
                    Route::post('/revisi/{surat_id}', [RequestSuratPenunjukanController::class, 'revisi_request_surat']);
                    Route::get('/lihat/{surat_id}', [SuratPenunjukanController::class, 'lihat_surat']);
                    Route::get('/hapus/{surat_id}', [RequestSuratPenunjukanController::class, 'hapus_surat']);
                });

                Route::prefix('/surat-keputusan')->group(function () {
                    Route::get('/', [RequestSuratKeputusanController::class, 'request_surat']);
                    Route::post('/', [RequestSuratKeputusanController::class, 'tambah_request_surat']);
                    Route::post('/revisi/{surat_id}', [RequestSuratKeputusanController::class, 'revisi_request_surat']);
                    Route::get('/lihat/{surat_id}', [SuratKeputusanController::class, 'lihat_surat']);
                    Route::get('/hapus/{surat_id}', [RequestSuratKeputusanController::class, 'hapus_surat']);
                });

                Route::prefix('/surat-tugas')->group(function () {
                    Route::get('/', [RequestSuratTugasController::class, 'request_surat']);
                    Route::post('/', [RequestSuratTugasController::class, 'tambah_request_surat']);
                    Route::post('/revisi/{surat_id}', [RequestSuratTugasController::class, 'revisi_request_surat']);
                    Route::get('/lihat/{surat_id}', [SuratTugasController::class, 'lihat_surat']);
                    Route::get('/hapus/{surat_id}', [RequestSuratTugasController::class, 'hapus_surat']);
                });

                Route::prefix('/surat-custom')->group(function () {
                    Route::get('/', [RequestSuratCustomController::class, 'request_surat']);
                    Route::post('/', [RequestSuratCustomController::class, 'tambah_request_surat']);
                });
            });
            // Admin cabang
            Route::prefix('/request-sertifikat')->group(function () {
                Route::prefix('/sertifikat-baptis')->group(function () {
                    Route::get('/', [RequestSertifikatBaptisController::class, 'list']);
                    Route::post('/', [RequestSertifikatBaptisController::class, 'tambah']);
                    Route::post('/{sertifikat_baptis_id}', [RequestSertifikatBaptisController::class, 'edit']);
                    Route::get('/{sertifikat_baptis_id}/print-view', [SertifikatBaptis::class, 'print_view']);
                });
                Route::prefix('/sertifikat-penyerahan-anak')->group(function () {
                    Route::get('/', [RequestSertifikatPenyerahanAnakController::class, 'list']);
                    Route::post('/', [RequestSertifikatPenyerahanAnakController::class, 'tambah']);
                    Route::post('/{sertifikat_penyerah_ananak_id}', [RequestSertifikatPenyerahanAnakController::class, 'edit']);
                    Route::get('/{sertifikat_penyerahan_anak_id}/print-view', [SertifikatPenyerahanAnak::class, 'print_view']);
                });
                Route::prefix('/sertifikat-pernikahan')->group(function () {
                    Route::get('/', [RequestSertifikatPernikahanController::class, 'list']);
                    Route::post('/', [RequestSertifikatPernikahanController::class, 'tambah']);
                    Route::post('/{sertifikat_pernikahan_id}', [RequestSertifikatPernikahanController::class, 'edit']);
                    Route::get('/{sertifikat_pernikahan_id}/print-view', [SertifikatPernikahanController::class, 'print_view']);
                });
            });
        });
    });




    Route::middleware(['role:Approval'])->group(function () {
        Route::prefix('approval')->group(function () {
            Route::get('/', [ApprovalDashboardController::class, 'dashboard']);
            Route::get('/dashboard', [ApprovalDashboardController::class, 'dashboard']);
            Route::get('/ibadah', [IbadahController::class, 'ibadah']);

            Route::prefix('approve-surat')->group(function () {
                Route::post('/demote/{surat_id}', [ApproveSuratCustom::class, 'demote_surat']);
                Route::get('/approve/{surat_id}', [ApproveSuratCustom::class, 'approve_surat']);
                Route::get('/lihat/{surat_id}', [ApproveSuratCustom::class, 'lihat_surat']);


                Route::prefix('surat-keterangan')->group(function () {
                    Route::get('/', [ApproveSuratKeterangan::class, 'list_approval']);
                });
                Route::prefix('surat-penunjukan')->group(function () {
                    Route::get('/', [ApproveSuratPenunjukan::class, 'list_approval']);
                    Route::get('/lihat/{surat_id}', [SuratPenunjukanController::class, 'lihat_surat']);
                    Route::get('/approve/{surat_id}', [ApproveSuratPenunjukan::class, 'approve_surat']);
                    Route::post('/demote/{surat_id}', [ApproveSuratPenunjukan::class, 'demote_surat']);
                });
                Route::prefix('surat-keputusan')->group(function () {
                    Route::get('/', [ApproveSuratKeputusan::class, 'list_approval']);
                    Route::get('/lihat/{surat_id}', [SuratKeputusanController::class, 'lihat_surat']);
                    Route::get('/approve/{surat_id}', [ApproveSuratKeputusan::class, 'approve_surat']);
                    Route::post('/demote/{surat_id}', [ApproveSuratKeputusan::class, 'demote_surat']);
                });
                Route::prefix('surat-tugas')->group(function () {
                    Route::get('/', [ApprovalSuratTugasController::class, 'list_approval']);
                    Route::get('/lihat/{surat_id}', [SuratTugasController::class, 'lihat_surat']);
                    Route::get('/approve/{surat_id}', [ApprovalSuratTugasController::class, 'approve_surat']);
                    Route::post('/demote/{surat_id}', [ApprovalSuratTugasController::class, 'demote_surat']);
                });
                Route::prefix('surat-custom')->group(function () {
                    Route::get('/', [ApproveSuratCustom::class, 'list_approval']);
                });
            });
        });
    });
});
