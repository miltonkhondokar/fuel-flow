@extends('application.layouts.app')

{{-- @section('page-title')
    @include('application.partials.page-title', ['breadcrumb' => $breadcrumb])
@endsection --}}


@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card card-flush mt-6">
                <div class="card-header">
                    <div class="card-title">
                        <h2>All Users</h2>
                    </div>
                </div>

                <div class="card-body pt-0">
                    @if ($users->isEmpty())
                        <div class="alert alert-warning">
                            <strong>No users found.</strong>
                        </div>
                    @else
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="users_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->getRoleNames() as $roleName)
                                                <span
                                                    class="badge badge-light-primary fw-bold me-1">{{ $roleName }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-end">
                                            {{-- @can('user_update') --}}
                                            <a href="{{ route('user-role.edit', $user->id) }}"
                                                class="btn btn-sm btn-light-warning">
                                                <i class="ki-duotone ki-pencil fs-3"></i> Edit
                                            </a>
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
