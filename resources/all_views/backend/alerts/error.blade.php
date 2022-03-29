 @if(\Session::has('error'))
        <div class="alert alert-danger background-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i class="icofont icofont-close-line-circled text-white"></i> </button>
            {{\Session::get('error')}}
        </div>
        @endif
