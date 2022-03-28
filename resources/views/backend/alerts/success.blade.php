 @if(\Session::has('success'))
        <div class="alert alert-success background-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled text-white"></i> </button>
            {{\Session::get('success')}}
        </div>
        @endif
