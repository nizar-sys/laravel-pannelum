@extends('admin.main')

@section('title', 'Edit Video Animasi')

@push('css')
    <link rel="stylesheet" href="{{ asset('/css/plugins/summernote-bs4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title
                                ">Edit Video Animasi</h4>
                                <a href="{{ route('videos.index') }}" class="btn btn-outline-primary">Kembali</a>
                            </div>
                            <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $video->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="summernote form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description', $video->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <input type="file" class="form-control @error('video') is-invalid @enderror"
                                        id="video" name="video" accept="video/*">
                                    @error('video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($video->video)
                                        <span class="d-block valid-feedback">
                                            Video sudah diupload
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/js/plugins/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($('.summernote').length > 0) {
                $(".summernote").summernote({
                    dialogsInBody: true,
                    minHeight: 250,
                });
            }
        });
    </script>
@endpush
