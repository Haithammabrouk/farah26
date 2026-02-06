<!-- Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key', __('models/infos.fields.key').':') !!}
    {{-- {!! Form::text('key', null, ['class' => 'form-control']) !!} --}}
    @if (isset($info))
    	<h3>{{ $info->key }}</h3>
    @endif
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', __('models/infos.fields.value').':') !!}
    {!! Form::text('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.infos.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
