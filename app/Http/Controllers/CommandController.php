<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;

class CommandController extends Controller
{
    public function command_ui()
    {
        $data = [
            'title'                 => 'Command',
            'menu_aktif'            => 'command',
        ];
        return view('command', $data);
    }
    public function superadmin_deploy()
    {
        // ------------------------------------------------------------------------
        // git pull
        // ------------------------------------------------------------------------
        $git = new Process(["git", 'pull']);

        $git->setWorkingDirectory(base_path());

        $git->run();

        if (!$git->isSuccessful()) {
            return redirect()->back()->with('gagal', 'Gagal mengupdate repo, ' . $git->getExitCodeText())->withInput();
        }



        // ------------------------------------------------------------------------
        // copy env
        // ------------------------------------------------------------------------
        $env = new Process(["cp", ".env.production", ".env"]);

        $env->setWorkingDirectory(base_path());

        $env->run();

        if (!$env->isSuccessful()) {
            return redirect()->back()->with('gagal', 'Gagal update env, ' . $env->getExitCodeText())->withInput();
        }


        // ------------------------------------------------------------------------
        // composer install
        // ------------------------------------------------------------------------
        $env = new Process(["composer", "install"]);

        $env->setWorkingDirectory(base_path());

        $env->run();

        if (!$env->isSuccessful()) {
            return redirect()->back()->with('gagal', 'Gagal composer install ' . $env->getExitCodeText())->withInput();
        }

        return redirect()->back()->with('berhasil', 'Berhasil update aplikasi')->withInput();
    }

    public function pwa_deploy()
    {
        try {
            $response = Http::get('https://m.sinodegkkd.org/api/setting/command/deploy');
            if ($response->successful()) {
                return redirect()->back()->with('berhasil', 'Berhasil update aplikasi')->withInput();
            } else {
                return redirect()->back()->with('gagal', 'Gagal deploy')->withInput();
            }
        } catch (Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage())->withInput();
        }
    }






    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------

    public function superadmin_deploy_api()
    {
        // ------------------------------------------------------------------------
        // git pull
        // ------------------------------------------------------------------------
        $git = new Process(["git", 'pull']);

        $git->setWorkingDirectory(base_path());

        $git->run();

        if (!$git->isSuccessful()) {
            return response()->json(['status' => false, 'message' => 'Gagal mengupdate repo'], 400);
        }


        // ------------------------------------------------------------------------
        // copy env
        // ------------------------------------------------------------------------
        $env = new Process(["cp", ".env.production", ".env"]);

        $env->setWorkingDirectory(base_path());

        $env->run();

        if (!$env->isSuccessful()) {
            return response()->json(['status' => false, 'message' => 'Gagal update env'], 400);
        }


        // ------------------------------------------------------------------------
        // composer install
        // ------------------------------------------------------------------------
        $env = new Process(["composer", "install"]);

        $env->setWorkingDirectory(base_path());

        $env->run();

        if (!$env->isSuccessful()) {
            return response()->json(['status' => false, 'message' => 'Gagal composer install'], 400);
        }

        return response()->json(['status' => true, 'message' => 'Berhasil update aplikasi'], 200);
    }
}
