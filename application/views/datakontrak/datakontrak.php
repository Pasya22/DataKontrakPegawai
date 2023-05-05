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
            <a class="nav-link " href="<?= site_url('Welcome/DataPegawai'); ?>" id="navbarDropdown" >
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
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a  class="btn btn-success" href="<?=base_url()?>Welcome/addKontrak">ADD DATA</a>
          </div>
        </div>

      </div>
      <div class="table-responsive">
      <table class="table table-striped table-sm">
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
    <?php foreach ($tampilKontrak as $key => $kontrak) { ?>
      <tr>
        <td><?= $key+1 ?></td>
        <td><?= $kontrak->nama;?></td>
        <td><?= $kontrak->nama_jabatan; ?></td>
        <td><?= $kontrak->tanggal_mulai; ?></td>
        <td><?= $kontrak->tanggal_selesai; ?></td>
        <td>
          <a class="btn btn-danger" href="<?= site_url('Welcome/deleteDataKontrak'.$kontrak->id_kontrak); ?>">
            Delete
          </a>
          <a class="btn btn-info" href="<?= site_url('Welcome/editDataKontrak'.$kontrak->id_kontrak); ?>">
          Edit
        </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

      </div>
      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    </main>


  