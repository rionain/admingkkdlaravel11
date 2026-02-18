<?php

use App\Http\Controllers\AdminCabang\Database\JemaatController as DatabaseJemaatController;
use App\Http\Controllers\AdminCabang\Kehadiran\AdminCabangKehadiranIbadahController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratKeputusanController;
use App\Http\Controllers\Kehadiran\KehadiranIbadahController;
use App\Http\Controllers\Kehadiran\KehadiranKomselController;
use App\Http\Controllers\Kehadiran\KehadiranPermuridanController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratKeteranganController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratPenunjukanController;
use App\Http\Controllers\AdminCabang\RequestSurat\RequestSuratTugasController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanApprovalController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanBodySuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanFooterSuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanKopSuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanMasterSuratController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanTembusanController;
use App\Http\Controllers\Administrasi\Pengaturan\PengaturanTTDController;
use App\Http\Controllers\Administrasi\Proposal\ProposalDoaController;
use App\Http\Controllers\Administrasi\Proposal\ProposalEventController;
use App\Http\Controllers\Administrasi\Proposal\ProposalKonserController;
use App\Http\Controllers\Administrasi\Proposal\ProposalLainController;
use App\Http\Controllers\Administrasi\Proposal\ProposalSeminarController;
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
use App\Http\Controllers\Approval\ApproveSurat\ApproveSuratPenunjukan;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Database\CabangController;
use App\Http\Controllers\Database\DatacabangController;
use App\Http\Controllers\Database\JemaatController;
use App\Http\Controllers\Database\PemuridanCabangController;
use App\Http\Controllers\Database\PendetaController;
use App\Http\Controllers\Database\PermuridanController;
use App\Http\Controllers\GeneralSetting\UsersController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// auth
Route::post('superadmin/setting/command/deploy', [CommandController::class, 'superadmin_deploy_api']);

