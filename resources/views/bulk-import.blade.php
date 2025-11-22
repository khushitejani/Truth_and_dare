<form id="bulkImportForm" enctype="multipart/form-data"  action="">
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Upload CSV</label>
        <input type="file" name="file" id="file" class="form-control" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary btn-sm">Import</button>
    </div>
</form>