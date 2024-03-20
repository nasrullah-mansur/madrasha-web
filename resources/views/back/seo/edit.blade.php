@extends('back.layout.layout', [$title = 'Edit SEO']);


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Edit SEO</h4>
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
          <form class="form" action="{{ route('page.seo.update', $seo->id) }}" method="POST">
            @csrf
            <div class="form-body">
              <div class="form-group">
                <label for="name">Page ID (Page Slug)</label>
                <input value="{{ $seo->page_id }}" type="text" id="name" class="form-control square {{ $errors->has('page_id') ? 'is-invalid' : ''}} " placeholder="Page ID" name="page_id">
                @if ($errors->has('page_id'))
                    <small class="text-danger">{{ $errors->first('page_id') }}</small>
                @endif
              </div>

              <fieldset class="form-group">
                <label for="custom_js">SEO Content (Meta Data)</label>
                <textarea id="custom_js" rows="5" class="form-control" name="seo_content" placeholder="Meta Content">{{ $seo->seo_content }}</textarea>
                @if($errors->has('seo_content'))
                <small class="text-danger">{{ $errors->first('seo_content') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="head_script">Head Script</label>
                <textarea id="head_script" rows="5" class="form-control" name="head_script" placeholder="Head Script">{{ $seo->head_script }}</textarea>
                @if($errors->has('head_script'))
                <small class="text-danger">{{ $errors->first('head_script') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="body_script">Body Script</label>
                <textarea id="body_script" rows="5" class="form-control" name="body_script" placeholder="Body Script">{{ $seo->body_script }}</textarea>
                @if($errors->has('body_script'))
                <small class="text-danger">{{ $errors->first('body_script') }}</small>
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