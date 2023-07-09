@props(['check', 'tags'])

@php 
  $checked = $check ? 'checked' : '';
@endphp

<div id="tags-filter">
  <div class="form-check" id="tags-filter-header">
    <input class="form-check-input" type="checkbox" value="" id="tags-filter-check" {{ $checked }}>
    <label class="form-check-label" for="tags-filter-check">
      Tags filter
    </label>
    <button class="btn btn-secondary reload-button">
        <i class="bi bi-arrow-clockwise"></i>
    </button>
  </div>
  
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Tag" id="tags-filter-input" aria-label="Tag filter">
      <button class="btn btn-outline-secondary" type="button" id="tags-filter-add-button">
        <i class="bi bi-plus"></i>
      </button>
    </div>
  <div id="tags-filter-container">
    @foreach($tags as $tag)
      <x-tag-badge :text="$tag" :closeButton="true" />
    @endforeach
  </div>
</div>