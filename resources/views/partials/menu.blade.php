<aside id="sidebar">

    {{-- BRAND --}}
    <div class="sidebar-brand">
        <div class="brand-area">
            <div class="brand-icon">
                <i class="fas fa-bolt"></i>
            </div>

            <span class="brand-text">
                {{ trans('panel.site_title') }}
            </span>
        </div>
    </div>

    {{-- USER MINI CARD --}}
    <div class="user-info">
        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="user-meta">
            <p class="user-name">{{ auth()->user()->name }}</p>
            <p class="user-role">Administrator</p>
        </div>
    </div>

    {{-- NAV --}}
    <nav class="sidebar-nav">

        <p class="sidebar-section-title nav-label">Main</p>

        {{-- Dashboard --}}
        <a href="{{ route('admin.home') }}"
           data-tooltip="Dashboard"
           class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <i class="fas fa-chart-pie nav-icon"></i>
            <span class="nav-label">{{ trans('global.dashboard') }}</span>
        </a>

        {{-- USER MANAGEMENT GROUP --}}
        @can('user_management_access')
            @php
                $umActive = request()->is('admin/permissions*')
                    || request()->is('admin/roles*')
                    || request()->is('admin/users*')
                    || request()->is('admin/audit-logs*');
            @endphp

            <div x-data="{ open: {{ $umActive ? 'true' : 'false' }} }">

                <button type="button"
                        @click="open = !open"
                        data-tooltip="Users"
                        class="nav-link nav-group-btn {{ $umActive ? 'active' : '' }}">

                    <div class="nav-group-left">
                        <i class="fas fa-users nav-icon"></i>
                        <span class="nav-label">{{ trans('cruds.userManagement.title') }}</span>
                    </div>

                    <i class="fas fa-chevron-right chevron"
                       :style="open ? 'transform:rotate(90deg)' : ''"></i>
                </button>

                <div class="submenu"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1">

                    @can('permission_access')
                        <a href="{{ route('admin.permissions.index') }}"
                           class="sub-link {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                            <i class="fas fa-key"></i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    @endcan

                    @can('role_access')
                        <a href="{{ route('admin.roles.index') }}"
                           class="sub-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                            <i class="fas fa-shield-alt"></i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    @endcan

                    @can('user_access')
                        <a href="{{ route('admin.users.index') }}"
                           class="sub-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="fas fa-user-circle"></i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    @endcan

                    @can('audit_log_access')
                        <a href="{{ route('admin.audit-logs.index') }}"
                           class="sub-link {{ request()->is('admin/audit-logs*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            {{ trans('cruds.auditLog.title') }}
                        </a>
                    @endcan

                </div>
            </div>
        @endcan

        {{-- ABOUT MANAGEMENT GROUP --}}
@can('about_management_access')
    @php
        $aboutActive = request()->is('admin/college-profile*')
            || request()->is('admin/principal-message*');
    @endphp

    <div x-data="{ open: {{ $aboutActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="About"
                class="nav-link nav-group-btn {{ $aboutActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-university nav-icon"></i>

                <span class="nav-label">
                    About
                </span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('college_profile_access')
                <a href="{{ route('admin.college-profiles.index') }}"
                   class="sub-link {{ request()->is('admin/college-profile*') ? 'active' : '' }}">

                    <i class="fas fa-landmark"></i>

                    College Profile
                </a>
            @endcan
            @can('principal_message_access')
                <a href="{{ route('admin.principal-messages.index') }}"
                   class="sub-link {{ request()->is('admin/principal-message*') ? 'active' : '' }}">

                    <i class="fas fa-user-tie"></i>

                    Principal Message
                </a>
            @endcan

        </div>
    </div>
@endcan

{{-- ACADEMIC MANAGEMENT GROUP --}}
@can('academic_management_access')
    @php
        $academicActive =
            request()->is('admin/courses*')
            || request()->is('admin/subjects*');
    @endphp

    <div x-data="{ open: {{ $academicActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Academics"
                class="nav-link nav-group-btn {{ $academicActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-graduation-cap nav-icon"></i>

                <span class="nav-label">
                    Academics
                </span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('course_access')
                <a href="{{ route('admin.courses.index') }}"
                   class="sub-link {{ request()->is('admin/courses*') ? 'active' : '' }}">

                    <i class="fas fa-book-open"></i>

                    Courses
                </a>
            @endcan

            @can('subject_access')
                <a href="{{ route('admin.subjects.index') }}"
                   class="sub-link {{ request()->is('admin/subjects*') ? 'active' : '' }}">

                    <i class="fas fa-layer-group"></i>

                    Subjects
                </a>
            @endcan

        </div>
    </div>
