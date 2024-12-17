@extends('layout.base')
@section('content')

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',  // Récupérer le message de session
                showConfirmButton: false,
                timer: 2800
            });
        });
    </script>
@endif

<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="filter">
            <a class="icon" data-bs-toggle="modal" data-bs-target="#enrollmentModal">
                <i class="bi bi-person-plus-fill fs-5"></i>
            </a>
        </div>

        <div class="card-body">
            <h5 class="card-title">Enrollments <span>| List</span></h5>

            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Students Names</th>
                        <th scope="col">Course</th>
                        <th scope="col">Enrollment Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <th scope="row">{{ $enrollment->id }}</th>
                            <td>{{ $enrollment->student->name ?? 'N/A' }}</td>
                            <td>{{ $enrollment->course->title ?? 'N/A' }}</td>
                            <td>{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d-m-Y H:i') : 'N/A' }}</td>
                            <td>
                                <a href="#" class="text-primary"
                                   onclick="openEnrollmentModal({{ json_encode($enrollment) }})"
                                   data-url="{{ route('enrollments.update', $enrollment->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form id="delete-form-{{ $enrollment->id }}"
                                      action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"
                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $enrollment->id }}').submit();"
                                       class="text-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="enrollmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="modalTitle">New Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="enrollmentForm" action="{{ route('enrollments.store') }}">
                    @csrf

                    <!-- Sélection des étudiants -->
                    <div class="mb-4">
                        <input class="form-control" list="studentOptions" id="studentInput" name="student_name"
                               placeholder="Type to search the student">
                        <datalist id="studentOptions">
                            @foreach ($students as $student)
                                <option value="{{ $student->name }}" data-id="{{ $student->id }}"></option>
                            @endforeach
                        </datalist>
                        <input type="hidden" id="studentId" name="student_id">
                    </div>

                    <!-- Sélection des cours -->
                    <div class="mb-4">
                        <input class="form-control" list="courseOptions" id="courseInput" name="course_name"
                            placeholder="Type to search the course">
                        <datalist id="courseOptions">
                            @foreach ($courses as $course)
                                <option value="{{ $course->title }}" data-id="{{ $course->id }}"></option>
                            @endforeach
                        </datalist>
                        <input type="hidden" id="courseId" name="course_id">
                    </div>

                    <div class="text-center">
                        <button class="btn btn-secondary w-50 fw-bold" type="submit" id="submitBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openEnrollmentModal(enrollment) {
        const form = document.getElementById('enrollmentForm');
        form.action = `/enrollments/${enrollment.id}`;
        form.method = 'POST';

        document.getElementById('courseInput').value = enrollment.course?.name || '';
        document.getElementById('courseId').value = enrollment.course?.id || '';
        document.getElementById('studentInput').value = enrollment.student?.name || '';
        document.getElementById('studentId').value = enrollment.student?.id || '';

        let methodField = form.querySelector('input[name="_method"]');
        if (!methodField) {
            methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            form.appendChild(methodField);
        }
        methodField.value = 'PUT';

        document.getElementById('modalTitle').innerText = "Update Enrollment";
        document.getElementById('submitBtn').innerText = "Update";

        new bootstrap.Modal(document.getElementById('enrollmentModal')).show();
    }

    // Associer input aux IDs cachés
    document.getElementById('courseInput').addEventListener('input', function () {
        setHiddenId(this, 'courseOptions', 'courseId');
    });

    document.getElementById('studentInput').addEventListener('input', function () {
        setHiddenId(this, 'studentOptions', 'studentId');
    });

    function setHiddenId(inputElement, datalistId, hiddenFieldId) {
        const options = document.querySelectorAll(`#${datalistId} option`);
        const hiddenField = document.getElementById(hiddenFieldId);

        options.forEach(option => {
            if (option.value === inputElement.value) {
                hiddenField.value = option.getAttribute('data-id');
            }
        });
    }
</script>

@endsection
