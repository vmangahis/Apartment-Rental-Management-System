<script type = "text/javascript">
    $(document).ready(() => {




        $('.log-out').on('click' , e => {
            console.log('logged out');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "GET",
                url: "/logout",
                success: () => {
                    window.location.href="/login"
                }

            });
        })



    })









</script>
