<div class="modal fade" id="book-import-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Belum punya file template? <a href="/templates/SIP - Book Import Template.xlsx"
                        target="_blank">Download disini</a>
                </p>

                <form action="{{ route('books.import') }}" id="book-import-form" method="POST"
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
                <button type="button" onclick="onSubmitImport()" class="btn btn-primary">Import</button>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Handle on click import button, show swal confirm then submit
     **/
    const onSubmitImport = async () => {
        const {
            isConfirmed
        } = await Swal.fire({
            title: 'Apakah Anda yakin untuk mengimport data ini?',
            text: 'Pastikan data yang diimport benar',
            icon: 'warning',
            showCancelButton: true,
        })

        if (!isConfirmed) return;

        const form = document.getElementById('book-import-form')
        form.submit();
    }

    /**
     * On change file
     * @param {object} event
     **/
    const onChangeFile = (event) => {
        const file = event.target.files[0];

        // Only accept xlsx
        if (file.type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            Swal.fire({
                icon: 'error',
                title: 'File tidak valid',
                text: 'Hanya file .xlsx yang diizinkan',
            });
            event.target.value = '';
            return;
        }
    }
</script>
