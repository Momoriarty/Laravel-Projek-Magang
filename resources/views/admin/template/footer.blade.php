</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
@if ($errors->any())
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast align-items-center text-white bg-danger shadow-lg rounded-3" role="alert" aria-live="assertive"
            aria-atomic="true" data-delay="8000" style="width: 300px; height:auto;">
            <div class="d-flex">
                <div class="toast-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the toast
            var toastElement = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastElement);

            // Show the toast
            toast.show();
        });
    </script>
@endif

@if (session('session'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast align-items-center text-white bg-{{ session('session_type') }} shadow-lg rounded-3"
            role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" style="width: 300px;">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('session') }}
                </div>
                {{-- <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close">&times;</button> --}}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the toast
            var toastElement = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastElement);

            // Show the toast
            toast.show();
        });
    </script>
@endif



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@include('admin.template.asset.js')

</body>

</html>
