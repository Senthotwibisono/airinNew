@extends('partial.main')

@section('content')

<section>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" onClick="addRole(this)"><i class="fas fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table-hover table-stripped" id="tableRoles">
                            <thead style="white-space: nowrap;">
                                <tr>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Assigned Permission</th>
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
        <h5 class="modal-title" id="editUserModalLabel">Role Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="user_name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name">
          <input type="hidden" class="form-control" id="id">
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
        $('#tableRoles').dataTable({
            scrollX: true,
            scrollY: '50vh',
            serverSide: true,
            processing: true,
            ajax: '{{route('userSystem.role.data')}}',
            columns: [
                {data:'name', name:'name', className:'text-center'},
                {data:'created_at', name:'created_at', className:'text-center'},
                {data:'edit', name:'edit', className:'text-center'},
                {data:'activity', name:'activity', className:'text-center'},
            ]
        });
    })
</script>

<script>
    async function addRole(button) {
        buttonLoading(button);
        $('#name').val('').trigger('change');
        $('#id').val('').trigger('change');
        $('#addManual').modal('show');
        hideButton(button);
    }

    async function editRole(button) {
        buttonLoading(button);
        const data = {
            id: button.dataset.id,
        };

        const url = '{{route('getData.master.role')}}';
        const response = await globalResponse(data, url);
        hideButton(button);
        if (response.ok) {
            const hasil = await response.json();
            if (hasil.success) {
                $('#name').val(hasil.data.name).trigger('change');
                $('#id').val(hasil.data.id).trigger('change');
                $('#addManual').modal('show');
                successHasil(hasil); 
            }else{
                errorHasil(hasil);
                return;
            }
        }else{
            errorResponse(response);
            return;
        }
    }
</script>
@endsection