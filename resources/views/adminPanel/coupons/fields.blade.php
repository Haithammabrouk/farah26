<div class="row">
    <div class="col nav-tabs-boxed">
        <div class="tab-content" id="pills-tabContent" style="padding: 30px;">

            <!-- name Field -->
            <div class="form-group col-sm-6">
                <div class="form-group col-sm-12">
                    <label for="">coupon code</label>
                    <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Enter coupon code">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">coupon duration</label>
                    <input type="date" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Enter coupon duration">
                </div>
                <!-- Closed Cabin Field -->
                <div class="form-group col-sm-12">
                    <label for="">Trips</label><br>
                    <input type="checkbox" id="music" name="all_trips" value="all_trips" /><label style="margin-left: 10px;" for="music">all trips</label>
                    <select name="trips[]" class="form-control select2" multiple="multiple">
                        @foreach ($trips as $additionalTrip)
                            <option value="{{ $additionalTrip->id }}"
                                {{ isset($tripsAdditionals) && in_array($additionalTrip->id, $tripsAdditionals) ? 'selected' : '' }}>
                                {{ $additionalTrip->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label for="">discount (%)</label>
                    <input type="number" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="Enter discount">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">usage limit</label>
                    <input type="number" class="form-control" name="limit" value="{{ old('limit') }}" placeholder="Enter usage limit">
                </div>
                <div class="form-group col-sm-12">
                    <label for="">active</label>
                    <select name="activation" class="form-control">
                        <option value="1">Select Activation</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('adminPanel.coupon') }}" class="btn btn-default">@lang('crud.cancel')</a>
                </div>
            </div>
        </div>



    </div>
</div>
</div>
