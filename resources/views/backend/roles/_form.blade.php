@if ($errors->any())
    <div class="callout callout-danger">
        <strong>Whoops!</strong> There were some problems with your input:
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }} clearfix">
            <label for="display_name" class="form-label">Display Name</label>

            <input type="text" name="display_name" value="{{ old('display_name', $role->display_name ?? '') }}" class="form-control">

            @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }} clearfix">
            <label for="name" class="form-label">Identifier (Used Internally)</label>

            @isset($role->name)
                <input type="text" name="name" value="{{$role->name}}" class="form-control" disabled>
            @else
                <input type="text" name="name" value="{{ old('name'?? '') }}" class="form-control">
            @endisset


            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} clearfix">
            <label for="description" class="form-label">Description</label>

            <textarea name="description" class="form-control" rows="3">{{ old('description', $role->description ?? '') }}</textarea>

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div> 
