@component('layouts.master')
    @slot('title')
        Successfully added request.
    @endslot
    <aims-sidebar></aims-sidebar>
    <div class="container" style="width: 60vw">
        <h2>Successfully added Package</h2>
        <p>You hace Successfully added a package, it might take a few moments to process, please give it a moment and try to goto <a href="http://aims.eviannow.xyz/store/package/{{}}">Your package display</a> Don't forget to copy the link and paste it to discord chat so people buy your stuff.</p>
    </div>
@endcomponent