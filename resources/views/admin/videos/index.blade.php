@extends('admin.main')

@section('title', 'Video Animasi')

@section('content')
    @if (auth()->check())
        @if ($message = Session::has('success'))
            <div class="alert-dismiss">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
                </div>
            </div>
        @endif

        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Video Animasi</h4>
                                    <a href="{{ route('videos.create') }}" class="btn btn-outline-primary">Tambah Data</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table verticle-middle table-hover progress-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Judul</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Video</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($videos as $video)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $video->title }}</td>
                                                    <td>{!! \Illuminate\Support\Str::limit($video->description, 20) !!}</td>
                                                    <td>
                                                        <video width="320" controls>
                                                            <source
                                                                src="{{ asset(str_replace('public/', 'storage/', $video->video)) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('videos.edit', $video->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-id="{{ $video->id }}">Hapus</button>
                                                        <form id="delete-form-{{ $video->id }}"
                                                            action="{{ route('videos.destroy', $video->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @forelse ($videos as $video)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="card-text">{!! \Illuminate\Support\Str::limit($video->description, 100) !!}</p>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#videoModal{{ $video->id }}">
                                Lihat Video
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel{{ $video->id }}">{{ $video->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Video embedded in the modal -->
                                <video width="100%" controls>
                                    <source src="{{ asset(str_replace('public/', 'storage/', $video->video)) }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <!-- Full Description (unlimited length) -->
                                <div class="mt-3">
                                    <h6>Deskripsi:</h6>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <p>{!! $video->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Tidak ada video yang tersedia.</p>
                </div>
            @endforelse
        </div>
    @endif
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const videoId = this.dataset.id;
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${videoId}`).submit();
                    }
                });
            });
        });
    </script>
@endpush
