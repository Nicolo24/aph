<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $reporttype->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $reporttype->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_operative') }}
            {{ Form::select('is_operative', [0=>'NO',1=>'SI'], $reporttype->is_operative, ['class' => 'form-control' . ($errors->has('is_operative') ? ' is-invalid' : ''), 'placeholder' => 'Operativo']) }}
            {!! $errors->first('is_operative', '<div class="invalid-feedback">:message</div>') !!}
            <div class="form-group">
                {{ Form::label('in_emergency') }}
                {{ Form::select('in_emergency', [0=>'NO',1=>'SI'], $reporttype->in_emergency, ['class' => 'form-control' . ($errors->has('in_emergency') ? ' is-invalid' : ''), 'placeholder' => 'En Emergencia']) }}
                {!! $errors->first('in_emergency', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('icon')}}
            {{ Form::text('icon', $reporttype->icon, ['class' => 'form-control' . ($errors->has('icon') ? ' is-invalid' : ''), 'placeholder' => 'Icon']) }}
            {!! $errors->first('icon', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>