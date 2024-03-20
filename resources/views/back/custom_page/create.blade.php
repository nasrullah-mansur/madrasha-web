@extends('back.layout.layout', [$title = 'Create Page']);


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Create Page</h4>
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
          <form class="form" action="{{ route('custom.page.store') }}" method="POST" >
            @csrf
            <div class="form-body">
              <div class="form-group">
                <label for="name">Page Name</label>
                <input type="text" id="name" class="form-control square {{ $errors->has('name') ? 'is-invalid' : ''}} " placeholder="Page ID" name="name">
                @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
              </div>

              <fieldset class="form-group">
                <label for="content">Page Content</label>
                <textarea id="content" rows="5" class="form-control summernote" name="content" placeholder="Page Content"></textarea>
                @if($errors->has('content'))
                <small class="text-danger">{{ $errors->first('content') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="css">Custom CSS</label>
                <textarea id="css" rows="5" class="form-control" name="css" placeholder="Page CSS"></textarea>
                @if($errors->has('css'))
                <small class="text-danger">{{ $errors->first('css') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="js">Custom JavaScript</label>
                <textarea id="js" rows="5" class="form-control" name="js" placeholder="Page JavaScript"></textarea>
                @if($errors->has('js'))
                <small class="text-danger">{{ $errors->first('js') }}</small>
                @endif
              </fieldset>
                            
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="margin-right: 5px; ">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              <button type="reset" class="btn btn-warning">
                <i class="ft-x"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection