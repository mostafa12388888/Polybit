<div>
    <div id="fb-root"></div>
    <div class="fb-comments commentsdark" data-colorscheme="dark" data-href="{{ request()->url() }}" data-width="100%" data-numposts="5"></div>
    
    @assets
        <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&autoLogAppEvents=1&version=v5.0"></script>
    @endassets
</div>
