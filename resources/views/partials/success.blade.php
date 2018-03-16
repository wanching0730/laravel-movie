@if (session()->has('success'))
    <div class="alert alert-dismissable alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span> 
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>

        <script>

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);

        </script>
    </div> 
@endif 
