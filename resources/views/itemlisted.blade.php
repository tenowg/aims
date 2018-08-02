@component('layouts.master')
    @slot('title')
        Thanks
    @endslot

    <div>
        <aims-sidebar></aims-sidebar>
        <h1>Your item has been Posted</h1>

        <p>Your item(s) have been posted, and will be be available on the market in a few minutes. Once listed they will be available for 3 days. After the 3 days they will be removed from the market unless they are renewed.</p>
    </div>
@endcomponent