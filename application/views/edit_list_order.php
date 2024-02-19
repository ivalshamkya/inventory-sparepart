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
                            <h1 class="h3 m-0 text-gray-800">Form Edit List Order</h1>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('list_order/proses_edit') ?>" id="form-tambah" method="POST">
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
                                                    <?php $i = 1; foreach ($detail_order as $key => $detail) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i ?></td>
                                                            <td>
                                                                <select name="part_number[]" id="part_number-<?= $i ?>" class="form-control" onchange="setDetail(this.value, <?= $i ?>)" required>
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
                                                                <input type="number" name="qty[]" value="<?= $detail->jumlah ?>" id="qty-<?= $i ?>" class="form-control qty" required="">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="satuan[]" value="<?= $detail->satuan ?>" id="satuan-<?= $i ?>" class="form-control" readonly>
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php $i++; } ?>
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

        var sparepart_num = <?= count($detail_order)+1 ?>;

        $(document).ready(function() {
            $('#barisBaru').click(function(e) {
                e.preventDefault();
                barisBaru();
            });
            $("tableDetail tbody").find('input[type=text]').filter(':visible:first').focus();

        });

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
                if (element.part_number == part_number) {
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