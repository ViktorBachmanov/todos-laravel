@props(['tags'])

<div id="tags-filter">
  Tags filter
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