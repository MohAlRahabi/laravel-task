{{-- ADD MODEL START --}}
<div id="add-modal" class="modal fade-scale" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="ModelLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModelLabel">Add New Blog</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="frm_add" class="add-form" method="POST">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-label">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="required-label">Content</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-label">Publish Date</label>
                            <input type="date" name="publish_date" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-label">Status</label>
                            <input type="text" name="status" class="form-control">
                        </div>

                        <div class="form-group col-md-12 ">
                            <label class="required-label">Image</label>
                            <input type="file" name="image" class="form-control">
                            <div id="imgPreview" style="display: none">
                                <div id="close-img" class="btn btn-xs btn-danger" data-id="">x</div>
                                <img src="" width="100">
                            </div>
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
