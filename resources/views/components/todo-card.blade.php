@php 
  $previewImage = $todo->getPreviewImage();
  $fullImage = $todo->getFullImage();
@endphp

<div class="card todo-card" data-id="{{ $todo->id }}">
  <div class="todo-content">
    @if($previewImage && $fullImage)
      <a href="/storage/{{ $fullImage->path }}" target="_blank">
        <img src="/storage/{{ $previewImage->path }}" alt="Todo image" class="todo-content__image">
      </a>
    @else
      <div class="todo-content__image"></div>
    @endif

    <div>
      {{ $todo->text }}
    </div>

    <div class="todo-card__tags">
      @foreach($todo->tags as $tag)
        <span class="badge rounded-pill text-bg-secondary mx-1"><span class="fs-6 tag-text">{{ $tag->text }}</span></span>
      @endforeach
    </div>

    <button class="btn btn-primary edit-button">
      <i class="bi bi-pencil"></i>
    </button>
  </div>
</div>