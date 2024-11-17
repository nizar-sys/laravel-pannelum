<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rawilk\Settings\Facades\Settings;

class SettingController extends Controller
{
    protected function deleteFile($path, $disk = 'public')
    {
        if (empty($path)) {
            return false;
        }

        if (strpos($path, '/') !== false) {
            $path = explode('/', $path);
            $disk = $path[0];
            $path = $path[1] . '/' . $path[2];
        }

        return \Illuminate\Support\Facades\Storage::disk($disk)->delete($path);
    }

    protected function uploadFile($requestOrFile, $fileKey = null, $folder = '', $name = null, $disk = 'public')
    {
        $file = $requestOrFile instanceof \Illuminate\Http\Request
            ? $requestOrFile->file($fileKey)
            : $requestOrFile;

        if (!$file || !$file->isValid()) {
            return false;
        }

        $fileName = $name ?? time() . '_' . $file->getClientOriginalName();

        return $disk . '/' . $file->storeAs($folder, $fileName, $disk);
    }

    public function index()
    {
        return view('admin.settings');
    }

    public function saveSettings(Request $request)
    {
        $payload = $request->except('_token');

        if ($request->hasFile('logo')) {
            if (Settings::has('logo')) {
                $this->deleteFile(Settings::get('logo'));
            }
            $payload['logo'] = $this->uploadFile($request, 'logo', 'settings');
        }

        foreach ($payload as $key => $value) {
            Settings::set($key, $value);
        }

        return back()->with('success', 'Berhasil menyimpan pengaturan.');
    }
}
