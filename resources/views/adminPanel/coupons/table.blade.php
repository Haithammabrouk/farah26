<div class="table-responsive-sm">
    <table class="table table-striped" id="countries-table">
        <thead>
            <tr>
                <th>coupon code</th>
                <th>coupon duration</th>
                <th>discount</th>
                <th>usage limit</th>
                <th>trips</th>
                <th>active</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->coupon_code }}</td>
                    <td>{{ $coupon->code_duration }}</td>
                    <td>{{ $coupon->discount }}</td>
                    <td>{{ $coupon->usage_limit }}</td>
                    <td>
                        <div class="container">
                            <div class="row">
                                @foreach ($coupon->related_trips as $value)
                                    <div class="col-lg-1">
                                        <span class="badge badge-secondary">{{ $value->trip_id }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($coupon->active == 1)
                            <p class="btn btn-success">Active</p>
                        @else
                            <p class="btn btn-danger">Inctive</p>
                        @endif
                    </td>
                    <td>
                        <div class='btn-group'>
                            <a href="{{ route('adminPanel.coupon.edit', [$coupon->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>

                            {!! Form::open(['route' => ['adminPanel.coupon.destroy', $coupon->id], 'method' => 'post']) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-ghost-danger',
                                'onclick' => 'return confirm("' . __('crud.are_you_sure') . '")',
                            ]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
