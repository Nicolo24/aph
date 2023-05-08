<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('center') }}

            <div>
                <select id="center_id" class="form-control @error('center_id') is-invalid @enderror" name="center_id"
                    required>
                    @foreach (\App\Models\Center::all() as $center)
                        <option value="{{ $center->id }}" {{ ($resource->center_id ?? Auth::user()->center_id) ? 'selected' : ''}}>{{ $center->name }}</option>
                    @endforeach
                </select>

                @error('center_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('province') }}

            <div>
                <select id="province_id" class="form-control @error('province_id') is-invalid @enderror"
                    name="province_id" required>
                    @foreach (\App\Models\Province::all() as $province)
                        <option value="{{ $province->id }}" {{($resource->province_id ?? Auth::user()->province_id) == $province->id ? 'selected' : ''}} >{{ $province->name }}</option>
                    @endforeach
                </select>

                @error('province_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('zone') }}

            <div>
                <select id="zone_id" class="form-control @error('province_id') is-invalid @enderror" name="zone_id"
                    required>
                    @foreach (\App\Models\Zone::all() as $zone)
                        <option value="{{ $zone->id }}" {{ ($resource->zone_id ?? Auth::user()->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
                    @endforeach
                </select>

                @error('zone_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('institution') }}

            <div>
                <select id="institution_id" class="form-control @error('institution_id') is-invalid @enderror"
                    name="institution_id" required>
                    @foreach (\App\Models\Institution::all() as $institution)
                        <option value="{{ $institution->id }}" {{($resource->institution_id ?? Auth::user()->institution_id) == $institution->id ? 'selected' : ''}}>{{ $institution->name }}</option>
                    @endforeach
                </select>

                @error('institution_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('resource type') }}

            <div>
                <select id="resourcetype_id" class="form-control @error('basetype') is-invalid @enderror" name="resourcetype_id"
                    required>
                    @foreach (\App\Models\Resourcetype::all() as $resourcetype)
                        <option value="{{ $resourcetype->id }}" {{$resource->resourcetype_id == $resourcetype->id ? 'selected' : ''}} >{{ $resourcetype->name }}</option>
                    @endforeach
                </select>

                @error('resourcetype')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $resource->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comment') }}
            {{ Form::text('comment', $resource->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_active') }}
            <select name="is_active" id="is_active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}

        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>