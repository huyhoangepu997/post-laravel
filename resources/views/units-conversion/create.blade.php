@extends('layouts.unit')
@section('content')
    <div class="card card-default">
        <div class="card-header">Create Unit Conversion</div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ route('units-conversion.store') }}" method="post">
                @csrf
                        <div class="form-group">
                            <label for="type_id">Unit Type</label>
                                <select name="type_id" id="type_id" class="form-control" onchange="selecttype(this)">
                                    <option value="2">--Chọn đại lượng--</option>
                                    @foreach($unitsType as $unitType)
                                        <option value="{{ $unitType->id }}">{{ $unitType->name }}</option>
                                    @endforeach
                                </select>
                            <div id="result"></div>

                            <script>
                        function selecttype(obj){
                            var agrs = {
                                url: "{{ route('ajaxCreate') }}",
                                type: "post",
                                dataType: "text",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: obj.value,

                                },
                                success: function (result) {
                                    $('#form-Create').html(result);
                                }
                            };
                            $.ajax(agrs);
                        };
                    </script>
                </div>
                <div id="form-Create">
                    <div class="form-group">
                        <label for="from_code">From Code</label>
                        <select name="from_code" id="from_code" class="form-control">
                            @foreach($units as $unit)
                                <option value="{{ $unit->type }}">{{ $unit->symbol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="to_code">To Code</label>
                        <select name="to_code" id="to_code" class="form-control">
                            @foreach($units as $unit)
                                <option value="{{ $unit->type }}">{{ $unit->symbol }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="text" id="value" name="value" class="form-control" value="1">
                </div>
                <div class="form-group">
                    <label for="checksum">Checksum</label>
                    <input type="text" id="checksum" name="checksum" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

