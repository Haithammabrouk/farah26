<div class="table-responsive-sm">
    <table class="table table-striped" id="itineraryDetails-table">
        <thead>
            <tr>
                <th>@lang('models/itineraryDetails.fields.itinerary_id')</th>
                <th>@lang('models/itineraryDetails.fields.text')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <thead style="background: #2f353a;">
            {!! Form::open(['route' => ['adminPanel.itineraryDetails.index'], 'method' => 'GET']) !!}

            <th>
                <select name="itinerary_id" class="form-control">
                    <option value="">select</option>
                    @foreach ($itineraries as $itinerary)
                    <option value="{{ $itinerary->id }}" {{ isset($itineraryDetail) && $itineraryDetail->itinerary_id == $itinerary->id ? 'selected' : '' }}>
                        {{ $itinerary->tripCategory->name .' - Day '. $itinerary->day }}
                    </option>
                    @endforeach
                </select>
            </th>
            <th></th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-light']) !!}
                    <a href="{{route('adminPanel.itineraryDetails.index')}}" class="btn btn-ghost-light"><i class="fa fa-ban"></i></a>
                </div>
            </th>

            {!! Form::close() !!}
        </thead>
        <tbody>
            @foreach($itineraryDetails as $itineraryDetail)
            <tr>
                <td>
                    {{ $itineraryDetail->itinerary->tripCategory->name .' - Day '. $itineraryDetail->itinerary->day }}
                </td>
                <td>{{ $itineraryDetail->text }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.itineraryDetails.destroy', $itineraryDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.itineraryDetails.show', [$itineraryDetail->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.itineraryDetails.edit', [$itineraryDetail->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
