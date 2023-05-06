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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Data Kontrak</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a  class="btn btn-success" href="<?=site_url('Kontrak/FormAddKontrak');?>">ADD DATA</a>
          </div>
        </div>

      </div>
      <div class="table-responsive">
      <!-- <table class="table table-striped table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>nama pegawai</th>
      <th>jabatan </th>
      <th>tanggal mulai</th>
      <th>tanggal selesai</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tampil as $key => $kontrak) {?>
      <tr>
        <td><?=$key + 1?></td>
        <td><?=$kontrak->nama;?></td>
        <td><?=$kontrak->nama_jabatan;?></td>
        <td><?=$kontrak->tanggal_mulai;?></td>
        <td><?=$kontrak->tanggal_selesai;?></td>
        <td>
           <a class="btn btn-danger" onclick="hapus(<?=$kontrak->id_kontrak;?>)">
           Delete
          </a>
          <a class="btn btn-info" href="<?=site_url('Kontrak/FormEditKontrak/' . $kontrak->id_kontrak);?>">
          Edit
        </a>
        </td>
      </tr>
    <?php }?>
  </tbody>
</table> -->
<!-- file: kontrak.php -->
<table id="tableKontrak1" class="table table-striped table-lg">
  <thead>
    <tr>
      <th>ID Kontrak</th>
      <th>Nama Pegawai</th>
      <th>Jabatan</th>
      <th>Tanggal Mulai</th>
      <th>Tanggal Selesai</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="tableKontrak">
  </tbody>
</table>

      </div>
      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    </main>
<script>
// ================================ Show Data Contract =============================== //
$(document).ready(function() {
  var data = "";
  $.ajax({
    url: "http://localhost/datakontrakpegawai2/index.php/Kontrak/GetKontrak/",
    method: "GET",
    success: function(html) {
      html = JSON.parse(html);
      for (let index = 0; index < html.length; index++) {
        // console.log(html)
        data += '<tr>'+
           ' <td>' + (index + 1) + ' </td>' +
         '<td>' + html[index].nama + '</td>'+
         '<td>' + html[index].nama_jabatan + '</td>'+
         '<td>' + html[index].tanggal_mulai + '</td>'+
         '<td>' + html[index].tanggal_selesai + '</td>'+
          '<td>' + 
            '<a class="btn btn-danger" onclick="hapus('+html[index].id_kontrak+')">Delete</a>' +
          '</td>'+
          '<td>' +
            '<a class="btn btn-info" href="<?= site_url('Kontrak/FormEditKontrak') ?>/' + html[index].id_kontrak + '">Edit</a>' +
          '</td>'+
         '</tr>';
        }
         $("#tableKontrak").html(data);
        }
  });
});


// ==================================== Delete Data ================================== //
function hapus(id) {
      iziToast.show({
          theme: 'dark',
          overlay: true,
          close: false,
          progressBar: false,
          timeout: 0,
          title: 'Hapus Data Kontrak',
          message: 'Apakah anda yakin ingin menghapus data ini?',
          position: 'center',
          buttons: [
            ['<button><b>Ya</b></button>', function (instance, toast) {
              $.ajax({
              type: 'DELETE',
              url: "http://localhost/datakontrakpegawai2/index.php/Kontrak/deleteDataKontrak/" + id,
              success: function (data) {
                var datas = JSON.parse(data);
                if (datas.status) {
                  iziToast.success({
                    title: 'Alhamdulillah',
                    message: 'Data Berhasil Dihapus',
                    position: 'bottomRight'
                  });
                  setTimeout(function () {
                    window.location.href = "http://localhost/datakontrakpegawai2/index.php/Kontrak/DataKontrak/"
                  }, 2000);
                } else {
                  iziToast.error({
                    title: 'Masyaallah',
                    message: 'Data Gagal Dihapus',
                    position: 'bottomRight'
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

    };


</script>
