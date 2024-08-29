@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                           Id
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Duration
                        </th>
                        <td>
                            {{ $appointment->duration }} {{$appointment->duration_type}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Available Hours
                        </th>
                        <td style="height: 250px;">
                            @foreach($appointment->available_hr as $slot)
                                <span class="shadowbox">{{ str_replace('=' , ' To ' , $slot) }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Slots
                        </th>
                        <td style="height: 250px;">
                            @foreach($slots as $slot)
                                <span class="shadowbox">{{date('h:i A',  strtotime($slot['start_time'])) }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {!! $appointment->comments !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Services
                        </th>
                        <td>
                            <span class="label label-info label-many">{{ $appointment->service?->name }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection