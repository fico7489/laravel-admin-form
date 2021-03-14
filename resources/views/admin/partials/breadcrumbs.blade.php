<?php
if (strpos(\Route::currentRouteName(), '.edit') !== false) {
    $breadcrumbs += ['Edit' => \Request::url()];
} elseif (strpos(\Route::currentRouteName(), '.create') !== false) {
    $breadcrumbs += ['Create' => \Request::url()];
}
?>

<div class="d-flex">
    <div class="breadcrumb">
        @if(isset($breadcrumbs))
            @foreach($breadcrumbs as $name => $url)
                <a href="{{ $url }}" class="breadcrumb-item"></i>{{ $name }}</a>
            @endforeach
        @endif
    </div>
</div>
