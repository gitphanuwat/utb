<form action="{{ url('/profile/changepass') }}" method="POST">
    <input name="_method" type="hidden" value="PUT" />
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

    <!-- Old Password -->
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">
                <strong>
                    *รหัสผ่านเดิม
                </strong>
            </div>
            <input type="password" name="old_password" placeholder="รหัสผ่านเดิม" class="form-control" />
        </div>
    </div>

    <!-- New password -->
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">
                <strong>
                    *รหัสผ่านใหม่
                </strong>
            </div>
            <input type="password" name="new_password" placeholder="รหัสผ่านใหม่" class="form-control" />
        </div>
    </div>

    <!-- New password again -->
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">
                <strong>
                    *ยืนยันรหัสผ่านใหม่อีกครั้ง
                </strong>
            </div>
            <input type="password" name="new_password_confirmation" placeholder="ยืนยันรหัสผ่านใหม่" class="form-control" />
        </div>
    </div>

    <hr />

    <!-- Button -->
    <div class="form-group">
        <input type="submit" value="บันทึก" class="btn btn-primary" />
    </div>


</form>
