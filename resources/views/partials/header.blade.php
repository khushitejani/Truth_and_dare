<header class="header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Dashboard</h5>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
                        <i class="lni lni-exit"></i> Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</header>

