<td width="8%">
    <div class="list-icons">
        @if(isset($customs))
            @foreach($customs as $custom)
                <a href="{{ $custom['url'] }}" class="list-icons-item">
                    <i class="{{ $custom['icon'] }}"></i>
                </a>
            @endforeach
        @endif
        @if(isset($show))
            <a href="{{ $show }}" class="list-icons-item">
                <i class="icon-eye"></i>
            </a>
        @endif
        @if(isset($edit))
            <a href="{{ $edit }}" class="list-icons-item">
                <i class="icon-pencil"></i>
            </a>
        @endif
        @if(isset($delete))
            <a href="#" class="list-icons-item delete-action-{{ $model->id }}">
                @if($model->deleted_at)
                    <i class="icon-reset"></i>
                @else
                    <i class="icon-trash"></i>
                @endif
            </a>
            {{ Form::open(['url' => $delete, 'method' => 'delete', 'class' => 'delete-form']) }}
            {{ Form::close() }}
        @endif
    </div>
</td>

@section('js')
    <script>
        $(document).ready(function () {
            $('.delete-action-{{ $model->id }}').click(function () {
                if (confirm('Jeste li sigurni?')) {
                    $(this).siblings('.delete-form').submit();
                }
            });
        });
    </script>
@append
