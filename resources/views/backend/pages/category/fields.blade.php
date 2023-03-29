<div class="mb-3">
    <label for="" class="form-label">Category Name</label>
    <input type="text" class="form-control" name="category_name" id="category_name"
        placeholder="Please enter a valid category name" value="{{ $category->category_name}}">
    <p class="form-text text-danger mt-3">
        @error('category_name')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Category Description</label>
    <input type="text" class="form-control" name="category_details" id="category_details"
        placeholder="Please enter a valid category details" value="{{ $category->category_details }}">
    <p class="form-text text-danger mt-3">
        @error('category_details')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Category Image</label>
    <input type="file" class="form-control" name="category_image" id="category_image"
        placeholder="Please enter a valid category image" value="{{ $category->category_image }}">
    <p class="form-text text-danger mt-3">
        @error('category_image')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Category Status</label>
    <select name="category_status" id="" class="form-control">
        <option value="0" {{ $category->category_status == 0 ? 'selected':'' }}>Inactive</option>
        <option value="1" {{ $category->category_status == 1 ? 'selected':'' }}>Active</option>
    </select>
    <p class="form-text text-danger mt-3">
        @error('category_details')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mt-3">
    <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
