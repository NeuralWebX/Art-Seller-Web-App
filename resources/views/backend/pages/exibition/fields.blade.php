<div class="mb-3">
    <label for="" class="form-label">Exibition Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Please enter a valid exibition name"
        value="{{ $Exibition->name}}">
    <p class="mt-3 form-text text-danger">
        @error('name')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Exibition description</label>
    <input type="text" class="form-control" name="description" id="description"
        placeholder="Please enter a valid exibition description" value="{{ $Exibition->description}}">
    <p class="mt-3 form-text text-danger">
        @error('description')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Exibition location</label>
    <input type="text" class="form-control" name="location" id="location"
        placeholder="Please enter a valid exibition location" value="{{ $Exibition->location}}">
    <p class="mt-3 form-text text-danger">
        @error('location')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Exibition start_at</label>
    <input type="datetime-local" class="form-control" name="start_at" id="start_at"
        placeholder="Please enter a valid exibition start_at" value="{{ $Exibition->start_at}}">
    <p class="mt-3 form-text text-danger">
        @error('start_at')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Exibition end_at</label>
    <input type="datetime-local" class="form-control" name="end_at" id="end_at"
        placeholder="Please enter a valid exibition end_at" value="{{ $Exibition->end_at}}">
    <p class="mt-3 form-text text-danger">
        @error('end_at')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Exibition image</label>
    <input type="file" class="form-control" name="image" id="image" placeholder="Please enter a valid exibition image"
        value="{{ $Exibition->image}}">
    <p class="mt-3 form-text text-danger">
        @error('image')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mb-3">
    <label for="" class="form-label">Exibition cover</label>
    <input type="file" class="form-control" name="cover" id="cover" placeholder="Please enter a valid exibition cover"
        value="{{ $Exibition->cover}}">
    <p class="mt-3 form-text text-danger">
        @error('cover')
        {{ $message }}
        @enderror
    </p>
</div>
<div class="mt-3">
    <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>