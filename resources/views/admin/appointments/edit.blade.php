@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.appointments.update", [$appointment->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
            
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">Name*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($appointment) ? $appointment->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6 form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                    <label for="start_time">Duration*</label>
                    <input type="number" id="duration" name="duration" class="form-control" value="{{ old('name', isset($appointment) ? $appointment->duration : '') }}" required>
                    @if($errors->has('duration'))
                        <em class="invalid-feedback">
                            {{ $errors->first('duration') }}
                        </em>
                    @endif
                </div>
                <div class="col-md-6 form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                    <label for="start_time">Duration Type*</label>
                    <select name="duration_type" class="form-control">
                        <option value="min">min</option>
                        <option value="hrs">hrs</option>
                    </select>
                    @if($errors->has('duration_type'))
                        <em class="invalid-feedback">
                            {{ $errors->first('duration_type') }}
                        </em>
                    @endif
                </div>
            </div>
            <label for="start_time">What hours are you available?</label>
                    <div id="slot-container" class="mb-2" >
                        @foreach($date as $k=>$slot)
                        
                            <div class="row m-1 slot-div slot_1"  style="border-style: outset;">
                                <div class="col-md-6 form-group">
                                    <label for="start_time">Start Time*</label>
                                    <input type="text" id="available_hr" name="available_hr_start_time[]" class="form-control datetime" value="{{$slot['start_time']}}" required>
                                </div>
                                <div class="col-md-6  form-group {{ $errors->has('finish_time') ? 'has-error' : '' }}">
                                    <label for="finish_time">Finish Time*</label>
                                    <input type="text" id="finish_time" name="available_hr_finish_time[]" class="form-control datetime" value="{{$slot['finish_time']}}" required>
                                </div>
                            </div>
                                    @if($k > 0)
                                        <span><a class="btn btn-danger mb-1 text-right" onclick="removeSlot($k)">Remove</a>
                                    @endif
                                <hr>
                            @endforeach
                    </div>
                
                <div class="mb-2 text-right">
                    <input class="btn btn-success" onclick="addSlot()" type="button" value="Add slot">
                </div>
         
                <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                    <label for="services">Location
                        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                    <select name="service" id="services" class="form-control select2">
                        @foreach($services as $id => $services)
                            <option value="{{ $id }}" {{  old('service', isset($appointment) && $appointment->services->contains($id)) ? 'selected' : '' }}>{{ $services }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('services'))
                        <em class="invalid-feedback">
                            {{ $errors->first('services') }}
                        </em>
                    @endif
                </div>
            <div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')
    <script>
        function addSlot(){
        let count = $(".slot-div").length + 1
            html = `<div class="d-flex row m-1  slot-div slot_${count}" style="border-style: outset;">
                        <div class="col-md-6 form-group">
                            <label for="start_time">Start Time</label>
                            <input type="text" id="" name="available_hr_start_time[]" class="form-control datetime" value="" required>
                        </div>
                        <div class="col-md-6  form-group">
                            <label for="finish_time">Finish Time</label>
                            <input type="text" id="" name="available_hr_finish_time[]" class="form-control datetime" value="" required>
                        </div>
                        <span><a class="btn btn-danger mb-1 text-right" onclick="removeSlot(${count})">Remove</a>
                    </div><hr class="slot_${count}">`;
                
                $('#slot-container').append(html)
        }
        function removeSlot(count){
            $(`.slot_${count}`).remove()
        }
            $(document).on('focus', '.datetime', function(){
                $(this).datetimepicker({
                    format: 'YYYY-MM-DD HH:mm',
                    locale: 'en',
                    sideBySide: true,
                    stepping: 15
                })
            });

    </script>
@endsection