<fieldset class="mb-3">
    <div class="form-group row">
        <div class="col-lg-10">
            @foreach($model->media as $media)
                <div class="float-left" style="width : 100px; height: 160px; margin: 10px;">
                    <div style="width : 100px; height: 100px;">
                        <img src="{{ mediaUrl($media, 'x-small') }}"></img><br/>
                    </div>

                    <div style="text-align: center;">
                        <button class="btn" style="margin: 0; padding: 0; width: 38px;" type="submit" form="leftMediaForm-{{$media->id}}"><i class="icon-arrow-left5 btn"></i></button>
                        <span style="width: 20px;">{{ (int) $media->number }}</span>
                        <button class="btn" style="margin: 0; padding: 0; width: 38px;" href="#" type="submit" form="rightMediaForm-{{$media->id}}"><i class="icon-arrow-right5 btn"></i></button>
                        <br/>
                        <button class="btn" style="margin: 5px 0; padding: 0; width: 38px;" form="deleteMediaForm-{{$media->id}}"><i class="icon-trash"></i></button>
                    </div>
                </div>
            @endforeach
            <div class="float-left" style="height: 200px; width: 200px;">
                <div class="d-flex align-items-start flex-column" style="height: 200px;">
                    <div class="p-2">&nbsp</div>
                    <div class="p-2">&nbsp</div>
                    <div class="custom-file p-2">
                        <input type="file" name="files[]" class="custom-file-input" id="file" form="fileForm" multiple>
                        <label class="custom-file-label" for="file">Odaberite sliku</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>

{{ Form::open(['route' => 'admin.medias.store', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'fileForm']) }}
<input style="display: none;" name="model_id" value="{{ $model->id }}">
<input style="display: none;" name="model_type" value="{{ get_class($model) }}">
{{ Form::close() }}

@foreach($medias as $media)
    {{ Form::open(['url' => route('admin.medias.destroy', $media), 'method' => 'delete', 'id' => 'deleteMediaForm-' . $media->id]) }}
    {{ Form::close() }}

    {{ Form::open(['url' => route('admin.medias.left', $media), 'method' => 'put', 'id' => 'leftMediaForm-' . $media->id]) }}
    {{ Form::close() }}

    {{ Form::open(['url' => route('admin.medias.right', $media), 'method' => 'put', 'id' => 'rightMediaForm-' . $media->id]) }}
    {{ Form::close() }}
@endforeach

@section('js')
    <script>
        $(document).ready(function () {
            $('.custom-file-input').change(function () {
                var fileName = $(this).val();
                var form = $(this).attr('form');

                $('#fileForm').submit();

                $(this).closest('.float-left').html('<img src="/img/loader.gif" style="height: 160px;">');

                return false;
            });
        });
    </script>
@append
