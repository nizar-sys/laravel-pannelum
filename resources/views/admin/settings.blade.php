@extends('admin.main')

@section('title', 'Profile Settings')

@push('css')
    <link rel="stylesheet" href="{{ asset('/css/plugins/summernote-bs4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Profile Settings</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('settings.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group @error('logo') has-error @enderror">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" class="form-control">
                                @if (settings('logo'))
                                    <span class="help-block with-errors">Logo sudah diupload</span>
                                @endif
                                @error('logo')
                                    <span class="help-block with-errors">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('name') has-error @enderror">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', settings('name')) }}">
                                @error('name')
                                    <span class="help-block with-errors">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('description') has-error @enderror">
                                <label for="description">Description</label>
                                <textarea name="description" id="" class="summernote form-control" style="height: 100px">{{ old('description', settings('description')) }}</textarea>
                                @error('description')
                                    <span class="help-block with-errors">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h2>Profile Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            @if (settings('logo'))
                                <img src="{{ asset(str_replace('public/', 'storage/', settings('logo'))) }}" alt="Logo" class="img-thumbnail"
                                    width="100">
                            @else
                                <span class="text-muted">No logo available</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <p>{{ settings('name') ?: 'No name available' }}</p>
                        </div>

                        <div>
                            <p>{!! settings('description') ?: 'No description available' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
