{{-- ADD MODEL START --}}
<div id="add-modal" class="modal fade-scale" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="ModelLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModelLabel">Add New Subscriber</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frm_add" class="add-form" method="POST">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-label">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-label">Password</label>
                            <input type="password" min="8" name="password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-label">Password Confirmation</label>
                            <input type="password" min="8" name="password_confirmation" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="required-label">Status</label>
                            <input type="text" name="status" class="form-control">
                        </div>
                    </div>

                    <div class="form-group m-2 float-right">
                        <button type="submit" class="edit btn btn-xs btn-dark mr-2" >
                            Save
                        </button>
                        <button type="button" class="btn btn-xs btn-outline-dark" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- ADD MODEL END --}}
