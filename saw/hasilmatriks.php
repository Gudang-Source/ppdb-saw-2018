<div class="row">
	<div class="col-2"><a href="<?= baseurl.'saw.php' ?>" type="button" class="btn btn-primary">AWAL</a>   </div>
    <div class="col-7">
        
    </div>  		
	<div class="col-3"><a href="<?= baseurl.'saw.php?a=proses&s=nilaimaks' ?>" type="button" class="btn btn-info float-right">LANJUT</a>	</div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col text-center">
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">1</i>Nilai</span></a>
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">2</i>Kriteria</span></a>
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">3</i>Bobot Nilai</span></a>
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">4</i>Bobot Maksimum</span></a>
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">5</i>Normalisasi</span></a>
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">6</i>Matriks Bobot Nilai</span></a>
        <a href="#"><span class="chip"><i class="chip-icon bg-primary" style="font-size: 12px">7</i>Hasil Matriks Bobot Nilai</span></a>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col">

        <h2>Hasil Sebelum Diurutkan</h2>
        <table class="table datatables table-hover table-striped table-borderless table-sm">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Nama Siswa</th>
                    <th>Nilai SAW</th>
                 
                 
                </tr>
            </thead>
            <tbody>
                <?php 
                            // query sql dari tabel siswa
                            // select 02-view-kriteria-alt
                            // $sql="SELECT * FROM `05-view-normalisasi-weighted`";
                            $sql="SELECT
                                    `a`.`id_nilai` AS `id_nilai`,
                                    `a`.`id_siswa` AS `id_siswa`,
                                    `a`.`nama_siswa` AS `nama_siswa`,
                                    cast((
                                        (
                                            (
                                                (
                                                    (
                                                        (
                                                            (
                                                                (`a`.`w1` + `a`.`w2`) + `a`.`w3`
                                                            ) + `a`.`w4`
                                                        ) + `a`.`w5`
                                                    ) + `a`.`w6`
                                                ) + `a`.`w7`
                                            ) + `a`.`w8`
                                        ) + `a`.`w9`
                                    ) as decimal(10,2)) AS `aw`
                                FROM
                                    `06-view-matrix-bobot-masuk` `a`";

                            $query=$koneksi->query($sql);
                            // selama dalam variabel query terdapat data, maka tampilkan datanya
                            $i=1;
                            $ripa=$rips=$rmat=$raga=$bind=$bing=0;
                            while($row=$query->fetch_assoc()):
                            // inisialisasi variabel i adalah 1
                            ?>
                <tr>
                    <td style="width:10%">
                        <?= "A".$i; ?>
                    </td>
                    <td style="width:60%">    <?= !empty($row['nama_siswa'])?$row['nama_siswa']:''; ?></td>
                    <td style="width:20%" class="text-right" > <?= !empty($row['aw'])?$row['aw']:'0'; ?></td>
               
                   
                    
                </tr>
                <?php $i++;endwhile; //akhir while?>
            </tbody>
        </table>
    </div>
    <div class="col">

        <h2>Hasil Setelah Diurutkan</h2>
        <table class="table datatables table-hover table-striped table-borderless table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Nilai SAW</th>
                 
                 
                </tr>
            </thead>
            <tbody>
                <?php 
                            // query sql dari tabel siswa
                            // select 02-view-kriteria-alt
                            // $sql="SELECT * FROM `05-view-normalisasi-weighted`";
                            $sql="SELECT
                                `b`.`id_siswa` AS `id_siswa`,
                                `b`.`nama_siswa` AS `nama_siswa`,
                                cast(`b`.`c1` AS decimal(10,2)) as `c1`,
                                cast(`b`.`c3` AS decimal(10,2)) as `c3`,
                                cast(`b`.`c2` AS decimal(10,2)) as `c2`,
                                cast(`b`.`c4` AS decimal(10,2)) as `c4`,
                                cast(`b`.`c5` AS decimal(10,2)) as `c5`,
                                cast(`b`.`c6` AS decimal(10,2)) as `c6`,
                                cast(`b`.`c7` AS decimal(10,2)) as `c7`,
                                cast(`b`.`c8` AS decimal(10,2)) as `c8`,
                                cast(`b`.`c9` AS decimal(10,2)) as `c9`,
                                cast(`a`.`aw` AS decimal(10,2))  as `aw`
                            FROM
                                (
                                    `07-view-alternative-weight-bobot-masuk` `a`
                                    JOIN `02-view-kriteria-alt` `b` ON (
                                        (
                                            `a`.`id_siswa` = `b`.`id_siswa`
                                        )
                                    )
                                )
                            ORDER BY
                                `a`.`aw` DESC";

                            $query=$koneksi->query($sql);
                            // selama dalam variabel query terdapat data, maka tampilkan datanya
                            $i=1;
                            $ripa=$rips=$rmat=$raga=$bind=$bing=0;
                            while($row=$query->fetch_assoc()):
                            // inisialisasi variabel i adalah 1
                            ?>
                <tr>
                    <td style="width:10%">
                        <?= $i; ?>
                    </td>
                    <td style="width:60%">    <?= !empty($row['nama_siswa'])?$row['nama_siswa']:''; ?></td>
                    <td style="width:20%" class="text-right" > <?= !empty($row['aw'])?$row['aw']:'0'; ?></td>
               
                   
                    
                </tr>
                <?php $i++;endwhile; //akhir while?>
            </tbody>
        </table>
    </div>
    
</div>


