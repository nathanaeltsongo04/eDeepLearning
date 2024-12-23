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

      <div class="card-body">
        <h5 class="card-title">Roles <span>| List </span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Role's Name</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $role)
            <tr>
                <th scope="row"><a href="#">{{ $role->id }}</a></th>
                <td>{{ $role->name ? $role->name : 'N/A' }}</td>
                <td><a class="text-primary">{{ 'N/A' }}</a></td>
              </tr>

            @endforeach

          </tbody>
        </table>

      </div>

    </div>
  </div>
@endsection
