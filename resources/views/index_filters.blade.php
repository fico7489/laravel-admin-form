<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Filteri</span>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="card-header header-elements-inline" style="padding: .4rem .6rem; width: 90%; float: left;">
            {{ Form::open(['url' => route(\Request::route()->getName(), request()->only(['sort_by', 'sort_type', 'per_page'])), 'method' => 'get', 'class' => 'form-inline']) }}
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control" name="q" value="{{ request()->get('q') }}" placeholder="Pretraži...">
            </div>
            <div class="input-group mb-2 mr-sm-2">
                <?php
                $showDeleted = false;
                if ($models && ($modelFirst = $models->first()) && isClassUseTrait($modelFirst, \Illuminate\Database\Eloquent\SoftDeletes::class)) {
                    $showDeleted = true;
                }
                ?>

                @if($showDeleted)
                    <label class="my-1 mr-2" for="is_deleted">Obrisano?</label>
                    {{ Form::select('is_deleted', [
                        '' => 'Ne',
                        'yes' => 'Da',
                        'all' => 'Oboje',
                    ], request()->get('is_deleted'), ['class' => "custom-select my-1 mr-sm-2"]) }}
                @endif
            </div>

            @yield('filters')

            <div class="input-group mb-2 mr-sm-2">
                <label class="my-1 mr-2" for="per_page">Po stranici</label>
                {{ Form::select('per_page', [
                    25 => 25,
                    50 => 50,
                    100 => 100,
                    250 => 250,
                    500 => 500,
                ], request()->get('per_page'), ['class' => 'custom-select my-1 mr-sm-2']) }}
            </div>
            <div class="input-group mb-2 mr-sm-2">
                <input type="submit" class="btn btn-primary" id="inlineFormInputGroupUsername2" value="Primijeni">
            </div>

            <div class="input-group mb-2 mr-sm-2">
                <a type="submit" class="btn btn-primary" id="inlineFormInputGroupUsername2" href="{{ Request::url() }}">Očisti filtere</a>
            </div>

            {{ Form::close() }}
        </div>
        <div style="width: 10%; float: left; padding: 0.6rem;">
            @if(isset($create))
                <a href="{{ $create }}" style="float: right;">
                    <button type="submit" class="btn btn-primary">Dodaj novo<i class="icon-new-tab ml-2"></i></button>
                </a>
            @endif
        </div>
    </div>
</div>
