<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('resource_id') }}
            {{ Form::text('resource_id', $assignation->resource_id, ['class' => 'form-control' . ($errors->has('resource_id') ? ' is-invalid' : ''), 'placeholder' => 'Resource Id']) }}
            {!! $errors->first('resource_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('base_id') }}
            {{ Form::text('base_id', $assignation->base_id, ['class' => 'form-control' . ($errors->has('base_id') ? ' is-invalid' : ''), 'placeholder' => 'Base Id']) }}
            {!! $errors->first('base_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $assignation->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_active') }}
            {{ Form::text('is_active', $assignation->is_active, ['class' => 'form-control' . ($errors->has('is_active') ? ' is-invalid' : ''), 'placeholder' => 'Is Active']) }}
            {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>