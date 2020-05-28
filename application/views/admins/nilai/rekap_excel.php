<?php
 
 header("Content-type: application/vnd-pdf");

 $filename = "Daftar Nilai Kelas " . $kelas->no_kelas . ".xlsx";
 
 header("Content-Disposition: attachment; filename='" . $filename . "'");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");

// header("Content-Type: application/pdf");
//     header("Cache-Control: no-cache");
//     header("Accept-Ranges: none");
//     header("Content-Disposition: inline; filename=\"example.pdf\"");
 
 ?>

<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th style="text-align: center; vertical-align: middle;" rowspan="2">No</th>
        <th style="text-align: center; vertical-align: middle;" rowspan="2">NIM</th>
        <th style="text-align: center; vertical-align: middle;" rowspan="2">Nama</th>
        <th style="text-align: center; vertical-align: middle;" colspan=<?= sizeof($list_pertemuan) ?>>Pertemuan</th>
        <th style="text-align: center; vertical-align: middle;" rowspan="2">Tugas Akhir</th>
        <th style="text-align: center; vertical-align: middle;" rowspan="2">Nilai Akhir</th>
    </tr>
    <tr>
        <?php foreach ($list_pertemuan as $index => $pertemuan): ?>
            <th style="text-align: center; vertical-align: middle;"><?php echo ($index + 1); ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
        <?php $indeks = 0; ?>
        <?php foreach ($list_peserta as $peserta): ?>  
            <tr>
                <td><?php $indeks += 1; echo $indeks; ?></td>
                <td><?php echo $peserta->nim; ?></td>
                <td><?php echo $peserta->nama; ?></td>
                <?php foreach ($list_pertemuan as $pertemuan): ?>
                    <?php if($absensi[$peserta->nim][$pertemuan->id_pertemuan]) { ?>
                        <td><?php echo $list_resume[$peserta->nim]
                                        [$pertemuan->id_pertemuan]->nilai; ?></td>
                    <?php } else { ?>
                        <td>0</td>
                    <?php } ?>
                <?php endforeach; ?>
                <td>
                    <?php if($daftar_tugas_akhir[$peserta->nim] != null) { ?>
                        <?php echo $daftar_tugas_akhir[$peserta->nim]->nilai; ?>
                    <? } else { ?>
                        0
                    <?php } ?>
                </td>
                <td>
                    <?php echo $peserta->nilai_akhir; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
    </tfoot>
</table>