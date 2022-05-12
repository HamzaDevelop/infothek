<script src="{{asset('FrontEnd/js/jquery.min.js')}}"></script>
<script src="{{asset('FrontEnd/js/popper.js')}}"></script>
<script src="{{asset('FrontEnd/js/bootstrap.min.js')}}"></script>
<script src="{{asset('FrontEnd/js/main.js')}}"></script>
<script>
    $(function () {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('ul li a').each(function () {
            if (this.href === path) {
                $(this).addClass('active');
            }
        });
    });
</script>
<script>
    $(document).ready(function (){
       $(document).on('click','.getIdOfMainCategory',function (){
           let id = this.id
       });
    });
</script>
