@if (auth()->user()->role->name === 'student')
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Main</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('lecturers.index') }}">
          <i class="bi bi-person"></i>
          <span>Lectures</span>
        </a>
      </li><!-- End Lecturers Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('courses.index') }}">
          <i class="bi bi-card-text"></i>
          <span>Courses</span>
        </a>
      </li><!-- End Lecturers Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-list-ol "></i>
          <span>My Courses</span>
        </a>
      </li><!-- End Lecturers Page Nav -->
    </ul>

  </aside>
@elseif(auth()->user()->role->name === 'admin')
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-heading">Main</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('students.index') }}">
                <i class="bi bi-people"></i>
                <span>Students</span>
                </a>
            </li><!-- End Students Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('lecturers.index') }}">
                <i class="bi bi-person"></i>
                <span>Lectures</span>
                </a>
            </li><!-- End Lecturers Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('courses.index') }}">
                <i class="bi bi-card-text"></i>
                <span>Courses</span>
                </a>
            </li><!-- End Lecturers Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('courses.index') }}">
                  <i class="bi bi-list-ol "></i>
                  <span>My Courses</span>
                </a>
              </li><!-- End My Courses Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('enrollments.index') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Enrollments</span>
                </a>
            </li><!-- End Lecturers Page Nav -->

            <li class="nav-heading">Others</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="">
                <i class="bi bi-person-circle"></i>
                <span>Users</span>
                </a>
            </li><!-- End Users Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('roles.index') }}">
                <i class="bi bi-key"></i>
                <span>Role</span>
                </a>
            </li><!-- End Users Page Nav -->

        </ul>

    </aside>
@elseif (auth()->user()->role->name === 'lecturer')
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-heading">Main</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('lecturers.index') }}">
                <i class="bi bi-person"></i>
                <span>Lectures</span>
                </a>
            </li><!-- End Lecturers Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('courses.index') }}">
                <i class="bi bi-card-text"></i>
                <span>Courses</span>
                </a>
            </li><!-- End Lecturers Page Nav -->
        </ul>

    </aside>
@endif
