<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('resource_id') }}
            {{ Form::text('resource_id', $report->resource_id, ['class' => 'form-control' . ($errors->has('resource_id') ? ' is-invalid' : ''), 'placeholder' => 'Resource']) }}
            {!! $errors->first('resource_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $report->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('reporttype_id') }}
            {{ Form::text('reporttype_id', $report->reporttype_id, ['class' => 'form-control' . ($errors->has('reporttype_id') ? ' is-invalid' : ''), 'placeholder' => 'Reporttype']) }}
            {!! $errors->first('reporttype_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class ="form-group">
            {{ Form::label('created_at') }}
            {{ Form::text('created_at', $report->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Created At']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Comentario') }}
            {{ Form::text('comment', $report->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comentario']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>