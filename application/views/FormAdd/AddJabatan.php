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
        <h1 class="h2">Add Data</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2"></div>
        </div>
      </div>
<form id="formAddDataJabatan" method="post" class="formAddDataJabatan" >
  <div class="form-group">
    <label for="nama_jabatan">Nama Jabatan:</label>
    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
  </div>
  <div class="form-group">
    <label for="gaji">Gaji:</label>
    <input class="form-control" id="gaji" name="gaji"></input>
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
    var data = $('#formAddDataJabatan').serialize();
    console.log(data);
    $.ajax({
        type: 'POST',
        url: "http://localhost/datakontrakpegawai2/index.php/Welcome/addDataJabatan",
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
                        "<?=site_url('Welcome/DataJabatan/')?>";
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





