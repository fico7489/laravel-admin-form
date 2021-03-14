<thead>
<tr>
    @foreach($tableConfig as $key => $row)
        <th @if(in_array($key, ['actions', 'id'])) width="8%" @endif >
            <div>
                <div class="float-left">
                    {{ $row['name'] }}
                </div>

                @if( ! isset($row['sort'])  ||  ! $row['sort'] === false)
                    <div class="float-right">
                        <a href="{{ $models->appends(request()->except(['sort_by', 'sort_type']))->appends(['sort_by' => $key, 'sort_type' => 'asc'])->url($models->currentPage()) }}"
                           @if(request()->get('sort_by') === $key  &&  request()->get('sort_type') === 'asc') style="color: black !important;" @endif >
                            <i class="icon-chevron-up"></i>
                        </a>
                        <div class="clearfix"></div>
                        <a href="{{ $models->appends(request()->except(['sort_by', 'sort_type']))->appends(['sort_by' => $key, 'sort_type' => 'desc'])->url($models->currentPage()) }}"
                           @if(request()->get('sort_by') === $key &&  request()->get('sort_type') === 'desc') style="color: black !important;" @endif >
                            <i class="icon-chevron-down"></i>
                        </a>
                    </div>
                @endif
            </div>
        </th>
    @endforeach
</tr>
</thead>
