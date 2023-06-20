<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('route_id') }}
            {{ Form::text('route_id', $location->route_id, ['class' => 'form-control' . ($errors->has('route_id') ? ' is-invalid' : ''), 'placeholder' => 'Route']) }}
            {!! $errors->first('route_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('latitude') }}
            {{ Form::text('latitude', $location->latitude, ['class' => 'form-control' . ($errors->has('latitude') ? ' is-invalid' : ''), 'placeholder' => 'Latitude']) }}
            {!! $errors->first('latitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('longitude') }}
            {{ Form::text('longitude', $location->longitude, ['class' => 'form-control' . ($errors->has('longitude') ? ' is-invalid' : ''), 'placeholder' => 'Longitude']) }}
            {!! $errors->first('longitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('timestamp') }}
            {{ Form::text('timestamp', $location->timestamp, ['class' => 'form-control' . ($errors->has('timestamp') ? ' is-invalid' : ''), 'placeholder' => 'Timestamp']) }}
            {!! $errors->first('timestamp', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>