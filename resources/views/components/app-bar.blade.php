<div class="navbar navbar-expand-lg bg-body-tertiary">
@auth
  <div style="display: flex; align-items: center; column-gap: 2em">
    <button class="btn btn-primary" aria-label="New Todo" id="new-todo-button">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
    </button>

    <div class="input-group">
      <input type="text" class="form-control" placeholder="Tags filter" id="tags-filter-input" style="min-width: 20em" aria-label="Tags filter">
      <button class="btn btn-outline-secondary" type="button" id="filter-tags-button">Filter</button>
    </div>
  </div>

  <div>
    {{ Auth::user()->name }}
    <button class="btn btn-secondary" onclick="axios.post('/logout'); location.reload()">
      <i class="bi bi-box-arrow-right"></i>
    </button>
  </div>
@endauth
</div>