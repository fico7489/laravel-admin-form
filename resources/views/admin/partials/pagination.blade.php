@if($models->hasPages())
    <hr/>

    <div style="text-align: center" class="paginationNew">
        <a href="{{ $models->appends(request()->all())->previousPageUrl() }}" class="btn @if($models->onFirstPage()) disabled @endif">←</a>

        <?php
        $before = false;
        $after = false;
        ?>
        @for ($i = 1; $i <= $models->lastPage(); $i++)
            @if($i == 1  ||
                $i == 2  ||
                $i == $models->lastPage() ||
                $i == ($models->lastPage() - 1) ||
                ($i > ($models->currentPage() - 3) && $i < ($models->currentPage() + 3))
            )
                <a href="{{ $models->appends(request()->all())->url($i) }}" class="btn  @if($models->currentPage() == $i) active disabled btn-primary @endif">{{ $i }}</a>
            @else
                @if($i <= ($models->currentPage() - 3)  && ! $before)
                    @php $before = true; @endphp
                    <a href=#" class="btn active disabled">...</a>
                @endif
                @if($i >= ($models->currentPage() + 3)  && ! $after)
                    @php $after = true; @endphp
                    <a href=#" class="btn active disabled">...</a>
                @endif
            @endif
        @endfor

        <a href="{{ $models->appends(request()->all())->nextPageUrl() }}" class="btn @if( ! $models->hasMorePages()) disabled @endif">→</a>
    </div>
@endif

@section('js')
    <script>
        $(document).ready(function () {
            function hashchange () {
                let hash = window.location.hash;

                $('.paginationNew').find('a').each(function (){
                    href = $(this).attr('href') + hash;

                    $(this).attr('href', href);
                });
            };

            window.addEventListener('hashchange', hashchange());

        });
    </script>
@append
