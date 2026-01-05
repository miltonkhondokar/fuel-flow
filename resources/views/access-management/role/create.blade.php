@extends('application.layouts.app')
@section('title', 'Roles')
@section('current_page', 'Roles')
@section('current_page_title', 'Access Management')
@section('page_header', 'Create Role')

@section('page-title')
    <!-- Include page title and breadcrumb in the page-specific content -->
    @include('application.partials.page-title', ['breadcrumb' => $breadcrumb])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <!-- Card for Create Role -->
                <div class="card mt-3">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Create Role</h4>
                        <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm">
                            <i class="far fa-list-alt"></i> Role List
                        </a>
                    </div>

                    <!-- Card Body with Form -->
                    <div class="card-body">
                        <!-- Display Errors -->
                        @if ($errors->any())
                            <div class="alert alert-warning">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form to Create Role -->
                        <form action="{{ route('roles.store') }}" method="POST" autocomplete="off">
                            @csrf

                            <!-- Role Name Input -->
                            <div class="mb-4">
                                <label for="roleName" class="form-label">Role Name</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <input type="text" name="name" class="form-control" id="roleName" required />
                                </div>
                            </div>

                            <!-- Submit Button -->
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
    </div>
@endsection
