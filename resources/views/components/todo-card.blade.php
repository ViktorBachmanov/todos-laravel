@php 
  $previewImage = $todo->getPreviewImage();
  $fullImage = $todo->getFullImage();
@endphp

<div class="card todo-card" data-id="{{ $todo->id }}">
  <div class="todo-content">
    <div class="todo-text">
      {{ $todo->text }}
    </div>

    @if($previewImage && $fullImage)
      <a href="/storage/{{ $fullImage->path }}" target="_blank">
        <img src="/storage/{{ $previewImage->path }}" alt="Todo image" class="todo-content__image">
      </a>
    {{-- @else
      <div class="todo-content__image"></div> --}}
    @endif

    <div class="todo-card__tags">
      @foreach($todo->tags as $tag)
        <x-tag-badge :text="$tag->text" />
      @endforeach
    </div>

    <div class="todo-card__buttons">
      <button class="btn btn-primary edit-button">
        <i class="bi bi-pencil"></i>
      </button>

      <button class="btn btn-secondary delete-button">
        <i class="bi bi-x-square"></i>
      </button>
    </div>
  </div>
</div>