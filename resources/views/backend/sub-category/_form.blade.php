<div class="sub-category">
    <div class="form-group{{ $errors->has('category_id.*') ? ' has-error' : '' }} clearfix">
        {!! Form::label('category_id', 'Select Category', ['class' => 'col-md-4 control-label']) !!}

        <div class="col-md-6">
            {!! Form::select('category_id[]', $categories, null,['id'=>'category_id', 'class' => 'form-control', 'placeholder' => 'Select the category']) !!}

            @if ($errors->has('category_id.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_id.*') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('title.*') ? ' has-error' : '' }} clearfix ">
        {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}

        <div class="col-md-6">
            {!! Form::text('title[]', null, ['class' => 'form-control title' ]) !!}

            @if ($errors->has('title.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('title.*') }}</strong>
                </span>
            @endif
        </div>
        <button class="btn btn-default" onclick="remove_field()" id="remove-btn">Remove</button>
    </div>

    <div class="form-group{{ $errors->has('status.*') ? ' has-error' : '' }} clearfix">
        {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label ']) !!}

        <div class="col-md-6">
            {!! Form::hidden('stat[]', 0, ['class'=>'stat']) !!}
            {!! Form::checkbox('status[]', 0, 1, ['class' => 'status']) !!}

            @if ($errors->has('status.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('status.*') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>    
@if(\Route::current()->getName() != 'sub-categories.edit')
    <div>
        <div class="col-md-4"></div>
        <div class="col-md-6">
            <button onclick="javascript:add_field()" class="btn btn-default">Add</button>
        </div>
        <br>
    </div>
@endif    
