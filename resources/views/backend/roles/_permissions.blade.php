@php
    use Illuminate\Support\Str;
@endphp

<div class="accordion" id="permissionsAccordion">
    @php
        $accordionId = isset($title) ? Str::slug($title) : 'permissionHeading';
    @endphp

    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-{{ $accordionId }}">
            <button class="accordion-button {{ ($closed ?? false) ? 'collapsed' : '' }}" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapse-{{ $accordionId }}" 
                    aria-expanded="{{ ($closed ?? false) ? 'false' : 'true' }}" 
                    aria-controls="collapse-{{ $accordionId }}">
                {{ $title ?? 'Override Permissions' }}
                @if(isset($user))
                    <span class="text-danger">({{ $user->getDirectPermissions()->count() }})</span>
                @endif
            </button>
        </h2>

        <div id="collapse-{{ $accordionId }}" 
             class="accordion-collapse collapse {{ ($closed ?? false) ? '' : 'show' }}" 
             aria-labelledby="heading-{{ $accordionId }}" 
             data-bs-parent="#permissionsAccordion">
            <div class="accordion-body">
                <div class="row">
                    @forelse($permissions as $permission)
                        @php
                            $per_found = false;
                            if(isset($role) && $role->hasPermissionTo($permission->name)) {
                                $per_found = true;
                            }
                            if(isset($user) && $user->hasDirectPermission($permission->name)) {
                                $per_found = true;
                            }

                            // Determine additional HTML attributes
                            $htmlOptions = '';
                            if(isset($options) && is_array($options)) {
                                foreach($options as $attr => $val) {
                                    $htmlOptions .= " {$attr}=\"{$val}\"";
                                }
                            }
                        @endphp

                        <div class="col-md-3 mb-2">
                            <div class="form-check text-capitalize">
                                <input class="form-check-input {{ str_contains($permission->name, 'delete') ? 'text-danger' : '' }}" 
                                       type="checkbox" 
                                       name="permissions[]" 
                                       value="{{ $permission->name }}" 
                                       id="perm-{{ Str::slug($permission->name) }}"
                                       {{ $per_found ? 'checked' : '' }}
                                       {!! $htmlOptions !!}>
                                <label class="form-check-label" for="perm-{{ Str::slug($permission->name) }}">
                                    {{ str_replace('_', ' ', $permission->name) }}
                                </label>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No permissions available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>