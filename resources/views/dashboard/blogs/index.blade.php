@extends('dashboard.layout.main')
@section('content')
    <div class="p-4">
        <div class="pt-2">
            <button
                class="btn btn-xs btn-dark mb-4"
                href="javascript:" onclick="openAdd()">
                <i class="fas fa-plus"></i>
                 Add New Blog
            </button>
            <button
                class="btn btn-xs btn-outline-dark mb-4"
                type="button"
                data-toggle="modal" data-target="#advanceSearchModal">
                <i class="fas fa-search"></i>
                 Advance Search
            </button>
            <button
                class="btn btn-xs btn-outline-danger mb-4"
                type="button"
                id="clearBtn"
                style="display: none">
                <i class="fas fa-eraser"></i>
                Clear Filters
            </button>
        </div>

        <div style="min-height: 300px;">
            <table class="table table-bordered table-striped" id="blog_table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Publish Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @component('dashboard.blogs.form')
    @endcomponent

    @component('dashboard.blogs.advance_search_modal')
    @endcomponent

@stop
@push('scripts')
    <script>
        let table;
        $(function () {
            table = $('#blog_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('blogs.data') }}",
                        data: function (d) {
                            d.adTitle = $('#advanceSearchTitle').val();
                            d.desc = $('#advanceSearchContent').val();
                            d.pDate = $('#advanceSearchPublishDate').val();
                            d.adStatus = $('#advanceSearchStatus').val();
                    }
                },
                lengthMenu : [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                dom: 'Blfrtip',
                fixedHeader: true,
                buttons: [

                ],
                columns: [
                    {"data": "title"},
                    {"data": "content", searchable: false},
                    {"data": "image_full_path","name":"image_full_path",
                        "render":function (data) {
                            if(data != null)
                                return "<a target='_blank' href='" + data + "'>" +
                                    `<div style='width: 100px;height: 100px;background-image: url("${data}");background-position: center;background-size: contain;background-repeat: no-repeat;'></div>` +
                                    "</a>"
                            return '';
                        }, orderable: false, searchable: false},
                    {"data": "publish_date", searchable: false},
                    {"data": "status", searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });

            $('.add-form').on('submit', function (event) {
                SaveItem(event, this, $(this).attr('action'), table);
            });

            table.on('click', '.delete', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent')
                }
                var data = table.row($tr).data();
                deleteOpr(data.id, `dashboard/blogs/` + data.id, table);
            });

            table.on('click', '.edit', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent')
                }
                var data = table.row($tr).data();
                openEdit(data);
            });

        });

        openAdd = () => {
            let $modal = $('#add-modal');
            let $form = $('.add-form');
            clearForm($form)
            $form[0].reset();
            $form.find('.select2').change();
            $form.attr('action', `dashboard/blogs`);
            $('.add-form input[name="_method"]').remove();
            $modal.find('.modal-title').text(`Add Blog`);
            $modal.find('input[type="file"]').show();
            $modal.find('name[type="_method"]').remove();
            $modal.find('#imgPreview').hide();
            clearErrors($modal);
            $modal.modal('show');
            $modal.removeClass('out');
            $modal.addClass('in');
        };

        openEdit = (data) => {
            let $modal = $('#add-modal');
            let $form = $('.add-form');
            $form[0].reset();
            $form.append('<input type="hidden" name="_method" value="PUT">');
            $form.attr('action', `dashboard/blogs/` + data.id);
            $modal.find('.modal-title').text(`Edit Blog`);
            $modal.find('#afm_btnSaveIt').text(`Update`);
            clearErrors($modal);
            _fill($modal, data);
            $modal.modal('show');
            $modal.removeClass('out');
            $modal.addClass('in');
        };
        $('#add-modal').on('hidden.bs.modal',function (event) {
            $(this).removeClass('in');
            $(this).addClass('out');
        })
        $('#close-img').on('click',function (event) {
            var id = $(this).attr('data-id');
            deleteOpr(id, `dashboard/blogs/delete_images/` + id, table)
            $('#add-modal').modal('toggle');
            $('#add-modal').find('input[type="file"]').show();
        })
        $('#advanceSearchBtn').on('click',function (event) {
            event.preventDefault();
            $('#advanceSearchModal').modal('hide');
            $('#clearBtn').show();
            table.draw();
        })
        $('#clearBtn').on('click',function (event) {
            event.preventDefault();
            $('#advanceSearchTitle').val('')
            $('#advanceSearchContent').val('')
            $('#advanceSearchPublishDate').val('')
            $('#advanceSearchStatus').val('')
            $('#clearBtn').hide();
            table.draw();
        })
    </script>
@endpush
