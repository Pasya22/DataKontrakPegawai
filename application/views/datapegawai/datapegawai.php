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
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <!-- Button trigger modal -->
          <div class="btn-group mr-2">
            <a  class="btn btn-success" href="<?=site_url('Welcome/FormAddPegawai')?>">ADD DATA</a>
          </div>
          </div>
        </div>

      </div>
      <div class="table-responsive">
      <table class="table table-striped table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Tanggal Lahir</th>
      <th>Jenis Kelamin</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="tabelPegawai">
    
  </tbody>
</table>

      </div>
      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>



    </main>

<script>

// =========================================== Get Data Employee ================================= //
  $(document).ready(function(){
    var data = "";
    $.ajax({
      url: 'http://localhost/datakontrakpegawai2/index.php/Welcome/GetPegawai',
      method: 'GET',
      success:function(html){
        html = JSON.parse(html);
        for (let index = 0; index < html.length; index++) {
          data += '<tr>'+
           ' <td>' + (index + 1) + ' </td>' +
         '<td>' + html[index].nama + '</td>'+
         '<td>' + html[index].alamat + '</td>'+
         '<td>' + html[index].tanggal_lahir + '</td>'+
         '<td>' + html[index].jenis_kelamin + '</td>'+
          '<td>' + 
            '<button class="btn btn-danger" onclick="hapus('+html[index].id_pegawai+')">Delete</button>' +
            '  '+
            '<a class="btn btn-info" href="<?= site_url('Welcome/FormEditPegawai') ?>/' + html[index].id_pegawai + '">Edit</a>' +
          '</td>'+
         '</tr>';
        }
        $("#tabelPegawai").html(data);
      }

    });
  });

// =========================================== Delete Employee ================================= //
 function hapus(id) {
      iziToast.show({
      theme: 'dark',
      overlay: true,
      close: false,
      progressBar: false,
      timeout: 0,
      title: 'Hapus Data Pegawai',
      message: 'Apakah anda yakin ingin menghapus data ini?',
      position: 'center',
      buttons: [
      ['<button><b>Ya</b></button>', function (instance, toast) {
        $.ajax({
        type: 'DELETE',
        url: "http://localhost/datakontrakpegawai2/index.php/Welcome/deleteDataPegawai/" + id,
        success: function(data) {
            var datas = JSON.parse(data);
            console.log(datas);
            if (datas.status) {
                iziToast.success({
                    title: 'Alhamdulilah',
                    message: 'Data Pegawai Berhasil DiHapus',
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.href =
                        "<?=site_url('Welcome/DataPegawai/') . $this->uri->segment(3);?>";
                }, 1000);
            } else {
                iziToast.error({
                    title: 'Masyaallah',
                    message: 'Data pegawai tidak ke Hapus',
                    position: 'topRight'
                });
            }
        }
    });
        instance.hide({ transitionOut: 'fadeOut' }, toast);
      }, true],
      ['<button>Tidak</button>', function (instance, toast) {
        instance.hide({ transitionOut: 'fadeOut' }, toast);
      }]
        ]
      });
    }
</script>