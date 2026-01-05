@extends('application.layouts.app')
@section('title', 'Users')
@section('current_page', 'Users')
@section('current_page_title', 'User Management')
@section('page_header', 'Edit')

@section('page-title')
    <!-- Include page title and breadcrumb in the page-specific content -->
    @include('application.partials.page-title', ['breadcrumb' => $breadcrumb])
@endsection

@section('content')
<section class="content">
    <div class="container-xxl">
        <div class="row g-5 g-xl-10">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Update User</h3>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-list fs-4"></i> List
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="userForm" action="{{ route('users.update', $user->uuid) }}" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <label class="form-label required">Name</label>
                                    <input type="text" name="name" class="form-control form-control-solid" placeholder="User Name"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Email</label>
                                    <input type="email" name="email" class="form-control form-control-solid" placeholder="Email Address"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <label class="form-label required">Mobile</label>
                                    <input type="text" name="mobile" class="form-control form-control-solid" placeholder="Mobile"
                                        value="{{ old('mobile', $user->mobile) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">User Type</label>
                                    <select name="user_type" class="form-select form-select-solid" required>
                                        <option value="">- Select User Type -</option>
                                        @foreach([
                                            1 => 'Super Admin',
                                            2 => 'Admin',
                                            3 => 'Accountant',
                                            4 => 'Moderator',
                                            5 => 'HR',
                                            6 => 'Support',
                                            7 => 'Student',
                                            8 => 'Developer'
                                        ] as $value => $label)
                                            <option value="{{ $value }}" {{ old('user_type', $user->user_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <label class="form-label">Password 
                                        <span class="text-muted small">(Leave it blank if you don’t want to change)</span>
                                    </label>
                                    <input type="text" name="password" class="form-control form-control-solid" placeholder="Password"
                                        value="{{ old('password') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">User Status</label>
                                    <select name="user_status" class="form-select form-select-solid" required>
                                        <option value="">- Select Status -</option>
                                        <option value="1" {{ old('user_status', $user->user_status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('user_status', $user->user_status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-warning">
                                    <i class="ki-duotone ki-check fs-2"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#userForm').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                html: '<span class="text-danger">Do you want to update this user?</span>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#009ef7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
