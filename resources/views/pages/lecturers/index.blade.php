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

      <div class="filter">
        <a class="icon " data-bs-toggle="modal" data-bs-target="#lecturerModal"><i class="bi bi-person-plus-fill fs-5"></i></a>
      </div>

      <div class="card-body">
        <h5 class="card-title">lecturers <span>| List </span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Names</th>
              <th scope="col">Country</th>
              <th scope="col">Birth_date</th>
              <th scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lecturers as $lecturer)
            <tr>
                <th scope="row"><a href="#">{{ $lecturer->id }}</a></th>
                <td>{{ $lecturer->name }}</td>
                <td><a class="text-primary">{{ $lecturer->country }}</a></td>
                <td>{{ $lecturer->birth_date }}</td>
                <td>{{ $lecturer->email }}</td>
                <td>
                    <a href="#" class="text-primary"onclick="openlecturerModal({{ json_encode($lecturer) }})"
                    data-url="{{ route('lecturers.update', $lecturer->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>



                  <form id="delete-form-{{ $lecturer->id }}" action="{{ route('lecturers.destroy', $lecturer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $lecturer->id }}').submit();" class="text-danger">
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
<div class="modal fade" id="lecturerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="modalTitle">New lecturer</h5>
                <button type="button" class="btn-close h2 fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire pour la création ou la mise à jour -->
                <form method="POST" id="lecturerForm" action="{{ route('lecturers.store') }}">
                    @csrf
                    <!-- Champs de formulaire -->


                    <div class="col-md-12 mb-4">
                        <div class="input-group has-validation">
                            <input type="text" name="name" class="form-control" id="name" placeholder="names" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="input-group has-validation">
                            <input type="text" name="country" class="form-control" id="country" placeholder="enter country" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="input-group has-validation">
                            <input type="date" name="birth_date" class="form-control" id="birth_date" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4 mt-2">
                        <input type="email" name="email" class="form-control" id="email" placeholder="xxxxxx@gmail.com" required>
                        <div class="invalid-feedback">Please enter a valid email address!</div>
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
    function openlecturerModal(lecturer) {
        // Pré-remplir les champs du formulaire
        document.getElementById('name').value = lecturer.name || '';
        document.getElementById('country').value = lecturer.country || '';
        document.getElementById('birth_date').value = lecturer.birth_date || '';
        document.getElementById('email').value = lecturer.email || '';

        // Mettre à jour l'action du formulaire pour l'édition
        const form = document.getElementById('lecturerForm');
        const updateUrl = event.currentTarget.getAttribute('data-url'); // Récupérer l'URL depuis le bouton
        form.action = updateUrl; // Mettre à jour l'action du formulaire
        form.method = 'POST';

        // Ajouter le champ hidden pour la méthode PUT
        let methodField = form.querySelector('input[name="_method"]');
        if (!methodField) {
            methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            form.appendChild(methodField);
        } else {
            methodField.value = 'PUT'; // Mettre à jour la valeur existante
        }

        // Mettre à jour le titre et le bouton du modal
        document.getElementById('modalTitle').innerText = "Update lecturer";
        document.getElementById('submitBtn').innerText = "Update";

        // Ouvrir le modal
        const modal = new bootstrap.Modal(document.getElementById('lecturerModal'));
        modal.show();
    }
</script>



@endsection
