<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('centro') }}

            <div>
                <select id="center_id" class="form-control @error('center_id') is-invalid @enderror" name="center_id"
                    required>
                    @foreach (\App\Models\Center::all() as $center)
                        <option value="{{ $center->id }}" {{ $user->center_id == $center->id ? 'selected' : '' }}>
                            {{ $center->name }}</option>
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
            {{ Form::label('provincia') }}

            <div>
                <select id="province_id" class="form-control @error('province_id') is-invalid @enderror"
                    name="province_id" required>
                    @foreach (\App\Models\Province::all() as $province)
                        <option value="{{ $province->id }}" {{ $user->province_id == $province->id ? 'selected' : '' }}>
                            {{ $province->name }}</option>
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
            {{ Form::label('zona') }}

            <div>
                <select id="zone_id" class="form-control @error('province_id') is-invalid @enderror" name="zone_id"
                    required>
                    @foreach (\App\Models\Zone::all() as $zone)
                        <option value="{{ $zone->id }}" {{ $user->zone_id == $zone->id ? 'selected' : '' }}>
                            {{ $zone->name }}</option>
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
            {{ Form::label('institución') }}

            <div>
                <select id="institution_id" class="form-control @error('institution_id') is-invalid @enderror"
                    name="institution_id" required>
                    @foreach (\App\Models\Institution::all() as $institution)
                        <option value="{{ $institution->id }}"
                            {{ $user->institution_id == $institution->id ? 'selected' : '' }}>{{ $institution->name }}
                        </option>
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
            {{ Form::label('Tipo de usuario') }}

            <div>
                <select id="usertype_id" class="form-control @error('usertype') is-invalid @enderror" name="usertype_id"
                    required>
                    @foreach (\App\Models\Usertype::all() as $usertype)
                        <option value="{{ $usertype->id }}"
                            {{ $user->usertype_id == $usertype->id ? 'selected' : '' }}>{{ $usertype->name }}</option>
                    @endforeach
                </select>

                @error('usertype')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('Recurso') }}
            <div>
                <select id="resource_id" class="form-control @error('resource_id') is-invalid @enderror"
                    name="resource_id" required>
                    <option value=""></option>

                    @foreach (Auth::user()->resources as $resource)
                        <option value="{{ $resource->id }}"
                            {{ $user->resource_id == $resource->id ? 'selected' : '' }}>{{ $resource->name }}</option>
                    @endforeach
                </select>

                @error('resource_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Correo') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
