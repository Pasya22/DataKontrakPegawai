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
            <a class="nav-link " href="<?=site_url('Kontrak/DataKontrak')?>" id="navbarDropdown" >
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
      <form id="formEditDataKontrak<?=$abc->id_kontrak;?>" method="POST" class="formEditDataKontrak" Action="<?=site_url('Welcome/editDataPegawai/') . $abc->id_pegawai;?>">
        <div class="form-group">
            <label for="nama">Nama Pegawai:</label>
            <select name="id_pegawai" id="id_pegawai" class="form-control">
                <option value="">-- Silahkan Pilih Pegawai --</option>
            <?php foreach ($show2 as $key => $pegawai) {?>
                <option value="<?= $pegawai->id_pegawai; ?><?=$pegawai->id_pegawai == $abc->id_pegawai ? "selected" : ""?>"><?= $pegawai->nama?></option>
                <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama">Jabatan:</label>
            <select name="id_jabatan" id="id_jabatan" class="form-control">
                <option value="">-- Silahkan Pilih Jabatan --</option>
            <?php foreach ($show3 as $key => $jabatan) {?>
                <option value="<?= $jabatan->id_jabatan; ?><?=$jabatan->id_jabatan == $abc->id_jabatan ? "selected" : ""?>"><?= $jabatan->nama_jabatan?></option>
                <?php }?>
            </select>
          </div>
        <div class="form-group">
          <label for="tanggal_lahir">Tanggal Lahir:</label>
          <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?=$abc->tanggal_mulai;?>">
        </div>
        <div class="form-group">
          <label for="tanggal_lahir">Tanggal selesai:</label>
          <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?=$abc->tanggal_selesai;?>">
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
    var data = $('#formEditDataKontrak' + <?=$abc->id_kontrak;?>).serialize();
    console.log(data);
    $.ajax({
        type: 'POST',
        url: "http://localhost/datakontrakpegawai2/index.php/Kontrak/editDataKontrak/"+<?=$abc->id_kontrak;?>,
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
                        "<?=site_url('Kontrak/DataKontrak')?>";
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





