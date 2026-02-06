<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/partners.fields.photo').':') !!}
    {!! Form::file('photo') !!}
    @if(isset($partner))
    <img class="img-fluid" src={{$partner->photo}} alt="">
    @endif
</div>
<div class="clearfix"></div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', __('models/partners.fields.url').':') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.partners.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
