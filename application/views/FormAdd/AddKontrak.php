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
        <h1 class="h2">Add Data</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>
        <form id="formAddDataKontrak" method="post" class="formAddDataKontrak" >
        <div class="form-group">
        <label for="id_pegawai">Pegawai:</label>
        <select class="form-control" id="id_pegawai" name="id_pegawai">
            <option value="">-- Pilih  Pegawai --</option>
            <?php foreach ($tampil as $abc): ?>
            <option value="<?=$abc->id_pegawai?>"><?=$abc->nama?></option>
            <?php endforeach;?>
        </select>
        </div>
        <div class="form-group">
        <label for="id_jabatan">Jabatan:</label>
        <select class="form-control" id="id_jabatan" name="id_jabatan">
            <option value="">-- Pilih Jabatan --</option>
            <?php foreach ($show as $jabatan): ?>
            <option value="<?=$jabatan->id_jabatan?>"><?=$jabatan->nama_jabatan?></option>
            <?php endforeach;?>
        </select>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Selesai:</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
        </div>
        <button type="button" name="submit" onclick="addData()"class="btn btn-outline-primary" id="submit">
            Save
        </button>
        </form>
</div>
      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>


    </main>



<script>
 function addData() {
    var data = $('.formAddDataKontrak').serialize();
    console.log(data);
    $.ajax({
        type: 'POST',
        url: "http://localhost/datakontrakpegawai2/index.php/Kontrak/AddDataKontrak",
        data: data,
        success: function(data) {
            var datas = JSON.parse(data);
            console.log(datas);
            if (datas.status) {
                iziToast.success({
                    title: 'Alhamdulilah',
                    message: 'data Berhasil diinput',
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.href =
                        "<?=site_url('Kontrak/DataKOntrak/')?>";
                }, 100);
            } else {
                iziToast.error({
                    title: 'Masyaallah',
                    message: 'Data Tidak terinput',
                    position: 'topRight'
                });

            }
        }
    });
}

</script>





