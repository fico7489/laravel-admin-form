<li class="nav-item">
    <a href="{{ $route }}" class="nav-link">
        <i class="{{ $icon ?? '' }}"></i>
        <span>{{ $label }}</span>
        @if(isset($count)) <span class="badge bg-blue-400 align-self-center ml-auto">{{ $count }}</span> @endif
    </a>
</li>
