<div class="mb-3">
    <label for="" class="form-label">Product Name</label>
    <input type="text" class="form-control" name="product_name" id="product_name"
        placeholder="Please enter a valid product name" value="{{ $product->product_name}}">
    <p class="form-text text-danger mt-3">
        @error('product_name')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Product Price</label>
    <input type="text" class="form-control" name="product_price" id="product_price"
        placeholder="Please enter a valid product price" value="{{ $product->product_price }}">
    <p class="form-text text-danger mt-3">
        @error('product_price')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Product Category</label>
    <select name="category_id" id="category_id" class="form-control">
        @foreach ($categories as $item)
        <option value="{{ $item->id }}" {{ $item->id == $product->category_id?'selected':'' }}>{{ $item->category_name
            }}
        </option>
        @endforeach
    </select>
    <p class="form-text text-danger mt-3">
        @error('category_id')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Product Description</label>
    <input type="text" class="form-control" name="product_details" id="product_details"
        placeholder="Please enter a valid product details" value="{{ $product->product_details }}">
    <p class="form-text text-danger mt-3">
        @error('product_details')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Product Image</label>
    <input type="file" class="form-control" name="product_image" id="product_image"
        placeholder="Please enter a valid product image" value="{{ $product->product_image }}">
    <p class="form-text text-danger mt-3">
        @error('product_image')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Product Status</label>
    <select name="product_status" id="" class="form-control">
        <option value="0" {{ $product->product_status == 0 ? 'selected':'' }}>Inactive</option>
        <option value="1" {{ $product->product_status == 1 ? 'selected':'' }}>Active</option>
    </select>
    <p class="form-text text-danger mt-3">
        @error('product_details')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mt-3">
    <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>