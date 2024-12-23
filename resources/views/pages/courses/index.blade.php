@extends('layout.base')
@section('content')


@session('success')
    <!-- Inclure le CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script SweetAlert2 pour afficher l'alerte -->
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
@endsession

<div class="col-12">
    <div class="card recent-sales overflow-auto">

      @if (auth()->user()->role->name === 'admin')
        <div class="filter">
            <a class="icon " data-bs-toggle="modal" data-bs-target="#courseModal"><i class="bi bi-person-plus-fill fs-5"></i></a>
        </div>
      @endif

      <div class="card-body">
        <h5 class="card-title">courses <span>| List </span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Lecturer</th>
              <th scope="col">Description</th>
              @if (auth()->user()->role->name === 'admin')
              <th scope="col">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($courses as $course)
            <tr>
                <th scope="row"><a href="#">{{ $course->id }}</a></th>
                <td>{{ $course->title }}</td>
                <td>{{ $course->lecturer ? $course->lecturer->name : 'N/A' }}</td>
                <td><a class="text-primary">{{ $course->description }}</a></td>

                <td>
                    @if (auth()->user()->role->name === 'admin')
                        <a href="#" class="text-primary" onclick="opencourseModal({{ json_encode($course) }})"
                        data-url="{{ route('courses.update', $course->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $course->id }}').submit();" class="text-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </form>
                    @endif
                </td>
              </tr>

            @endforeach

          </tbody>
        </table>

      </div>

    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="modalTitle">New course</h5>
                <button type="button" class="btn-close h2 fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire pour la création ou la mise à jour -->
                <form method="POST" id="courseForm" action="{{ route('courses.store') }}">
                    @csrf
                    <!-- Champs de formulaire -->


                    <div class="col-md-12 mb-4">
                        <div class="input-group has-validation">
                            <input type="text" name="title" class="form-control" id="title" placeholder="course title" required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">

                        <input class="form-control" list="datalistOptions" id="selectedDesignation" name="selectedDesignation"
                            placeholder="Type to search the lecturer">

                        <datalist id="datalistOptions">
                            @foreach ($lecturers as $lecturer)
                                <option value="{{ $lecturer->name }}" data-id="{{ $lecturer->id }}"></option>
                            @endforeach
                        </datalist>

                        <!-- Champ caché pour stocker l'ID du lecturer -->
                        <input type="hidden" id="lecturerId" name="lecturer_id">
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Entrez une description ici..." required></textarea>
                    </div>


                    <!-- Bouton pour soumettre -->
                    <div class="col-md-12 text-center">
                        <button name="save" class="btn btn-secondary w-50 fw-bold" type="submit" id="submitBtn">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0">
            </div>
        </div>
    </div>
</div>
<script>
    function opencourseModal(course) {
        // Pré-remplir les champs du formulaire
        document.getElementById('title').value = course.title || '';
        document.getElementById('description').value = course.description || '';

        // Pré-remplir le DataList pour le lecturer
        const lecturerInput = document.getElementById('selectedDesignation');
        const hiddenLecturerId = document.getElementById('lecturerId');

        if (course.lecturer) {
            lecturerInput.value = course.lecturer.name; // Nom du lecturer
            hiddenLecturerId.value = course.lecturer.id; // ID du lecturer
        } else {
            lecturerInput.value = '';
            hiddenLecturerId.value = '';
        }

        // Mettre à jour l'action du formulaire pour l'édition
        const form = document.getElementById('courseForm');
        form.action = `/courses/${course.id}`; // URL dynamique basée sur l'ID du cours
        form.method = 'POST';

        // Ajouter ou mettre à jour le champ _method pour PUT
        let methodField = form.querySelector('input[name="_method"]');
        if (!methodField) {
            methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            form.appendChild(methodField);
        } else {
            methodField.value = 'PUT';
        }

        // Mettre à jour le titre et le bouton du modal
        document.getElementById('modalTitle').innerText = "Update course";
        document.getElementById('submitBtn').innerText = "Update";

        // Ouvrir le modal
        const modal = new bootstrap.Modal(document.getElementById('courseModal'));
        modal.show();
    }

    // Synchronisation de la sélection de DataList avec l'ID du Lecturer
    document.getElementById('selectedDesignation').addEventListener('input', function () {
        const input = this;
        const options = document.querySelectorAll('#datalistOptions option');
        const hiddenLecturerId = document.getElementById('lecturerId');

        // Chercher l'ID correspondant à la valeur sélectionnée
        options.forEach(option => {
            if (option.value === input.value) {
                hiddenLecturerId.value = option.getAttribute('data-id');
            }
        });
    });
</script>

<script>
    document.getElementById('selectedDesignation').addEventListener('input', function () {
        const input = this;
        const options = document.querySelectorAll('#datalistOptions option');

        options.forEach(option => {
            if (option.value === input.value) {
                document.getElementById('lecturerId').value = option.getAttribute('data-id');
            }
        });
    });
</script>




@endsection
