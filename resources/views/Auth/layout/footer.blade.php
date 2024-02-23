<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {
        // Handle image selection
        $('.img-thumbnail').click(function() {
            var gambarUrl = $(this).attr('src');
            $('#imageInput').val(gambarUrl);
            $('#selectedImage').attr('src', gambarUrl);
            $('#selectedImage').removeAttr('style');
            $('#imageModal').modal('hide');
        });

        // Handle custom image selection from file input
        $('#customImageInput').change(function() {
            var fileInput = $(this)[0];
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var gambarUrl = e.target.result;
                    $('#imageInput').val(
                        gambarUrl);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        // Handle form submission
        $('form').submit(function() {
            var gambarUrl = $('#imageInput').val();
            $('<input>').attr({
                type: 'hidden',
                name: 'gambar',
                value: gambarUrl
            }).appendTo('form');
        });
    });
</script>


{{-- JS Login --}}
<script>
    function myMenuFunction() {
        var i = document.getElementById("navMenu");

        if (i.className === "nav-menu") {
            i.className += " responsive";
        } else {
            i.className = "nav-menu";
        }
    }
</script>

<script>
    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }
</script>

</body>

</html>
