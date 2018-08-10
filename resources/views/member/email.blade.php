<form action="{{ url('/profile/change') }}" method='POST'>
    <input name="_method" type="hidden" value="PUT" />
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

    <!-- Email -->
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">
                <strong>
                    *อีเมล์
                </strong>
            </div>
            <input type="email" name="email" placeholder="your_email@domain.com" value="{{ Auth::user()->email }}" class="form-control" />
        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <input type="submit" value="บันทึก" class="btn btn-primary" />
    </div>
</form>
