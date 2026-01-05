@extends('application.layouts.app')

{{-- @section('page-title')
    @include('application.partials.page-title', ['breadcrumb' => $breadcrumb])
@endsection --}}


@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                        <ul class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left">Users</h4>
                            <a href="{{ route('user-role.index') }}" class="btn btn-info btn-sm float-right">
                                <i class="far fa-arrow-alt-circle-left"></i> User List
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="user-permission-form" action="{{ route('user-role.update', $user->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                        disabled />
                                </div>
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" readonly value="{{ $user->email }}"
                                        class="form-control" disabled />
                                </div>
                                <div class="mb-3">
                                    <label for="">Roles</label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary"
                                        onclick="event.preventDefault(); actionConfirmation('update', 'user-permission-form', 'Are you sure?', 'You want to update permission for this user!', 'Yes, update it!')">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    @endsection
