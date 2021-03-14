@if($methodName == 'checkbox')
    <div class="form-group row">
        {{ Form::label($name, $label, ['class' => 'col-form-label col-lg-2']) }}
        <div class="col-lg-10">
            <label class="form-check-label">
                {{ $inputString }}
            </label>
        </div>
    </div>
@else
    <div class="form-group row">
        {{ Form::label($name, $label, ['class' => 'col-form-label col-lg-2']) }}
        <div class="col-lg-10">
            {{ $inputString }}
        </div>
    </div>
@endif
