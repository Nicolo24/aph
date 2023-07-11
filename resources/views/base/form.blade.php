<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('centro') }}

            <div>
                <select id="center_id" class="form-control @error('center_id') is-invalid @enderror" name="center_id" required>
                    @foreach (\App\Models\Center::all() as $center)
                        <option value="{{ $center->id }}" {{ ($base->center_id ?? Auth::user()->center_id) == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
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
                <select id="province_id" class="form-control @error('province_id') is-invalid @enderror" name="province_id" required>
                    @foreach (\App\Models\Province::all() as $province)
                        <option value="{{ $province->id }}" {{ ($base->province_id ?? Auth::user()->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
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
                <select id="zone_id" class="form-control @error('province_id') is-invalid @enderror" name="zone_id" required>
                    @foreach (\App\Models\Zone::all() as $zone)
                        <option value="{{ $zone->id }}" {{ ($base->zone_id ?? Auth::user()->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
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
                <select id="institution_id" class="form-control @error('institution_id') is-invalid @enderror" name="institution_id" required>
                    @foreach (\App\Models\Institution::all() as $institution)
                        <option value="{{ $institution->id }}" {{ ($base->institution_id ?? Auth::user()->institution_id) == $institution->id ? 'selected' : '' }}>{{ $institution->name }}</option>
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
            {{ Form::label('Tipo de base') }}

            <div>
                <select id="basetype_id" class="form-control @error('basetype') is-invalid @enderror" name="basetype_id" required>
                    @foreach (\App\Models\Basetype::all() as $basetype)
                        <option value="{{ $basetype->id }}" {{ $base->basetype_id == $basetype->id ? 'selected' : '' }}>{{ $basetype->name }}</option>
                    @endforeach
                </select>

                @error('basetype')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('search', 'Buscar') }}
            {{ Form::text('search', $base->name, ['id' => 'search', 'class' => 'form-control', 'placeholder' => 'Ingresa una dirección']) }}

            <button type='button' id="search-button" class='btn btn-primary'>Buscar</button>
        </div>

        <div class="form-group">
            {{ Form::label('place', 'Lugar') }}
            <select id="places-select" class='form-control'></select>
        </div>

        <div class="form-group">
            {{ Form::label('name', 'Nombre') }}
            {{ Form::text('name', $base->name, ['id' => 'name', 'class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        </div>

        <div class="form-group">
            {{ Form::label('latitude', 'Latitud') }}
            {{ Form::text('latitude', $base->latitude, ['id' => 'latitude', 'class' => 'form-control' . ($errors->has('latitude') ? ' is-invalid' : ''), 'placeholder' => 'Latitude']) }}
        </div>

        <div class="form-group">
            {{ Form::label('longitude', 'Longitud') }}
            {{ Form::text('longitude', $base->longitude, ['id' => 'longitude', 'class' => 'form-control' . ($errors->has('longitude') ? ' is-invalid' : ''), 'placeholder' => 'Longitude']) }}
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            const searchInput = document.getElementById('search');
            const searchButton = document.getElementById('search-button');
            const placesSelect = document.getElementById('places-select');
            const nameInput = document.getElementById('name');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');

            searchButton.addEventListener('click', () => {
                const query = searchInput.value;
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route('items.index') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': token
                        },
                        body: JSON.stringify({
                            query: query
                        })
                    })
                    .then(response => response.json())
                    .then(items => {
                        placesSelect.innerHTML = '';
                        const option = document.createElement('option');
                        option.value = 'Select a place';
                        option.text = 'Select a place';
                        option.setAttribute('data-name', '');
                        option.setAttribute('data-latitude', '');
                        option.setAttribute('data-longitude', '');
                        placesSelect.appendChild(option);

                        items.results.forEach((item) => {
                            const option = document.createElement('option');
                            option.value = item.place_id;
                            option.text = item.name + ' (' + item.formatted_address + ')';
                            option.setAttribute('data-name', item.name);
                            option.setAttribute('data-latitude', item.geometry.location.lat);
                            option.setAttribute('data-longitude', item.geometry.location.lng);
                            placesSelect.appendChild(option);
                        });
                    });
            });

            placesSelect.addEventListener('change', () => {
                const placeOption = placesSelect.options[placesSelect.selectedIndex];
                nameInput.value = placeOption.getAttribute('data-name');
                latitudeInput.value = placeOption.getAttribute('data-latitude');
                longitudeInput.value = placeOption.getAttribute('data-longitude');
            });
        </script>

        <div class="form-group">
            {{ Form::label('Comentario') }}
            {{ Form::text('comment', $base->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Activo') }}
            <select name="is_active" id="is_active" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}

        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
