@extends('partial.main')

@section('custom_styles');

@endsection

@section('content')

<section>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" onClick="addUser(this)"><i class="fas fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table-hover table-stripped" id="tableUser">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>View Activity</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addManual" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">User Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="user_name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name">
          <input type="hidden" class="form-control" id="id">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input type="code" class="form-control" id="email">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Role</label>
          <select name="" id="role" class="selectSingle" style="width: 100%">
            <option disabled selected value>Pilih Satu</option>
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="passwordCheck">
                <label class="form-check-label" for="flexSwitchCheckChecked">Change Password</label>
            </div>
          <label for="" class="form-label">Password</label>
          <input type="password" name="" id="password" class="form-control" disabled>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onClick="submitUser(this)" class="btn btn-primary">Save changes</button>
      </div>

    </div>
  </div>
</div>

@endsection

@section('custom_js')
<script>
    $(document).ready(function() {
        $('#tableUser').dataTable({
            scrollX: true,
            scrollY: '50vh',
            serverSide: true,
            processing: true,
            ajax: '{{route('userSystem.user.data')}}',
            columns: [
                {data:'name', name:'name', className:'text-center'},
                {data:'email', name:'email', className:'text-center'},
                {data:'roles', name:'roles', className:'text-center'},
                {data:'edit', name:'edit', className:'text-center'},
                {data:'activity', name:'activity', className:'text-center'},
            ]
        });

        $('#passwordCheck').on('change', async function () {
            const isChecked = $(this).prop('checked');
            $('#password').prop('disabled', !$(this).prop('checked'));
        })
    })
</script>

<script>
    async function addUser(button) {
        buttonLoading(button);
        $('#name').val('').trigger('change');
        $('#id').val('').trigger('change');
        $('#email').val('').trigger('change');
        $('#role').val('').trigger('change');
        $('#passwordCheck').prop('checked', false);
        $('#password').prop('disabled', !$(this).prop('checked'));
        $('#password').val('').trigger('change');
        $('#addManual').modal('show');
        hideButton(button);
    }

    async function submitUser(button) {
        const result = await confirmation();
        if (result.isConfirmed) {
            buttonLoading(button);
            const name = document.getElementById('name').value;
            const id = document.getElementById('id').value;
            const email = document.getElementById('email').value;
            const role = document.getElementById('role').value;
            const isChecked = $('#passwordCheck').prop('checked');
            const password = document.getElementById('password').value;

            const data = {
                name,
                id,
                email,
                role,
                isChecked,
                password,
            };
            console.log(data);
            const url = '{{route('userSystem.user.post')}}';
            const response = await globalResponse(data, url);
            hideButton(button);
            if (response.ok) {
                const hasil = await response.json();
                if (hasil.success) {
                    $('#tableUser').DataTable().ajax.reload();
                    $('#addManual').modal('hide');
                    successHasil(hasil);
                }else{
                    errorHasil(hasil);
                    return;
                }
            }else{
                errorResponse(response);
                return;
            }
        }else{
            return;
        }
    }

    async function editUser(button) {
        buttonLoading(button);
        const data = {
            id: button.dataset.id
        };

        const url = '{{route('getData.master.user')}}';
        const response = await globalResponse(data, url);
        hideButton(button);
        if (response.ok) {
            const hasil = await response.json()
            if (hasil.success) {
                successHasil(hasil);
                $('#name').val(hasil.data.name).trigger('change');
                $('#id').val(hasil.data.id).trigger('change');
                $('#email').val(hasil.data.email).trigger('change');
                $('#role').val(hasil.data.roles[0].id).trigger('change');
                $('#passwordCheck').prop('checked', false);
                $('#password').prop('disabled', !$(this).prop('checked'));
                $('#addManual').modal('show');
            }else{
                errorHasil(hasil);
                return;
            }
        }else{
            errorResponse(response);
        }
    }
</script>
@endsection