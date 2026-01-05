@extends('application.layouts.app')

@section('page-title')
    @include('application.partials.page-title', ['breadcrumb' => $breadcrumb])
@endsection


@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="card card-flush mt-6">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Create Permission</h2>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">
                            <i class="far fa-list-alt"></i> Permission List
                        </a>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Permission Create Form -->
                    <form method="POST" action="{{ route('permissions.store') }}" id="permission-create-form">
                        @csrf

                        <div class="mb-6">
                            <label for="permission-name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control form-control-solid" id="permission-name"
                                name="name" placeholder="Enter permission name" value="{{ old('name') }}" required>
                        </div>


                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var $form = $('#permission-create-form');

            $form.on('submit', function(e) {
                e.preventDefault();

                // Confirmation prompt
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to create this permission.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $form.off('submit').submit();
                    }
                });
            });
        });
    </script>
@endpush
