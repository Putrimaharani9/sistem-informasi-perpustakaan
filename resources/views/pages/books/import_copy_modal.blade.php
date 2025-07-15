<div class="modal fade" id="book-copy-import-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Salinan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Belum punya file template? <a href="/templates/SIP - Book Copy Import Template.xlsx"
                        target="_blank">Download disini</a>
                </p>

                <form action="{{ route('book-copies.import') }}" id="book-copy-import-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">File (.xlsx)</label>
                        <input onchange="onChangeFile(event)" type="file" class="form-control-file" id="file"
                            name="file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" onclick="onSubmitImportCopy()" class="btn btn-primary">Import</button>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Handle on click import button, show swal confirm then submit
     **/
    const onSubmitImportCopy = async () => {
        const {
            isConfirmed
        } = await Swal.fire({
            title: 'Apakah Anda yakin untuk mengimport data ini?',
            text: 'Pastikan data yang diimport benar',
            icon: 'warning',
            showCancelButton: true,
        })

        if (!isConfirmed) return;

        const form = document.getElementById('book-copy-import-form')
        form.submit();
    }
</script>
