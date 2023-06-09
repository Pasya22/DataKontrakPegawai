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
      <?php foreach ($show as $key => $abc) {?>
      <form id="formEditDataPegawai<?=$abc->id_pegawai;?>" method="POST" class="formEditDataPegawai" Action="<?=site_url('Welcome/editDataPegawai/') . $abc->id_pegawai;?>">
        <div class="form-group">
          <label for="nama">Nama Pegawai:</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?=$abc->nama;?>">
        </div>
        <div class="form-group">
          <label for="alamat">Alamat:</label>
          <textarea class="form-control" id="alamat" name="alamat"><?=$abc->alamat?></textarea>
        </div>
        <div class="form-group">
          <label for="tanggal_lahir">Tanggal Lahir:</label>
          <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?=$abc->tanggal_lahir;?>">
        </div>
        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin:</label>
          <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
            <option value="">--- pilih jenis kelamin ---</option>
            <option value="Laki laki" <?=($abc->jenis_kelamin == 'Laki -laki') ? 'selected' : ''?>>Laki-laki</option>
            <option value="Perempuan" <?=($abc->jenis_kelamin == 'Perempuan') ? 'selected' : ''?>>Perempuan</option>
          </select>
        </div>
        <!-- <button type="submit" name="submit"  class="btn btn-outline-primary" id="submit">Save</button> -->
        <button type="button" name="submit" onclick="updatedata()" class="btn btn-outline-primary" id="submit">Save</button>
      </form>
    <?php }?>

</div>
      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>


    </main>
<script>
function updatedata() {
    var data = $('#formEditDataPegawai' + <?=$abc->id_pegawai;?>).serialize();
    console.log(data);
    $.ajax({
        type: 'POST',
        url: "http://localhost/datakontrakpegawai2/index.php/Welcome/editDataPegawai/"+<?=$abc->id_pegawai;?>,
        data: data ,
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
                        "<?=site_url('Welcome/DataPegawai/')?>";
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





