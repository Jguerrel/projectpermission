<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
      <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="mb-0">Subir Factura</h4>
                            </div>
                                    <div class="card-body">
                                        <form action="{{ route('uploadinvoice.file') }}" method="POST" enctype="multipart/form-data"
                                            class="dropzone" id="file-Upload">
                                            @csrf
                                        </form>
                                        <h5 id="message"></h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>

    Dropzone.options.fileUpload = {
                dictDefaultMessage: "Arrastra tus archivos aquí para cargarlos",
                dictInvalidFileType: "No puedes subir archivos de este tipo.",
                dictFallbackMessage: "Tu navegador no soporta la carga de archivos mediante arrastrar y soltar.",
                maxFilesize : 2,
                maxFiles: 1,
                dictFileTooBig: "El archivo es demasiado grande MiB. Máximo permitido: 2 MiB.",

                acceptedFiles: ".jpeg,.jpg,.png,.pdf", // Tipos de archivo permitidos
                success: function (file, response) {

                    $("#invoicepath").val(response.file_path);
                    Swal.fire({
                    title: "OK!",
                    text: "¡Archivo subido correctamente!",
                    icon: "success"
                    });

                },
                error: function (file, response) {

                    Swal.fire({
                    title: "NoOK!",
                    text: response,
                    icon: "error"
                    });

                }
            };

</script>
