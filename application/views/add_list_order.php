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
                            <h1 class="h3 m-0 text-gray-800">Form List Order</h1>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('list_order/proses_tambah') ?>" id="form-tambah" method="POST">
                                        <h5>Data Karyawan</h5>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-3">
                                                <label>ID Order</label>
                                                <input type="text" name="id_order" id="id_order" value="" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-2">
                                                <label>Tanggal Order</label>
                                                <input type="text" name="tgl_order" value="<?= date('d-m-Y') ?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>NRP</label>
                                                <input type="text" name="nrp" value="<?= $this->session->userdata['nrp'] ?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Nama Karyawan</label>
                                                <input type="text" name="nama_karyawan" value="<?= $this->session->userdata['nama_karyawan'] ?>" readonly class="form-control">
                                            </div>
                                        </div>

                                        <!-- Button tambah -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <button type="button" class="btn btn-primary" id="barisBaru">
                                                            <i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="detailData">
                                            <h5>Detail Order</h5>
                                            <hr>
                                            <table class="table table-bordered" id="tableDetail">
                                                <thead>
                                                    <tr>
                                                        <td width="5%">No</td>
                                                        <td width="20%">Part Number</td>
                                                        <td width="35%">Deskripsi</td>
                                                        <td width="15%">Jumlah</td>
                                                        <td width="15%">Satuan</td>
                                                        <td width="10%">Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" align="center">
                                                            <input type="hidden" name="max_hidden" value="">
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
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
    <script>
        var sparepart = <?= json_encode($datasparepart) ?>

        console.log(sparepart);

        var sparepart_num = 1;

        $(document).ready(function() {
            $('#id_order').val(generateRandomString(15));
            for (B = 1; B <= 1; B++) {
                barisBaru();
            }
            $('#barisBaru').click(function(e) {
                e.preventDefault();
                barisBaru();
            });
            $("tableDetail tbody").find('input[type=text]').filter(':visible:first').focus();

        });

        function generateRandomString(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                result += characters.charAt(randomIndex);
            }

            return result;
        }

        function barisBaru() {
            $(document).ready(function() {
                $("[data-toggle='tooltip']").tooltip();
            });
            var Nomor = $("#tableDetail tbody tr").length + 1;
            var Baris = `<tr>
            <td class="text-center">${Nomor}</td>
            <td>
            <select name="part_number[]" id="part_number-${sparepart_num}" class="form-control" onchange="setDetail(this.value, ${sparepart_num})" required>
                                        <option selected="true" disabled="disabled">Pilih Spare Part</option>
                                        <?php foreach ($datasparepart as $sp) : ?>
                                            <option value="<?php echo $sp->part_number ?>"><?php echo $sp->part_number ?></option>
                                        <?php endforeach ?>
                                    </select>
            </td>
            <td>
            <input type="text" name="deskripsi[]" id="deskripsi-${sparepart_num}" class="form-control deskripsi" readonly>
            </td>
            <td>
            <input type="number" name="qty[]" id="qty-${sparepart_num}" class="form-control qty" required="">
            </td>
            <td>
            <input type="text" name="satuan[]" id="satuan-${sparepart_num}" class="form-control" readonly>
            </td>
            <td class="text-center">
            <a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>
            </td>
            </tr>`;

            $("#tableDetail tbody").append(Baris);
            $("#tableDetail tbody tr").each(function() {
                $(this).find('td:nth-child(2) input').focus();
            });

            sparepart_num++;
        }

        function setDetail(val, id) {
            let spart = getSparepart(val);
            $(`#deskripsi-${id}`).val(spart.deskripsi);
            $(`#satuan-${id}`).val(spart.satuan);
        }

        function getSparepart(part_number) {
            return sparepart.find(element => {
                console.log(element.part_number == part_number)
                if(element.part_number == part_number) {
                    return element;
                }
            });
        }

        $(document).on('click', '#HapusBaris', function(e) {
            e.preventDefault();
            var Nomor = 1;
            $(this).parent().parent().remove();
            $('tableLoop tbody tr').each(function() {
                $(this).find('td:nth-child(1)').html(Nomor);
                Nomor++;
            });
        });
    </script>

</body>

</html>