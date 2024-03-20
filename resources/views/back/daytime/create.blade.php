@extends('back.layout.layout', [$title = 'Create Select Day and Time'])

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Add Day & Time</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            <li><a data-action="close"><i class="ft-x"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body">
          <form class="form" action="{{ route('day.time.store') }}" method="POST">
            @csrf
            <div class="form-body">
              <div class="form-group">
                <label for="chamber_id">Select Chamber</label>
                <select id="chamber_id" class="select2 form-control w-100" name="chamber_id">
                    @foreach ($chambers as $chamber)
                        <option value="{{ $chamber->id }}">{{ $chamber->chamber_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('chamber_id'))
                    <small class="text-danger">{{ $errors->first('chamber_id') }}</small>
                @endif
              </div>


              <div class="form-group">
                <label for="day">Day</label>
                <input type="text" id="day" class="form-control square {{ $errors->has('day') ? 'is-invalid' : ''}}" placeholder="Day" name="day">
                @if ($errors->has('day'))
                    <small class="text-danger">{{ $errors->first('day') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label for="time">Time</label>
                <input type="text" id="time" class="form-control square {{ $errors->has('time') ? 'is-invalid' : ''}}" placeholder="Time" name="time">
                @if ($errors->has('time'))
                    <small class="text-danger">{{ $errors->first('time') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="{{ STATUS_ACTIVE }}">Public</option>
                    <option value="{{ STATUS_INACTIVE }}">Save Draft</option>
                </select>
              </div>

              
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="margin-right: 5px; ">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              <button type="button" type="reset" class="btn btn-warning">
                <i class="ft-x"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection