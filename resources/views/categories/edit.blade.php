<form id="categoryForm" action="{{ route('categories.update', $category->id) }}" method="POST">
    
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text"
               class="form-control"
               name="name"
               id="name"
               value="{{ old('name', $category->name) }}"
               placeholder="Enter category name">
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary btn-sm btn-end">Update</button>
    </div>
</form>
