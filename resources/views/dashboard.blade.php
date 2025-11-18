@extends('layouts.app')

@section('page_title', 'eCommerce Dashboard')
@section('breadcrumb', 'eCommerce')

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

                                <a href="javascript:void(0)"
                                    class="main-btn primary-btn btn-hover btn-sm  open-modal" data-url="{{ route('categories.create') }}"
                                    data-title="Create Category">
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
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Textarea</h6>
                        <div class="input-style-1">
                            <label>Message</label>
                            <textarea placeholder="Message" rows="5" id="messageBox3"></textarea>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Fun">Fun</button>
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Harsh">Harsh</button>
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Soft">Soft</button>
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Premium">Premium</button>
                        </div>
                        <div class="text-end mt-3">
                            <a href="#" class="btn btn-primary btn-sm">Save</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Textarea</h6>
                        <div class="input-style-1">
                            <label>Message</label>
                            <textarea placeholder="Message" rows="5" id="messageBox1"></textarea>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Fun">Fun</button>
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Harsh">Harsh</button>
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Soft">Soft</button>
                            <button class="btn btn-outline-primary btn-sm quick-btn" data-text="Premium">Premium</button>
                        </div>
                        <div class="text-end mt-3">
                            <a href="#" class="btn btn-primary btn-sm">Save</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <h6 class="mb-10">Data Table</h6>
                        <p class="text-sm mb-20">
                            For basic styling—light padding and only horizontal
                            dividers—use the class table.
                        </p>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>#</h6>
                                        </th>
                                        <th>
                                            <h6>Name</h6>
                                        </th>
                                        <th>
                                            <h6>Email</h6>
                                        </th>
                                        <th>
                                            <h6>Project</h6>
                                        </th>
                                        <th>
                                            <h6>Status</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                    <!-- end table row-->
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="employee-image">
                                                <img src="assets/images/lead/lead-1.png" alt="" />
                                            </div>
                                        </td>
                                        <td class="min-width">
                                            <p>Esther Howard</p>
                                        </td>
                                        <td class="min-width">
                                            <p><a href="#0">yourmail@gmail.com</a></p>
                                        </td>
                                        <td class="min-width">
                                            <p>Admin Dashboard Design</p>
                                        </td>
                                        <td class="min-width">
                                            <span class="status-btn active-btn">Active</span>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <button class="text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
                                    <tr>
                                        <td>
                                            <div class="employee-image">
                                                <img src="assets/images/lead/lead-2.png" alt="" />
                                            </div>
                                        </td>
                                        <td class="min-width">
                                            <p>D. Jonathon</p>
                                        </td>
                                        <td class="min-width">
                                            <p><a href="#0">yourmail@gmail.com</a></p>
                                        </td>
                                        <td class="min-width">
                                            <p>React Dashboard</p>
                                        </td>
                                        <td class="min-width">
                                            <span class="status-btn active-btn">Active</span>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <button class="text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
                                    <tr>
                                        <td>
                                            <div class="employee-image">
                                                <img src="assets/images/lead/lead-3.png" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <p>John Doe</p>
                                        </td>
                                        <td>
                                            <p><a href="#0">yourmail@gmail.com</a></p>
                                        </td>
                                        <td>
                                            <p>Bootstrap Template</p>
                                        </td>
                                        <td>
                                            <span class="status-btn success-btn">Done</span>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <button class="text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
                                    <tr>
                                        <td>
                                            <div class="employee-image">
                                                <img src="assets/images/lead/lead-4.png" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <p>Rayhan Jamil</p>
                                        </td>
                                        <td>
                                            <p><a href="#0">yourmail@gmail.com</a></p>
                                        </td>
                                        <td>
                                            <p>Css Grid Template</p>
                                        </td>
                                        <td>
                                            <span class="status-btn info-btn">Pending</span>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <button class="text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
                                    <tr>
                                        <td>
                                            <div class="employee-image">
                                                <img src="assets/images/lead/lead-5.png" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <p>Esther Howard</p>
                                        </td>
                                        <td>
                                            <p><a href="#0">yourmail@gmail.com</a></p>
                                        </td>
                                        <td>
                                            <p>Admin Dashboard Design</p>
                                        </td>
                                        <td>
                                            <span class="status-btn close-btn">Close</span>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <button class="text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
                                    <tr>
                                        <td>
                                            <div class="employee-image">
                                                <img src="assets/images/lead/lead-6.png" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <p>Anee Doe</p>
                                        </td>
                                        <td>
                                            <p><a href="#0">yourmail@gmail.com</a></p>
                                        </td>
                                        <td>
                                            <p>Space Template Update</p>
                                        </td>
                                        <td>
                                            <span class="status-btn active-btn">Active</span>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <button class="text-danger">
                                                    <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end table row -->
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
@endsection

@push('scripts')
    <script>
        // function loadCategoriesTable() {
        //     $.ajax({
        //         url: '{{ route('categories.index') }}', // route to reload categories table
        //         type: 'GET',
        //         dataType: 'html',
        //         success: function(response) {
        //             const newRows = $(response).find('#categories-table-rows').html();
        //             $('#categories-table-rows').html(newRows);
        //         },
        //         error: function() {
        //             toastr.error('Failed to reload categories table.');
        //         }
        //     });
        // }    

        $(document).on('submit', '#categoryForm', function(e) {
            alert('asdjidiasufhsjkhi');
            e.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let formData = new FormData(this);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.success) {
                          toastr.success(res.message || 'Category saved successfully');
                        $('#commonModal').modal('hide');
                    } else {
                        toastr.error(res.message || 'Something went wrong');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => toastr.error(errors[key][0]));
                    } else {
                        toastr.error('Unexpected error occurred.');
                    }
                }
            });
        });


        document.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                let text = btn.getAttribute('data-text');
                let box = document.getElementById('messageBox');

                // Add text with spacing
                box.value += (box.value ? ', ' : '') + text;
            });
        });
    </script>
@endpush
