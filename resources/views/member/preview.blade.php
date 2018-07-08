<div class="row">
    @if(1)
        <div class="col-sm-6">
            @if (Auth::user()->picture)
                <img src="{{ asset('images/avatar/large/' . Auth::user()->picture) }}"
                     class="col-xs-12"/>
            @else
                <img src="{{ asset('images/no_image.png') }}" class="col-xs-12"/>
            @endif
        </div>
    @endif
    <div class="col-sm-6">
        <p><strong>username: </strong>{{ Auth::user()->firstname }}</p>

        <p><strong>email: </strong>{{ Auth::user()->email }}</p>

        <p><strong>registered_at
                : </strong>{{ date('d M Y - H:i:s', strtotime(Auth::user()->created_at)) }}</p>

        <p><strong>updated_at
                : </strong>{{ date('d M Y - H:i:s', strtotime(Auth::user()->updated_at)) }}</p>

    </div>
</div>
<br/>
