<div class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 0.5em">
@auth
  <div style="display: flex; align-items: center; column-gap: 1em">
    <button class="btn btn-primary" aria-label="New Todo" id="new-todo-button">
      <span style="white-space: nowrap">Add Todo</span>
    </button>

    <div class="input-group">
      <input type="text" class="form-control" placeholder="Tags filter" id="tags-filter-input" style="min-width: 20em" aria-label="Tags filter">
      <button class="btn btn-outline-secondary" type="button" id="filter-tags-button">Filter</button>
    </div>
  
      <span>
        {{ Auth::user()->name }}
      </span>
      <button class="btn btn-secondary" id="logout-button">
        <i class="bi bi-box-arrow-right"></i>
      </button>
  </div>
@endauth

<button class="btn btn-secondary" id="toggle-theme-button" style="margin-left: auto">
  Toggle theme
</button>
</div>


<script>
  const logoutButton = document.getElementById('logout-button');
  if(logoutButton) {
    logoutButton.onclick = async () => {
      await axios.post('/logout'); 
      location.reload(true);
    }
  }

  const toggleThemeButton = document.getElementById('toggle-theme-button');
  toggleThemeButton.onclick = () => {
    const htmlEl = document.documentElement;
    const theme = htmlEl.getAttribute('data-bs-theme');
    switch(theme) {
      case 'light':
      default:
        htmlEl.setAttribute('data-bs-theme', 'dark');
        break;
      case 'dark':
        htmlEl.setAttribute('data-bs-theme', 'light');
        break;
    }
  }
</script>