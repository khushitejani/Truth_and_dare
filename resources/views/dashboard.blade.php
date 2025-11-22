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
                            <h2>Truth & Dare Dashboard</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
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
                    <form id="truthForm" action="{{ route('truth.store') }}" method="POST">
                        @csrf
                        <div class="card-style mb-30">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Truth</h6>
                                <a href="javascript:void(0)" class="main-btn secondary-btn btn-hover btn-sm open-bulk-modal"
                                    data-url="{{ route('bulk.import.form') }}"
                                    data-submit-url="{{ route('bulk.import.truth') }}" data-title="Bulk Import">
                                    + Bulk Import
                                </a>
                            </div>
                            <div class="input-style-1">
                                <label>Question</label>
                                <textarea placeholder="Add Question" rows="5" id="question" name="question" required></textarea>
                            </div>

                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($categories as $cat)
                                    <button type="button" class="btn btn-outline-primary btn-sm quick-btn"
                                        data-target="#messageBox3" data-id="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="id" id="truth_id">
                            <input type="hidden" name="category_id" id="truth_type">
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form id="dareForm" action="{{ route('dare.store') }}" method="POST">
                        @csrf
                        <div class="card-style mb-30">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Dare</h6>
                                <a href="javascript:void(0)" class="main-btn secondary-btn btn-hover btn-sm open-bulk-modal"
                                    data-url="{{ route('bulk.import.form') }}" data-title="Bulk Import"
                                    data-submit-url="{{ route('bulk.import.dare') }}">
                                    + Bulk Import
                                </a>
                            </div>
                            <div class="input-style-1">
                                <label>Dare</label>
                                <textarea placeholder="Add Dare" rows="5" id="dare" name="dare" required></textarea>
                            </div>

                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($categories as $cat)
                                    <button type="button" class="btn btn-outline-primary btn-sm quick-btn"
                                        data-target="#messageBox3" data-id="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="id" id="dare_id">
                            <input type="hidden" name="category_id" id="dare_type">
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-75">
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
                                        <th class="text-end">
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

            #dynamic-table td.content-cell,
            #dynamic-table th:nth-child(2) {
                max-width: 300px;
                white-space: normal;
                word-wrap: break-word;
                padding: 10px 50px;
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
                if (formId === 'truthForm') $('#truth_type').val($(this).data('id'));
                if (formId === 'dareForm') $('#dare_type').val($(this).data('id'));
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
                            let fullText = item.question;
                            let displayText = fullText.length > 150 ? fullText.substr(0, 150) +
                                '...' : fullText;
                            tbody += `<tr data-type="Truth">
                        <td>${index++}</td>
                        <td class="content-cell" data-full="${fullText}">${displayText}</td>
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
                            let fullText = item.dare;
                            let displayText = fullText.length > 150 ? fullText.substr(0, 150) +
                                '...' : fullText;
                            tbody += `<tr data-type="Dare">
                        <td>${index++}</td>
                        <td class="content-cell" data-full="${fullText}">${displayText}</td>
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

                if (url === '{{ route('dashboard') }}') {
                    console.error('Cannot POST to dashboard!');
                    return;
                }
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

            $(document).on('submit', '#categoryForm', function(e) {
                e.preventDefault();
                let form = $(this);
                let id = $('#category_id').val();
                let url = id ? `/categories/${id}` : '{{ route('categories.store') }}';

                let method = id ? 'PUT' : 'POST';
                let formData = new FormData(form[0]);
                if (id) formData.append('_method', 'PUT');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        toastr.success(res.message || 'Category saved successfully');
                        $('#commonModal').modal('hide');
                        loadDynamicTable();
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
                let url = '';

                if (type === 'Truth') url = `/truth/${id}/edit`;
                if (type === 'Dare') url = `/dare/${id}/edit`;
                if (type === 'Category') url = `/categories/${id}/edit`;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(res) {
                        if (type === 'Truth') {
                            $('#truthForm #question').val(res.question);
                            $('#truthForm #truth_type').val(res.type);
                            $('#truthForm #truth_id').val(res.id);
                            $('#truthForm .quick-btn').removeClass('active');
                            $('#truthForm .quick-btn').each(function() {
                                if ($(this).data('id').toString().trim()
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
                                if ($(this).data('id').toString().trim()
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
                                    $('#commonModal .modal-body').html(res);
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


            $(document).on('submit', '#bulkImportForm', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            toastr.success(res.message);
                            $('#commonModal').modal('hide');
                        } else {
                            toastr.error(res.message || 'Failed to import.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Unexpected error occurred.');
                    }
                });
            });
            $(document).on('click', '.content-cell', function() {
                let cell = $(this);
                let fullText = cell.data('full');

                if (cell.hasClass('expanded')) {
                    // Collapse back to 100 chars
                    let truncated = fullText.length > 100 ? fullText.substr(0, 100) + '...' : fullText;
                    cell.text(truncated);
                    cell.removeClass('expanded');
                } else {
                    // Expand to full text
                    cell.text(fullText);
                    cell.addClass('expanded');
                }
            });
            loadDynamicTable();
        });
    </script>
@endpush
