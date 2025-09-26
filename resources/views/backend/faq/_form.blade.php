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

<div class="form-group required {{ $errors->has('faq') ? ' has-error' : '' }} clearfix ">
    <label for="faq" class="form-label">Faq</label>

    <input type="text" name="faq" value="{{ old('faq', $faq->faq ?? '') }}" class="form-control" required>

    @if ($errors->has('faq'))
        <span class="help-block">
            <strong>{{ $errors->first('faq') }}</strong>
        </span>
    @endif
</div>


<div class="form-group required {{ $errors->has('answer') ? ' has-error' : '' }} clearfix">
    <label for="answer" class="form-label">Answer</label>

    <textarea name="answer" class="form-control ckeditor" rows="5">{{ old('answer', $faq->answer ?? '') }}</textarea>

    @if ($errors->has('answer'))
        <span class="help-block">
            <strong>{{ $errors->first('answer') }}</strong>
        </span>
    @endif
</div>

<div class="form-group required {{ $errors->has('status') ? ' has-error' : '' }} clearfix ">
    <label for="status" class="form-label">Status</label>
    <div>
        <label class="switch">
            @if(isset($faq->status))
                <input type="checkbox" name="status" @if($faq->status == 1) checked @endif>
            @else
                <input type="checkbox" name="status" checked>
            @endif
            <span class="slider round"></span>
        </label>
    </div>
    
    @if ($errors->has('status'))
        <span class="help-block">
            <strong>{{ $errors->first('status') }}</strong>
        </span>
    @endif
</div>