@endcan
{{-- FACULTY MANAGEMENT GROUP --}}
@can('faculty_management_access')
    @php
        $facultyActive = request()->is('admin/faculty-members*');
    @endphp

    <div x-data="{ open: {{ $facultyActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Faculty"
                class="nav-link nav-group-btn {{ $facultyActive ? 'active' : '' }}">

            <div class="nav-group-left">
                <i class="fas fa-chalkboard-teacher nav-icon"></i>

                <span class="nav-label">
                    Faculty Management
                </span>
            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('faculty_member_access')
                <a href="{{ route('admin.faculty-members.index') }}"
                   class="sub-link {{ request()->is('admin/faculty-members*') ? 'active' : '' }}">

                    <i class="fas fa-user-tie"></i>
                    Faculty Members
                </a>
            @endcan

        </div>
    </div>
@endcan

{{-- STUDENT ACTIVITIES GROUP --}}
@can('student_activity_management_access')

    @php
        $studentActivityActive =
            request()->is('admin/student-activities*');
    @endphp

    <div x-data="{ open: {{ $studentActivityActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Student Activities"
                class="nav-link nav-group-btn {{ $studentActivityActive ? 'active' : '' }}">

            <div class="nav-group-left">

                <i class="fas fa-running nav-icon"></i>

                <span class="nav-label">
                    Student Activities
                </span>

            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('student_activity_access')
                <a href="{{ route('admin.student-activities.index') }}"
                   class="sub-link {{ request()->is('admin/student-activities*') ? 'active' : '' }}">

                    <i class="fas fa-calendar-check"></i>

                    All Activities
                </a>
            @endcan

            @can('student_activity_create')
                <a href="{{ route('admin.student-activities.create') }}"
                   class="sub-link {{ request()->is('admin/student-activities/create') ? 'active' : '' }}">

                    <i class="fas fa-plus-circle"></i>

                    Add Activity
                </a>
            @endcan

        </div>

    </div>

@endcan

{{-- ACADEMIC CALENDAR GROUP --}}
@can('academic_calendar_management_access')

    @php
        $academicCalendarActive =
            request()->is('admin/academic-calendars*');
    @endphp

    <div x-data="{ open: {{ $academicCalendarActive ? 'true' : 'false' }} }">

        <button type="button"
                @click="open = !open"
                data-tooltip="Academic Calendar"
                class="nav-link nav-group-btn {{ $academicCalendarActive ? 'active' : '' }}">

            <div class="nav-group-left">

                <i class="fas fa-calendar-alt nav-icon"></i>

                <span class="nav-label">
                    Academic Calendar
                </span>

            </div>

            <i class="fas fa-chevron-right chevron"
               :style="open ? 'transform:rotate(90deg)' : ''"></i>
        </button>

        <div class="submenu"
             x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1">

            @can('academic_calendar_access')
                <a href="{{ route('admin.academic-calendars.index') }}"
                   class="sub-link {{ request()->is('admin/academic-calendars*') ? 'active' : '' }}">

                    <i class="fas fa-calendar-check"></i>
                    All Calendars
                </a>
            @endcan

            @can('academic_calendar_create')
                <a href="{{ route('admin.academic-calendars.create') }}"
                   class="sub-link {{ request()->is('admin/academic-calendars/create') ? 'active' : '' }}">

                    <i class="fas fa-plus-circle"></i>
                    Add Calendar
                </a>
            @endcan

        </div>

    </div>

@endcan
        <div class="nav-divider"></div>

        <p class="sidebar-section-title compact nav-label">Account</p>

        {{-- Change Password --}}
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <a href="{{ route('profile.password.edit') }}"
                   data-tooltip="Password"
                   class="nav-link {{ request()->is('profile/password*') ? 'active' : '' }}">
                    <i class="fas fa-key nav-icon"></i>
                    <span class="nav-label">{{ trans('global.change_password') }}</span>
                </a>
            @endcan
        @endif

        {{-- Settings --}}
        <a href="#"
           data-tooltip="Settings"
           class="nav-link">
            <i class="fas fa-cog nav-icon"></i>
            <span class="nav-label">Settings</span>
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="sidebar-footer">
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
           data-tooltip="Logout"
           class="nav-link logout-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-label">{{ trans('global.logout') }}</span>
        </a>
    </div>

</aside>