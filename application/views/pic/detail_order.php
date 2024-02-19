<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('templates/head.php') ?>
</head>

<body id="page-top">
    <div class="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('templates/sidebar.php') ?>
        <div class="content-wrapper" class="d-flex flex-column">
            <div class="content">
                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800">Detail List Order</h1>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <?php if ($detail_order[0]->wbs == '0') : ?>
                                    <div class="card-header">
                                        <div style="width: fit-content;" class="bg-danger bg-gradient rounded-pill text-white px-2"><strong>Rejected</strong></div>
                                    </div>
                                <?php elseif ($detail_order[0]->wbs == NULL) : ?>
                                    <div class="card-header">
                                        <div style="width: fit-content;" class="bg-warning bg-gradient rounded-pill text-white px-2"><strong>Waiting</strong></div>
                                    </div>
                                <?php else : ?>
                                    <div class="card-header">
                                        <div style="width: fit-content;" class="bg-success bg-gradient rounded-pill text-white px-2"><strong>Approved</strong></div>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <form action="<?= base_url('pic/list_order/approve') ?>" id="form-tambah" method="POST">
                                        <h5>Data Karyawan</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label>ID Order</label>
                                                <input type="text" name="id_order" id="id_order" value="<?= $list_order[0]->id_order ?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-2">
                                                <label>Tanggal Order</label>
                                                <input type="text" name="tgl_order" value="<?= $list_order[0]->tgl_order ?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>NRP</label>
                                                <input type="text" name="nrp" value="<?= $list_order[0]->creaby ?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Nama Karyawan</label>
                                                <input type="text" name="nama_karyawan" value="<?= $list_order[0]->nama_karyawan ?>" readonly class="form-control">
                                            </div>
                                        </div>

                                        <!-- Button tambah -->

                                        <div class="detailData">
                                            <h5>Detail Order</h5>
                                            <hr>
                                            <table class="table table-bordered" id="tableDetail">
                                                <thead>
                                                    <tr>
                                                        <td width="5%">No</td>
                                                        <td width="20%">Part Number</td>
                                                        <td width="35%">Deskripsi</td>
                                                        <td width="10%">Jumlah</td>
                                                        <td width="10%">Satuan</td>
                                                        <td width="20%">WBS</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1;
                                                    foreach ($detail_order as $key => $detail) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i ?></td>
                                                            <td>
                                                                <select name="part_number[]" id="part_number-<?= $i ?>" class="form-control" onchange="setDetail(this.value, <?= $i ?>)" required readonly>
                                                                    <option selected="true" disabled="disabled">Pilih Spare Part</option>
                                                                    <?php foreach ($datasparepart as $sp) : ?>
                                                                        <option value="<?php echo $sp->part_number ?>" <?= $sp->part_number == $detail->part_number ? 'selected' : '' ?>><?php echo $sp->part_number ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="deskripsi[]" value="<?= $detail->deskripsi ?>" id="deskripsi-<?= $i ?>" class="form-control deskripsi" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="qty[]" value="<?= $detail->jumlah ?>" id="qty-<?= $i ?>" class="form-control qty" required="" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="satuan[]" value="<?= $detail->satuan ?>" id="satuan-<?= $i ?>" class="form-control" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="wbs[]" value="<?= $detail->wbs == 0 || $detail->wbs == NULL ? '' : $detail->wbs ?>" id="wbs-<?= $i ?>" class="form-control" required <?= $detail_order[0]->wbs == NULL ? '' : 'readonly' ?>>
                                                            </td>
                                                        </tr>
                                                    <?php $i++;
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" align="center">
                                                            <?php if ($detail_order[0]->wbs == NULL) : ?>
                                                                <button type="button" id="btn-approve" class="btn btn-success">Approve</button>
                                                                <button type="button" id="btn-reject" class="btn btn-danger">Reject</button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('templates/js.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function Alert(approve = true) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: "Tindakan tidak akan dapat diulangi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, saya yakin!',
                cancelButtonText: 'Tidak, Batalkan!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?php echo base_url(); ?>pic/list_order/${approve ? 'approve' : 'reject/<?= $list_order[0]->id_order ?>'}`,
                        method: `${approve ? 'POST' : 'GET'}`,
                        data: approve ? formDT() : {},
                        processData: false,
                        contentType: false,
                        success: () => {
                            Swal.fire({
                                title: `${approve ? 'Approved' : 'Rejected'}`,
                                text: `${approve ? 'Approve' : 'Reject'} Successfully.`,
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.href = '<?= base_url() ?>pic/list_order';
                                }
                            });
                        },
                        error: (error) => {
                            console.log(error);
                            for (var pair of formDT().entries()) {
                                console.log(pair[0] + ', ' + pair[1]);
                            }
                            swalWithBootstrapButtons.fire(
                                `Error`,
                                `Error: ${error}`,
                                'success'
                            );
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        '',
                        'error'
                    )
                }
            })
        }

        function formDT() {
            let fd = new FormData($('#form-tambah')[0]);
            return fd;
        }
        $(document).ready(function() {
            $('#btn-approve').click(function() {
                var wbsElements = document.querySelectorAll('input[name="wbs[]"]');
                var isEmptyValueFound = false;
                wbsElements.forEach(function(element) {
                    if (element.value.trim() === '') {
                        isEmptyValueFound = true;
                        element.focus();
                        return;
                    }
                });

                if (!isEmptyValueFound) {
                    Alert(true);
                }

            });

            $('#btn-reject').click(function() {
                Alert(false);
            });
        })
    </script>
</body>

</html>