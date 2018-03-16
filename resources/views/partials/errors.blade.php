@if(isset($errors)&&count($errors) > 0)
    <div class="alert alert-dismissable alert-danger" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> 

        @foreach ($errors->all() as $error)
            <li><strong>{!! $error !!}</strong></li> 
        @endforeach 

        <script>

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);

        </script>

    </div>
@endif