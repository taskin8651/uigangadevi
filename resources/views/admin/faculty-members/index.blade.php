@extends('layouts.admin')

@section('page-title', 'Faculty Members')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Faculty Members
        </h2>

        <p class="admin-page-subtitle">
            Manage college faculty, departments, profiles and academic information
        </p>
    </div>

    @can('faculty_member_create')
        <a href="{{ route('admin.faculty-members.create') }}"
           class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Faculty Member
        </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="stats-grid">

    <div class="stat-card">
        <p class="stat-label">Total Faculty</p>
        <p class="stat-value">{{ $facultyMembers->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active Faculty</p>
        <p class="stat-value">
            {{ $facultyMembers->where('status', true)->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Departments</p>
        <p class="stat-value">
            {{ $facultyMembers->pluck('subject_id')->filter()->unique()->count() }}
        </p>
    </div>

    <div class="stat-card">
        <p class="stat-label">With CV</p>
        <p class="stat-value">
            {{ $facultyMembers->filter(fn ($item) => !empty($item->cv))->count() }}
        </p>
    </div>

</div>

<div class="page-card">

    <div class="page-card-header">
        <p class="page-card-title">All Faculty Members</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">

        <table class="min-w-full datatable datatable-FacultyMember">

            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Faculty Member</th>
                    <th>Department</th>
                    <th>Category</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($facultyMembers as $facultyMember)

                    <tr data-entry-id="{{ $facultyMember->id }}">

                        <td></td>

                        <td>
                            <span class="id-text">
                                #{{ $facultyMember->id }}
                            </span>
                        </td>

                        <td>
                            <div class="inline-flex-center">

                                @if($facultyMember->image)
                                    <img src="{{ $facultyMember->image }}"
                                         alt="{{ $facultyMember->name }}"
                                         class="faculty-table-image">
                                @else
                                    <div class="faculty-table-avatar">
                                        {{ strtoupper(substr($facultyMember->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <p class="table-main-text">
                                        {{ $facultyMember->name }}
                                    </p>

                                    <p class="table-sub-text">
                                        {{ $facultyMember->designation ?: 'Faculty Member' }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td>
                            {{ $facultyMember->subject->name ?? 'Not assigned' }}
                        </td>

                        <td>
                            @if($facultyMember->faculty_category)
                                <span class="role-tag">
                                    {{ $facultyMember->faculty_category }}
                                </span>
                            @else
                                —
                            @endif
                        </td>

                        <td>
                            {{ $facultyMember->email ?: '—' }}
                        </td>

                        <td>
                            @if($facultyMember->status)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>
                                    <span>Active</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>
                                    <span>Inactive</span>
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">

                                @can('faculty_member_show')
                                    <a href="{{ route('admin.faculty-members.show', $facultyMember) }}"
                                       class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('faculty_member_edit')
                                    <a href="{{ route('admin.faculty-members.edit', $facultyMember) }}"
                                       class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('faculty_member_delete')
                                    <form action="{{ route('admin.faculty-members.destroy', $facultyMember) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-outline btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </td>

                    </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

<style>
    .faculty-table-image,
    .faculty-table-avatar {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        border-radius: 12px;
    }

    .faculty-table-image {
        object-fit: cover;
        object-position: top center;
        border: 1px solid #e5e7eb;
    }

    .faculty-table-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 16px;
        font-weight: 800;
    }
</style>

@endsection

@section('scripts')
@parent

<script>
$(function () {
    initAdminDataTable('.datatable-FacultyMember', {
        canDelete: @can('faculty_member_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.faculty-members.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search faculty...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ faculty members'
    });
});
</script>
@endsection