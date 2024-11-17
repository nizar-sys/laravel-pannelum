<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreVideo;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

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
        $videos = Video::all();

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(RequestStoreVideo $request)
    {
        $payloadVideo = $request->validated();
        $payloadVideo['video'] = $this->uploadFile($request, 'video', 'videos');

        Video::create($payloadVideo);

        return redirect()->route('videos.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(RequestStoreVideo $request, Video $video)
    {
        $payloadVideo = $request->validated();

        if ($request->hasFile('video')) {
            $this->deleteFile($video->video);
            $payloadVideo['video'] = $this->uploadFile($request, 'video', 'videos');
        }

        $video->update($payloadVideo);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $this->deleteFile($video->video);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
