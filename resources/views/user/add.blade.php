<div class="row">
    <div class="col-lg">
        <div class="form-group">
            <label class="control-label">Username </label>
            <input class="form-control form-control-sm" type="text" id="username">
        </div>
        <div class="form-group">
            <label class="control-label">Name </label>
            <input class="form-control form-control-sm" type="text" id="name">
        </div>
        <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control form-control-sm" type="text" id="email">
        </div>
    </div>
    <div class="col-lg">
        <div class="form-group">
            <label class="control-label">Role </label>
            <select class="form-select form-select-sm autocomplete" id="role_id">
                <option value="">--  Selected --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>