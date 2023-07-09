@props(['text', 'closeButton' => false])

<span class="badge rounded-pill text-bg-secondary mx-1">
  <span class="fs-6 tag-text">{{ $text }}</span>
  @if($closeButton)
    <button class="btn-close ms-1 tag-close-button" aria-label="Remove tag"></button>
  @endif
</span>