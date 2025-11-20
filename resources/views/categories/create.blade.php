<form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name">
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary btn-sm btn-end">Save</button>
    </div>
</form>