Route::prefix('v1')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::middleware(['role:Superadmin'])->group(function () {
            Route::prefix('superadmin')->group(function () {

                // database
                Route::prefix('database')->group(function () {

                    // cabang
                    Route::prefix('database-cabang')->group(function () {
                        Route::get('/', function () {
                            return [
                                'cabang'        => url('api/v1/superadmin/database/database-cabang/cabang'),
                                'ibadah'        => url('api/v1/superadmin/database/database-cabang/ibadah'),
                                'komsel'        => url('api/v1/superadmin/database/database-cabang/komsel'),
                                'kelompok-pa'   => url('api/v1/superadmin/database/database-cabang/kelompok-pa'),
                                'event'         => url('api/v1/superadmin/database/database-cabang/event'),
                            ];
                        });
                        Route::prefix('cabang')->group(function () {
                            Route::get('/', [CabangController::class, 'api_cabang_all']);
                            Route::get('/{cabang_id}', [CabangController::class, 'api_cabang_detail']);
                            Route::prefix('/{cabang_id}/sub_cabang')->group(function () {
                                Route::get('/', [CabangController::class, 'api_sub_cabang_all']);
                                Route::get('/{sub_cabang_id}', [CabangController::class, 'api_sub_cabang_detail']);
                            });
                        });
                        Route::prefix('ibadah')->group(function () {
                            Route::get('/', [CabangController::class, 'api_ibadah_all']);
                            Route::get('/{ibadah_id}', [CabangController::class, 'api_ibadah_detail']);
                        });
                        Route::prefix('komsel')->group(function () {
                            Route::get('/', [CabangController::class, 'api_komsel_all']);
                            Route::get('/{komsel_id}', [CabangController::class, 'api_komsel_detail']);
                        });
                        Route::prefix('kelompok-pa')->group(function () {
                            Route::get('/', [CabangController::class, 'api_kelompok_pa_all']);
                            Route::get('/{kelompok_pa_id}', [CabangController::class, 'api_kelompok_pa_detail']);
                        });
                        Route::prefix('event')->group(function () {
                            Route::get('/', [CabangController::class, 'api_event_all']);
                            Route::get('/{event_id}', [CabangController::class, 'api_event_detail']);
                        });
                    });

                    // permuridan
                    Route::prefix('database-permuridan')->group(function () {
                        Route::get('/', function () {
                            return [
                                'kakak-pa'      => url('api/v1/superadmin/database/database-permuridan/kakak-pa'),
                            ];
                        });
                        Route::prefix('kakak-pa')->group(function () {
                            Route::get('/', [PermuridanController::class, 'api_kakak_pa_all']);
                            Route::get('/{user_id}', [PermuridanController::class, 'api_kakak_pa_detail']);
                        });
                        Route::prefix('anak-pa')->group(function () {
                            Route::get('/', [PermuridanController::class, 'api_anak_pa_all']);
                            Route::get('/{user_id}', [PermuridanController::class, 'api_anak_pa_detail']);
                        });
                        Route::prefix('bahan')->group(function () {
                            Route::get('/', [PermuridanController::class, 'api_bahan_all']);
                            Route::get('/{bahan_pa_id}', [PermuridanController::class, 'api_bahan_detail']);
                        });
                        Route::prefix('bab')->group(function () {
                            Route::get('/', [PermuridanController::class, 'api_bab_all']);
                            Route::get('/{bab_pa_id}', [PermuridanController::class, 'api_bab_detail']);
                        });
                    });
                    // database jemaat
                    Route::prefix('database-jemaat')->group(function () {
                        Route::get('/', [JemaatController::class, 'api_all']);
                        Route::get('/{jemaat_id}', [JemaatController::class, 'api_detail']);
                    });
                    // database pendeta
                    Route::prefix('database-pendeta')->group(function () {
                        Route::get('/', [PendetaController::class, 'api_all']);
                        Route::get('/{pendeta_id}', [PendetaController::class, 'api_detail']);
                    });
                });
                // ------------------------------------------------------------------------
                // administrasi
                Route::prefix('administrasi')->group(function () {
                    Route::get('/', function () {
                        return [
                            'kop'       => url('api/v1/superadmin/administrasi/pengaturan/kop-surat'),
                            'body'      => url('api/v1/superadmin/administrasi/pengaturan/body-surat'),
                            'approval'  => url('api/v1/superadmin/administrasi/pengaturan/approval-surat'),
                            'tembusan'  => url('api/v1/superadmin/administrasi/pengaturan/tembusan-surat'),
                            'footer'    => url('api/v1/superadmin/administrasi/pengaturan/footer-surat'),
                            'master'    => url('api/v1/superadmin/administrasi/pengaturan/master-surat'),
                        ];
                    });
                    // surat
                    Route::prefix('surat')->group(function () {
                        Route::prefix('surat-keterangan')->group(function () {
                            Route::get('/', [SuratKeteranganController::class, 'api_surat_keterangan_all']);
                            Route::get('/{surat_id}', [SuratKeteranganController::class, 'api_surat_keterangan_detail']);
                        });
                        Route::prefix('surat-penunjukan')->group(function () {
                            Route::get('/', [SuratPenunjukanController::class, 'api_surat_penunjukan_all']);
                            Route::get('/{surat_id}', [SuratPenunjukanController::class, 'api_surat_penunjukan_detail']);
                        });
                        Route::prefix('surat-keputusan')->group(function () {
                            Route::get('/', [SuratKeputusanController::class, 'api_surat_keputusan_all']);
                            Route::get('/{surat_id}', [SuratKeputusanController::class, 'api_surat_keputusan_detail']);
                        });
                        Route::prefix('surat-tugas')->group(function () {
                            Route::get('/', [SuratTugasController::class, 'api_surat_tugas_all']);
                            Route::get('/{surat_id}', [SuratTugasController::class, 'api_surat_tugas_detail']);
                        });
                        Route::prefix('surat-custom')->group(function () {
                            Route::get('/', [SuratCustomController::class, 'api_surat_custom_all']);
                            Route::get('/{surat_id}', [SuratCustomController::class, 'api_surat_custom_detail']);
                        });
                    });

                    // proposal
                    Route::prefix('proposal')->group(function () {
                        Route::get('/', [ProposalEventController::class, 'api_proposal_all']);
                        Route::get('/{proposal_id}', [ProposalEventController::class, 'api_proposal_detail']);
                    });

                    // sertifikat
                    Route::prefix('sertifikat')->group(function () {
                        Route::prefix('baptis')->group(function () {
                            Route::get('/', [SertifikatBaptis::class, 'api_sertifikat_all']);
                            Route::get('/{sertifikat_baptis_id}', [SertifikatBaptis::class, 'api_sertifikat_detail']);
                        });
                        Route::prefix('penyerahan-anak')->group(function () {
                            Route::get('/', [SertifikatPenyerahanAnak::class, 'api_sertifikat_all']);
                            Route::get('/{sertifikat_baptis_id}', [SertifikatPenyerahanAnak::class, 'api_sertifikat_detail']);
                        });
                        Route::prefix('pernikahan')->group(function () {
                            Route::get('/', [SertifikatPernikahanController::class, 'api_sertifikat_all']);
                            Route::get('/{sertifikat_baptis_id}', [SertifikatPernikahanController::class, 'api_sertifikat_detail']);
                        });
                    });
                });

                // ------------------------------------------------------------------------
                // kehadiran
                Route::prefix('kehadiran')->group(function () {
                    Route::get('/', function () {
                        return [
                            'ibadah'       => url('api/v1/superadmin/kehadiran/ibadah'),
                            'komsel'       => url('api/v1/superadmin/kehadiran/komsel'),
                            'permuridan'   => url('api/v1/superadmin/kehadiran/permuridan'),
                        ];
                    });
                    Route::prefix('ibadah')->group(function () {
                        Route::get('/', [KehadiranIbadahController::class, 'api_ibadah_all']);
                        Route::get('/{ibadah_detail_id}', [KehadiranIbadahController::class, 'api_ibadah_detail']);
                    });
                    Route::prefix('komsel')->group(function () {
                        Route::get('/', [KehadiranKomselController::class, 'api_komsel_all']);
                        Route::get('/{komsel_detail_id}', [KehadiranKomselController::class, 'api_komsel_detail']);
                    });
                    Route::prefix('permuridan')->group(function () {
                        Route::get('/get-user', [KehadiranPermuridanController::class, 'api_permuridan_get_user']);
                        Route::get('/', [KehadiranPermuridanController::class, 'api_permuridan_all']);
                        Route::get('/{permuridan_detail_id}', [KehadiranPermuridanController::class, 'api_permuridan_detail']);
                    });
                });


                Route::prefix('admin')->group(function () {
                    Route::get('/', [UsersController::class, 'api_users_all']);
                    Route::get('/{user_id}', [UsersController::class, 'api_users_detail']);
                });
                Route::prefix('approval-surat')->group(function () {
                    Route::get('/', [PengaturanApprovalController::class, 'api_approval_all']);
                    Route::get('/{approval_id}', [PengaturanApprovalController::class, 'api_approval_detail']);
                });

                Route::prefix('pengaturan')->group(function () {
                    Route::prefix('status-surat')->group(function () {
                        Route::get('/', [DashboardController::class, 'api_status_surat_all']);
                    });


                    Route::prefix('kop-surat')->group(function () {
                        Route::get('/', [PengaturanKopSuratController::class, 'api_kop_surat_all']);
                        Route::get('/{kop_id}', [PengaturanKopSuratController::class, 'api_kop_surat_detail']);
                    });
                    Route::prefix('body-surat')->group(function () {
                        Route::get('/', [PengaturanBodySuratController::class, 'api_template_body_all']);
                        Route::get('/{template_body_id}', [PengaturanBodySuratController::class, 'api_template_body_detail']);
                    });
                    Route::prefix('ttd-surat')->group(function () {
                        Route::get('/', [PengaturanTTDController::class, 'api_ttd_all']);
                        Route::get('/{ttd_id}', [PengaturanTTDController::class, 'api_ttd_detail']);
                    });
                    Route::prefix('tembusan-surat')->group(function () {
                        Route::get('/', [PengaturanTembusanController::class, 'api_tembusan_all']);
                        Route::get('/{tembusan_id}', [PengaturanTembusanController::class, 'api_tembusan_detail']);
                    });
                    Route::prefix('footer-surat')->group(function () {
                        Route::get('/', [PengaturanFooterSuratController::class, 'api_footer_all']);
                        Route::get('/{template_footer_id}', [PengaturanFooterSuratController::class, 'api_footer_detail']);
                    });
                    Route::prefix('master-surat')->group(function () {
                        Route::get('/', [PengaturanMasterSuratController::class, 'api_master_surat_all']);
                        Route::get('/{template_master_id}', [PengaturanMasterSuratController::class, 'api_master_surat_detail']);
                        Route::post('tambah-master/simpan', [PengaturanMasterSuratController::class, 'simpan_master']);
                    });
                });
            });
        });
        Route::middleware(['role:Admin Cabang'])->group(function () {
            Route::prefix('admin-cabang')->group(function () {

                // database
                Route::prefix('database')->group(function () {

                    // cabang
                    Route::prefix('database-cabang')->group(function () {
                        Route::get('/', function () {
                            return [
                                'cabang'        => url('api/v1/admin-cabang/database/database-cabang/cabang'),
                                'ibadah'        => url('api/v1/admin-cabang/database/database-cabang/ibadah'),
                                'komsel'        => url('api/v1/admin-cabang/database/database-cabang/komsel'),
                                'kelompok-pa'   => url('api/v1/admin-cabang/database/database-cabang/kelompok-pa'),
                                'event'         => url('api/v1/admin-cabang/database/database-cabang/event'),
                            ];
                        });
                        Route::prefix('cabang')->group(function () {
                            Route::get('/', [DatacabangController::class, 'api_cabang_all']);
                            Route::get('/{cabang_id}', [DatacabangController::class, 'api_cabang_detail']);
                        });
                        Route::prefix('ibadah')->group(function () {
                            Route::get('/', [DatacabangController::class, 'api_ibadah_all']);
                            Route::get('/{ibadah_id}', [DatacabangController::class, 'api_ibadah_detail']);
                        });
                        Route::prefix('komsel')->group(function () {
                            Route::get('/', [DatacabangController::class, 'api_komsel_all']);
                            Route::get('/{komsel_id}', [DatacabangController::class, 'api_komsel_detail']);
                        });
                        Route::prefix('kelompok-pa')->group(function () {
                            Route::get('/', [DatacabangController::class, 'api_kelompok_pa_all']);
                            Route::get('/{kelompok_pa_id}', [DatacabangController::class, 'api_kelompok_pa_detail']);
                        });
                        Route::prefix('event')->group(function () {
                            Route::get('/', [DatacabangController::class, 'api_event_all']);
                            Route::get('/{event_id}', [DatacabangController::class, 'api_event_detail']);
                        });
                    });

                    // permuridan
                    Route::prefix('database-permuridan')->group(function () {
                        Route::get('/', function () {
                            return [
                                'kakak-pa'      => url('api/v1/admin-cabang/database/database-permuridan/kakak-pa'),
                            ];
                        });
                        Route::prefix('kakak-pa')->group(function () {
                            Route::get('/', [PemuridanCabangController::class, 'api_kakak_pa_all']);
                            Route::get('/{user_id}', [PemuridanCabangController::class, 'api_kakak_pa_detail']);
                        });
                        Route::prefix('anak-pa')->group(function () {
                            Route::get('/', [PemuridanCabangController::class, 'api_anak_pa_all']);
                            Route::get('/{user_id}', [PemuridanCabangController::class, 'api_anak_pa_detail']);
                        });
                    });
                    // database jemaat
                    Route::prefix('database-jemaat')->group(function () {
                        // Route::get('/', [JemaatController::class, 'api_all']);
                        Route::get('/{jemaat_id}', [DatabaseJemaatController::class, 'api_detail']);
                    });
                });
                // ------------------------------------------------------------------------

                // permuridan
                Route::prefix('database-permuridan')->group(function () {
                    Route::get('/', function () {
                        return [
                            'kakak-pa'      => url('api/v1/superadmin/database/database-permuridan/kakak-pa'),
                        ];
                    });
                    Route::prefix('kakak-pa')->group(function () {
                        Route::get('/', [PermuridanController::class, 'api_kakak_pa_all']);
                        Route::get('/{user_id}', [PermuridanController::class, 'api_kakak_pa_detail']);
                    });
                    Route::prefix('anak-pa')->group(function () {
                        Route::get('/', [PermuridanController::class, 'api_anak_pa_all']);
                        Route::get('/{user_id}', [PermuridanController::class, 'api_anak_pa_detail']);
                    });
                    Route::prefix('bahan')->group(function () {
                        Route::get('/', [PermuridanController::class, 'api_bahan_all']);
                        Route::get('/{bahan_pa_id}', [PermuridanController::class, 'api_bahan_detail']);
                    });
                    Route::prefix('bab')->group(function () {
                        Route::get('/', [PermuridanController::class, 'api_bab_all']);
                        Route::get('/{bab_pa_id}', [PermuridanController::class, 'api_bab_detail']);
                    });
                });

                // kehadiran
                Route::prefix('kehadiran')->group(function () {
                    Route::get('/', function () {
                        return [
                            'ibadah'       => url('api/v1/superadmin/kehadiran/ibadah'),
                            'komsel'       => url('api/v1/superadmin/kehadiran/komsel'),
                            'permuridan'   => url('api/v1/superadmin/kehadiran/permuridan'),
                        ];
                    });
                    Route::prefix('ibadah')->group(function () {
                        Route::get('/', [KehadiranIbadahController::class, 'api_ibadah_all']);
                        Route::get('/{ibadah_detail_id}', [AdminCabangKehadiranIbadahController::class, 'api_ibadah_detail']);
                    });
                    Route::prefix('komsel')->group(function () {
                        Route::get('/', [KehadiranKomselController::class, 'api_komsel_all']);
                        Route::get('/{komsel_detail_id}', [KehadiranKomselController::class, 'api_komsel_detail']);
                    });
                    Route::prefix('permuridan')->group(function () {
                        Route::get('/get-user', [KehadiranPermuridanController::class, 'api_permuridan_get_user']);
                        Route::get('/', [KehadiranPermuridanController::class, 'api_permuridan_all']);
                        Route::get('/{permuridan_detail_id}', [KehadiranPermuridanController::class, 'api_permuridan_detail']);
                    });
                });

                Route::prefix('request-surat')->group(function () {
                    Route::prefix('surat-penunjukan')->group(function () {
                        Route::get('/', [RequestSuratPenunjukanController::class, 'api_surat_penunjukan_all']);
                        Route::get('/{surat_id}', [RequestSuratPenunjukanController::class, 'api_surat_penunjukan_detail']);
                    });
                    Route::prefix('surat-keputusan')->group(function () {
                        Route::get('/', [RequestSuratKeputusanController::class, 'api_surat_keputusan_all']);
                        Route::get('/{surat_id}', [RequestSuratKeputusanController::class, 'api_surat_keputusan_detail']);
                    });
                    Route::prefix('surat-tugas')->group(function () {
                        Route::get('/', [RequestSuratTugasController::class, 'api_surat_tugas_all']);
                        Route::get('/{surat_id}', [RequestSuratTugasController::class, 'api_surat_tugas_detail']);
                    });
                });

                Route::prefix('/request-sertifikat')->group(function () {
                    Route::prefix('sertifikat-baptis')->group(function () {
                        Route::get('/', [SertifikatBaptis::class, 'api_sertifikat_all']);
                        Route::get('/{sertifikat_baptis_id}', [SertifikatBaptis::class, 'api_sertifikat_detail']);
                    });
                    Route::prefix('sertifikat-penyerahan-anak')->group(function () {
                        Route::get('/', [SertifikatPenyerahanAnak::class, 'api_sertifikat_all']);
                        Route::get('/{sertifikat_baptis_id}', [SertifikatPenyerahanAnak::class, 'api_sertifikat_detail']);
                    });
                    Route::prefix('sertifikat-pernikahan')->group(function () {
                        Route::get('/', [SertifikatPernikahanController::class, 'api_sertifikat_all']);
                        Route::get('/{sertifikat_baptis_id}', [SertifikatPernikahanController::class, 'api_sertifikat_detail']);
                    });
                });
            });
        });
        Route::middleware(['role:Approval'])->group(function () {
            Route::prefix('approval')->group(function () {
                Route::prefix('approve-surat')->group(function () {
                    Route::prefix('surat-penunjukan')->group(function () {
                        Route::get('/', [ApproveSuratPenunjukan::class, 'api_all']);
                        Route::get('/{surat_id}', [ApproveSuratPenunjukan::class, 'api_detail']);
                    });
                    Route::prefix('surat-keputusan')->group(function () {
                        Route::get('/', [ApproveSuratKeputusan::class, 'api_all']);
                        Route::get('/{surat_id}', [ApproveSuratKeputusan::class, 'api_detail']);
                    });
                    Route::prefix('surat-tugas')->group(function () {
                        Route::get('/', [ApprovalSuratTugasController::class, 'api_all']);
                        Route::get('/{surat_id}', [ApprovalSuratTugasController::class, 'api_detail']);
                    });
                });
            });
        });
    });
});

Route::prefix('cron')->group(function () {
    Route::get('/ulang-tahun-jemaat', [ScheduleController::class, 'ulang_tahun_jemaat']);
});
