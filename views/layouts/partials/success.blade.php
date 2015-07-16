@if (Session::has('flash_notification.message'))
        <div class="alert alert-{{ Session::get('flash_notification.level') }} fade in alert-slideup">
            <b>{{ Session::pull('flash_notification.message') }}</b>
        </div>
@endif
