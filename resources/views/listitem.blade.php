@component('layouts.master')
    @slot('title')
        List Item
    @endslot
    <div>
        <aims-sidebar></aims-sidebar>
        @component('forms.edititem')
        @endcomponent
    </div>
@endcomponent