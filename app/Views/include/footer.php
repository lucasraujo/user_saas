

        <div class="modal" id="spinner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-spinner" role="document">
                <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100" >
                    <div class="modal-content rounded-circle spinner" style="width: 62px; height: 62px;">
                        <div class="modal-body d-flex justify-content-center p-0">
                            <div class="spinner-border" role="status" style="width:60px; height:60px; "></div>
                        </div>
                    </div>
                    <div class="text-center fs-4 fw-bold text-white texto-modal-spinner" style="background-color: rgba(0,0,0,0.5);padding: 0 10px;border-radius: 9px;"></div>
                </div>
            </div>
        </div>
        
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Lucas Araujo Martins 2025</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
	        <?= isset($css) ? $css : '' ?>
        </style>
        <script>
            <?= isset($js) ? $js : '' ?>
        </script>
    </body>
</html>