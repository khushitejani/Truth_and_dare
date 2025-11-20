@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>eCommerce Dashboard</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                {{-- <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        eCommerce
                                    </li>
                                </ol> --}}

                                <a href="javascript:void(0)" class="main-btn primary-btn btn-hover btn-sm  open-modal"
                                    data-url="{{ route('categories.create') }}" data-title="Create Category">
                                    + Create Category
                                </a>

                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="row">
                <div class="col-lg-6">
                    <form id="truthForm" action="{{ route('truth.store') }}">
                        @csrf
                        <div class="card-style mb-30">
                            <h6 class="mb-25">Truth</h6>

                            <div class="input-style-1">
                                <label>Question</label>
                                <textarea placeholder="Add Question" rows="5" id="question" name="question" required></textarea>
                            </div>

                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($categories as $cat)
                                    <button type="button" class="btn btn-outline-primary btn-sm quick-btn"
                                        data-target="#messageBox3" data-text="{{ $cat->name }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="id" id="truth_id">

                            <input type="hidden" name="category_type" id="truth_type">

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form id="dareForm" action="{{ route('dare.store') }}">
                        @csrf
                        <div class="card-style mb-30">
                            <h6 class="mb-25">Dare</h6>

                            <div class="input-style-1">
                                <label>Dare</label>
                                <textarea placeholder="Add Dare" rows="5" id="dare" name="dare" required></textarea>
                            </div>

                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($categories as $cat)
                                    <button type="button" class="btn btn-outline-primary btn-sm quick-btn"
                                        data-target="#messageBox3" data-text="{{ $cat->name }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="id" id="dare_id">

                            <input type="hidden" name="category_type" id="dare_type">

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <h6 class="mb-10">Data Table</h6>
                        <div class="mb-3">
                            <label for="filter-type" class="form-label">Select Type:</label>
                            <select id="filter-type" class="form-select form-select-sm w-auto d-inline-block">
                                <option value="Truth">Truth</option>
                                <option value="Dare">Dare</option>
                                <option value="Category">Category</option>
                            </select>

                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>#</h6>
                                        </th>
                                        <th>
                                            <h6>Name</h6>
                                        </th>
                                        <th id="type-header">
                                            <h6>Type</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
    </section>
    @push('styles')
        <style>
            .d-flex button.quick-btn.active,
            .d-flex button.quick-btn.active:hover,
            .d-flex button.quick-btn.active:focus {
                background-color: #0d6efd !important;
                color: #fff !important;
                border-color: #0d6efd !important;
            }

            button.quick-btn {
                transition: background-color .12s ease, color .12s ease;
            }
        </style>
    @endpush
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.quick-btn').on('click', function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                const formId = $(this).closest('form').attr('id');
                if (formId === 'truthForm') $('#truth_type').val($(this).data('text'));
                if (formId === 'dareForm') $('#dare_type').val($(this).data('text'));
            });


            function loadDynamicTable() {
                $.ajax({
                    url: '{{ route('dashboard') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        let tbody = '',
                            index = 1;

                        if (res.truths) res.truths.forEach(item => {
                            console.log(item);
                            tbody += `<tr data-type="Truth">
                        <td>${index++}</td>
                        <td>${item.question}</td>
                        <td>${item.type}</td>
                          <td class="text-end">
                            <i class="lni lni-pencil-alt edit-btn" style="cursor:pointer; color:#0d6efd;" 
                               data-type="Truth" data-id="${item.id}" title="Edit"></i>
                            &nbsp;
                            <i class="lni lni-trash-can delete-btn" style="cursor:pointer; color:red;" 
                               data-type="Truth" data-id="${item.id}" title="Delete"></i>
                        </td>

                    </tr>`;
                        });

                        if (res.dares) res.dares.forEach(item => {
                            tbody += `<tr data-type="Dare">
                        <td>${index++}</td>
                        <td>${item.dare}</td>
                        <td>${item.type}</td>
                        <td class="text-end">
                            <i class="lni lni-pencil-alt edit-btn" style="cursor:pointer; color:#0d6efd;" 
                               data-type="Dare" data-id="${item.id}" title="Edit"></i>
                            &nbsp;
                            <i class="lni lni-trash-can delete-btn" style="cursor:pointer; color:red;" 
                               data-type="Dare" data-id="${item.id}" title="Delete"></i>
                        </td>

                    </tr>`;
                        });

                        if (res.categories) res.categories.forEach(item => {
                            tbody += `<tr data-type="Category">
                        <td>${index++}</td>
                        <td>${item.name}</td>
                        <td class="text-end">  
                        <i class="lni lni-pencil-alt edit-btn"
                            style="cursor:pointer; color:#0d6efd;"
                            data-type="Category"
                            data-id="${item.id}" 
                            data-url="/categories/${item.id}/edit"
                            title="Edit"></i>
                            &nbsp;
                            <i class="lni lni-trash-can delete-btn" style="cursor:pointer; color:red;" 
                            data-type="Category" data-id="${item.id}" title="Delete"></i>
                        </td>
                        </tr>`;
                        });

                        if (!tbody) tbody =
                            `<tr><td colspan="4" class="text-center">No entries found.</td></tr>`;
                        $('#dynamic-table tbody').html(tbody);
                        applyFilter();
                    },
                    error: function() {
                        toastr.error('Failed to load table data.');
                    }
                });
            }

            function applyFilter() {
                const selectedType = $('#filter-type').val();
                $('#dynamic-table tbody tr').each(function() {
                    $(this).toggle($(this).data('type') === selectedType);
                });

                updateTableNumbers();
                toggleTypeColumn();
            }

            function toggleTypeColumn() {
                const selectedType = $('#filter-type').val();
                if (selectedType === 'Category') {
                    $('#type-header').hide();
                } else {
                    $('#type-header').show();
                }
            }

            function updateTableNumbers() {
                let count = 1;
                $('#dynamic-table tbody tr:visible').each(function() {
                    $(this).find('td:first').text(count++);
                });
            }
            $('#filter-type').on('change', applyFilter);

            function submitForm(formId) {
                let form = $(formId);
                let url = form.attr('action');
                let formData = new FormData(form[0]);

                return $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false
                });
            }
            $('#truthForm').on('submit', function(e) {
                e.preventDefault();

                if ($('#truthForm .quick-btn.active').length === 0) {
                    toastr.warning('Please select at least one option for Truth');
                    return;
                }

                let formData = new FormData(this);
                let id = $('#truth_id').val();
                if (id) formData.append('_method', 'PUT');

                $.ajax({
                    url: id ? `/truth/${id}` : $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            toastr.success(id ? 'Truth updated successfully' :
                                'Truth saved successfully');
                            loadDynamicTable();
                            $('#truthForm')[0].reset();
                            $('#truthForm .quick-btn').removeClass('active');
                            $('#truth_type').val('');
                        } else {
                            toastr.error(res.message || 'Error saving truth');
                        }
                    },
                    error: function() {
                        toastr.error('Unexpected error occurred');
                    }
                });
            });


            $('#dareForm').on('submit', function(e) {
                e.preventDefault();

                if ($('#dareForm .quick-btn.active').length === 0) {
                    toastr.warning('Please select at least one option for Dare');
                    return;
                }

                let formData = new FormData(this);
                let id = $('#dare_id').val();
                if (id) formData.append('_method', 'PUT');

                $.ajax({
                    url: id ? `/dare/${id}` : $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            toastr.success(id ? 'Dare updated successfully' :
                                'Dare saved successfully');
                            loadDynamicTable();
                            $('#dareForm')[0].reset();
                            $('#dareForm .quick-btn').removeClass('active');
                            $('#dare_type').val('');
                        } else {
                            toastr.error(res.message || 'Error saving dare');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(key => toastr.error(errors[key][0]));
                        } else {
                            toastr.error('Unexpected error occurred');
                        }
                    }
                });
            });

            // $(document).on('submit', '#categoryForm', function(e) {
            //     e.preventDefault();
            //     let form = $(this);
            //     let url = form.attr('action');
            //     let formData = new FormData(this);

            //     $.ajax({
            //         url: url,
            //         type: 'POST',
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function(res) {
            //             if (res.success) {
            //                 toastr.success(res.message || 'Category saved successfully');
            //                 $('#commonModal').modal('hide');
            //                 loadDynamicTable();
            //             } else {
            //                 toastr.error(res.message || 'Something went wrong');
            //             }
            //         },
            //         error: function(xhr) {
            //             if (xhr.status === 422) {
            //                 let errors = xhr.responseJSON.errors;
            //                 Object.keys(errors).forEach(key => toastr.error(errors[key][0]));
            //             } else {
            //                 toastr.error('Unexpected error occurred.');
            //             }
            //         }
            //     });
            // });
            $(document).on('submit', '#categoryForm', function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(this);

                if (form.find('input[name="id"]').val()) {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        toastr.success('Category saved successfully');
                        $('#commonModal').modal('hide');
                        loadDynamicTable(); // Refresh table with updated value
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(key => toastr.error(errors[key][0]));
                        } else {
                            toastr.error('Unexpected error occurred.');
                        }
                    }
                });
            });
            $('form').on('submit', function(e) {
                const $form = $(this);
                setTimeout(function() {
                    $form.find('.quick-btn').removeClass(
                        'active');
                    if ($form.attr('id') === 'truthForm') {
                        $('#truth_type').val('');
                    }
                    if ($form.attr('id') === 'dareForm') {
                        $('#dare_type').val('');
                    }
                }, 50);
            });
            $(document).on('click', '.delete-btn', function() {
                let type = $(this).data('type');
                let id = $(this).data('id');

                if (!confirm("Are you sure?")) return;

                $.ajax({
                    url: `/${type.toLowerCase()}/${id}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        toastr.success(res.message || `${type} deleted`);
                        loadDynamicTable();
                    }
                });
            });
            $(document).on('click', '.edit-btn', function() {
                let type = $(this).data('type');
                let id = $(this).data('id');

                $.ajax({
                    url: `/${type.toLowerCase()}/${id}/edit`,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        if (type === 'Truth') {
                            $('#truthForm #question').val(res.question);
                            $('#truthForm #truth_type').val(res.type);
                            $('#truthForm #truth_id').val(res.id);
                            $('#truthForm .quick-btn').removeClass('active');
                            $('#truthForm .quick-btn').each(function() {
                                if ($(this).data('text').toString().trim()
                                    .toLowerCase() === res.type.toString().trim()
                                    .toLowerCase()) {
                                    $(this).addClass('active');
                                }
                            });
                        }

                        if (type === 'Dare') {
                            $('#dareForm #dare').val(res.dare);
                            $('#dareForm #dare_type').val(res.type);
                            $('#dareForm #dare_id').val(res.id);

                            $('#dareForm .quick-btn').removeClass('active');
                            $('#dareForm .quick-btn').each(function() {
                                if ($(this).data('text').toString().trim()
                                    .toLowerCase() === res.type.toString().trim()
                                    .toLowerCase()) {
                                    $(this).addClass('active');
                                }
                            });
                        }
                        if (type === 'Category') {
                            $.ajax({
                                url: `/categories/${id}/edit`,
                                type: 'GET',
                                success: function(res) {
                                    $('#commonModal .modal-body input[name="name"]')
                                        .val(res.name);
                                    $('#commonModal .modal-body input[name="id"]')
                                        .val(res.id);
                                    $('#commonModal').modal('show');
                                },
                                error: function() {
                                    toastr.error('Failed to fetch category data.');
                                }
                            });
                        }

                    }
                });
            });
            loadDynamicTable();
        });
    </script>
@endpush
