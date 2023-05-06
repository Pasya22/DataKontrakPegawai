<nav class="col-md-2 d-none d-md-block bg-dark sidebar text-white">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Master <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="<?=site_url('Welcome/DataPegawai');?>" id="navbarDropdown" >
              Data Pegawai
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="<?=site_url('Welcome/DataJabatan')?>" id="navbarDropdown" >
              Data Jabatan
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="<?=site_url('Welcome/DataKontrak')?>" id="navbarDropdown" >
              Data Kontrak
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data</h1>
      </div>
      <?php foreach ($showJ as $key => $abc) { ?>
      <form id="formEditDataJabatan<?= $abc->id_jabatan;?>" method="POST" class="formEditDataJabatan" Action="<?= site_url('Welcome/editDataJabatan/').$abc->id_jabatan; ?>" >
       
        <div class="form-group">
          <label for="nama">Nama Jabatan:</label>
          <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?= $abc->nama_jabatan; ?>">
        </div>
        <div class="form-group">
          <label for="alamat">Gji Pokok:</label>
          <textarea class="form-control" id="gaji" name="gaji"><?= $abc->gaji ?></textarea>
        </div>
        <!-- <button type="submit" name="submit"  class="btn btn-outline-primary" id="submit">Save</button> -->
        <button type="button" name="submit" onclick="updatedata()" class="btn btn-outline-primary" id="submit">Save</button>
      </form>
    <?php } ?>

</div>
      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>


    </main>

<script>
function updatedata() {
    var data = $('#formEditDataJabatan' + <?= $abc->id_jabatan; ?>).serialize();
    console.log(data);
    $.ajax({
        type: 'POST',
        url: "http://localhost/datakontrakpegawai2/index.php/Welcome/editDataJabatan/" +<?= $abc->id_jabatan ?>,
        data: data + <?= $abc->id_jabatan;?>,
        success: function(data) {
            var datas = JSON.parse(data);
            // console.log(datas);
            if (datas.status) {
                iziToast.success({
                    title: 'Alhamdulilah',
                    message: 'data Berhasil DiUbah',
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.href =
                        "<?=site_url('Welcome/DataJabatan/')?>";
                }, 2000);
            } else {
                iziToast.error({
                    title: 'Masyaallah',
                    message: 'data tidak ke ubah, coba periksa lagi ya..',
                    position: 'topRight'
                });

            }


        }
    });
}

</script>





