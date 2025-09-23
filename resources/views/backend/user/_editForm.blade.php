<div class="row">
    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }} clearfix ">
            <label for="name" class="form-label">Name</label>

             <input type="text" required name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
            <label for="email" class="form-label">Email</label>

            @if(Auth::user()->id == $user->id || Auth::user()->hasRole('admin'))
                <input type="email" required name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control">
            @else
                <input type="email" required name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" disabled>
            @endif

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

@if( Route::currentRouteName() == 'users.edit')
    @hasrole('admin')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group required {{ $errors->has('role') ? ' has-error' : '' }} clearfix ">
                   <label for="role" class="form-label">Role</label>

                    <select name = "role" class="form-control">
                        <option disabled selected>Please select an option</option>
                        @foreach($roles as $role)
                            @if(isset($user->role_id))
                                <option value = "{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>
                                    {{$role->display_name}}
                                </option>
                            @elseif(old('role') != null)
                                <option value = "{{ $role->id }}" @if($role->id == old('role')) selected @endif>
                                    {{$role->display_name}}
                                </option>
                            @else
                                <option value = "{{ $role->id }}">
                                    {{$role->display_name}}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endhasrole
@endif
<div class="card-footer">
    <button type="submit" class="btn btn-success save">Update</button>
</div>