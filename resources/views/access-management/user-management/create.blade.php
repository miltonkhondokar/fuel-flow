@extends('application.layouts.app')
@section('title', 'Users')
@section('current_page', 'Users')
@section('current_page_title', 'User Management')
@section('page_header', 'Create')

@section('page-title')
    @include('application.partials.page-title', ['breadcrumb' => $breadcrumb])
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
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

                <div class="card card-flush">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Add New User</h3>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-light-primary">
                            <i class="fas fa-list"></i> List
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="userForm" action="{{ route('users.store') }}" method="POST" autocomplete="off">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control form-control-solid"
                                           placeholder="User Name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-solid"
                                           placeholder="Email Address" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="mobile" class="form-control form-control-solid"
                                           placeholder="Mobile" value="{{ old('mobile') }}" required>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label">User Type</label>
                                    <select name="user_type" class="form-select form-select-solid" required>
                                        <option value="">-select user type-</option>
                                        <option value="1" {{ old('user_type') == '1' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="2" {{ old('user_type') == '2' ? 'selected' : '' }}>Admin</option>
                                        <option value="3" {{ old('user_type') == '3' ? 'selected' : '' }}>Accountant</option>
                                        <option value="4" {{ old('user_type') == '4' ? 'selected' : '' }}>Moderator</option>
                                        <option value="5" {{ old('user_type') == '5' ? 'selected' : '' }}>HR</option>
                                        <option value="6" {{ old('user_type') == '6' ? 'selected' : '' }}>Support</option>
                                        <option value="8" {{ old('user_type') == '8' ? 'selected' : '' }}>Developer</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control form-control-solid"
                                           placeholder="Password" value="{{ old('password') }}" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-10">
                                <button type="submit" class="btn btn-success">Add User</button>
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
    $(document).ready(function() {
        $('#userForm').bootstrapValidator({
            feedbackIcons: {
                valid: 'bi bi-check-circle-fill',
                invalid: 'bi bi-x-circle-fill',
                validating: 'bi bi-arrow-repeat'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z.\-\s]+$/,
                            message: 'Only letters, spaces, dots and hyphens are allowed'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                        emailAddress: {
                            message: 'Invalid email format'
                        }
                    }
                },
                mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Mobile number is required'
                        },
                        regexp: {
                            regexp: /^(?:\+88|88)?(01[1-9]\d{8})$/,
                            message: 'Mobile must be like +8801XXXXXXXXX or 01XXXXXXXXX'
                        }
                    }
                },
                user_type: {
                    validators: {
                        notEmpty: {
                            message: 'Select user type'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required'
                        },
                        regexp: {
                            regexp: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/,
                            message: 'Must be 8+ chars with uppercase, lowercase, number & special char'
                        }
                    }
                }
            }
        }).on('success.form.bv', function(e) {
            e.preventDefault();
            var form = $(this);
            Swal.fire({
                title: 'Are you sure?',
                html: '<span class="text-danger">You want to add a new user?</span>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Proceed!',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.off('submit.bv').submit();
                } else {
                    form.find('[type="submit"]').prop('disabled', false);
                }
            });
        });
    });
</script>
@endpush
