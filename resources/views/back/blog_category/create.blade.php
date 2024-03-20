@extends('back.layout.layout', [$title = 'Create a blog category'])


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Create a blog category</h4>
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
          <form class="form" action="{{ route('blog.category.store') }}" method="POST">
            @csrf
            <div class="form-body">
              <div class="form-group">
                <label for="name">Category Title</label>
                <input type="text" id="name" class="form-control square {{ $errors->has('title') ? 'is-invalid' : ''}} " placeholder="Title" name="title">
                @if ($errors->has('title'))
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                @endif
              </div>

              <fieldset class="form-group">
                <label for="seo_meta">SEO Meta (optional)</label>
                <textarea id="seo_meta" rows="5" class="form-control" name="seo_meta" placeholder="SEO Meta"></textarea>
                @if($errors->has('seo_meta'))
                <small class="text-danger">{{ $errors->first('seo_meta') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="head_script">Head Script (optional)</label>
                <textarea id="head_script" rows="5" class="form-control" name="head_script" placeholder="Head Script"></textarea>
                @if($errors->has('head_script'))
                <small class="text-danger">{{ $errors->first('head_script') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="body_script">Body Script (optional)</label>
                <textarea id="body_script" rows="5" class="form-control" name="body_script" placeholder="Body Script"></textarea>
                @if($errors->has('body_script'))
                <small class="text-danger">{{ $errors->first('body_script') }}</small>
                @endif
              </fieldset>
                            
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