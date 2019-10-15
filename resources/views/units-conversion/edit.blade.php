@extends('layouts.unit')
@section('content')

    <div class="card card-default">
        <div class="card-header">Edit Unit Conversion</div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ route('units-conversion.update', $unitConversion->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="from_code">Unit Type</label>
                    <select name="from_code" id="from_code" class="form-control">
                        @foreach($unitsType as $unitType)
                            <option value="{{ $unitType->id }}" @if($unitType->id==$unitConversion->type_id) selected @endif>{{ $unitType->name }}</option>
                        @endforeach
                    </select>
                    <script>
                        function selecttype(obj){
                            var agrs = {
                                url: "{{ route('ajaxEdit') }}",
                                type: "post",
                                dataType: "text",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: obj.value,

                                },
                                success: function (result) {
                                    $('#form-edit').html(result);
                                }
                            };
                            $.ajax(agrs);
                        };
                    </script>
                </div>
                <div id="form-edit">
                    <div class="form-group">
                        <label for="from_code">From Code</label>
                        <select name="from_code" id="from_code" class="form-control" onchange="selecttype(this)">
                            @foreach($units as $unit)
                                <option value="{{ $unit->symbol }}" @if($unit->symbol==$unitConversion->from_code) selected @endif>{{ $unit->symbol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="to_code">To Code</label>
                        <select name="to_code" id="to_code" class="form-control">
                            @foreach($units as $unit)
                                <option value="{{ $unit->symbol }}" @if($unit->symbol==$unitConversion->to_code) selected @endif>{{ $unit->symbol }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="text" id="value" name="value" class="form-control" value="{{ $unitConversion->value }}">
                </div>
                <div class="form-group">
                    <label for="checksum">Checksum</label>
                    <input type="text" id="checksum" name="checksum" class="form-control" value="{{ $unitConversion->checksum }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
