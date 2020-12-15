<?php
  include "models/m_mahasiswa.php";

  $mhs = new mahasiswa($connection);
  if (@$_GET['act'] == '') {
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Mahasiswa <small>Data Mahasiswa</small></h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <div class="table-responsive">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button><br><br>
          <table class="table table-bordered table-hover table-striped">
              <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Jurusan</th>
                  <th>Program Studi</th>
                  <th>Action</th>
              </tr>
              <?php
                $no = 1;
                $tampil = $mhs->tampil();
                while ($data = $tampil->fetch_object()) {
              ?>
              <tr>
                  <td align="center"><?php echo $no++; ?></td>
                  <td><?php echo $data->nim; ?></td>
                   <td align="center">
                    <img src="assets/img/gambarmhs/<?php echo $data->gambar; ?>" width="70px">
                  </td>
                  <td><?php echo $data->nama; ?></td>
                  <td><?php echo $data->jurusan; ?></td>
                  <td><?php echo $data->prodi; ?></td>
                  
                  <td align="center">
                      <a id="edit_mhs" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>"  data-nim="<?php echo $data->nim; ?>" data-nama="<?php echo $data->nama; ?>" data-jurusan="<?php echo $data->jurusan; ?>" data-prodi="<?php echo $data->prodi; ?>" data-gambar="<?php echo $data->gambar; ?>">
                        <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
                      </a>
                      <a href="?page=mahasiswa&act=del&id=<?php echo $data->id; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                      </a>
                  </td>
              </tr>
              <?php
                }       
              ?>
          </table>
      </div>

<!--TAMBAH DATA-->
      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Data Mahasiswa</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label" for="nim">NIM</label>
                    <input type="number" name="nim" class="form-control" id="nim" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="jurusan">Jurusan</label>
                    <select name="jurusan" class="form-control" id="jurusan" required>
                      <option value="Teknik Informatika">Teknik Informatika</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="prodi">Program Studi</label>
                    <select name="prodi" class="form-control" id="prodi" required>
                      <option value="Manajemen Informatika">Manajemen Informatika</option>
                      <option value="Ilmu Komputer">Ilmu Komputer</option>
                      <option value="Sistem Informasi">Sistem Informasi</option>
                      <option value="Pendidikan Teknik Informatika">Pendidikan Teknik Informatika</option>
                      <option value="Manajemen Sistem Informasi">Manajemen Sistem Informasi</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="gambar">Foto</label>
                    <input type="file" name="gambar" class="form-control" id="gambar" required>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" value="Simpan" class="btn btn-success" name="tambah">
                  </div>
                </div>
            </form>
            <?php
              if (@$_POST['tambah']) {
                  $nim = $connection->conn->real_escape_string($_POST['nim']);
                  $nama = $connection->conn->real_escape_string($_POST['nama']);
                  $jurusan = $connection->conn->real_escape_string($_POST['jurusan']);
                  $prodi = $connection->conn->real_escape_string($_POST['prodi']);
                
                  $extensi = explode(".", $_FILES['gambar']['name']);
                  $gambar = "gbr-".round(microtime(true)).".".end($extensi);
                  $sumber = $_FILES['gambar']['tmp_name'];
                  $upload = move_uploaded_file($sumber, "assets/img/gambarmhs/".$gambar);
                  if ($upload) {
                      $mhs->tambah($nim, $nama, $prodi, $jurusan, $gambar);
                      header("location: ?page=mahasiswa");
                  } else {
                      echo "<script>alert('Upload gambar gagal!')</script>";
                  }
              } ?>
          </div>
        </div>
      </div>

<!-- EDIT DATA -->
      <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Data Mahasiswa</h4>
            </div>
            <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-label" for="nim">NIM</label>
                    <input type="hidden" name="id" id="id">
                    <input type="number" name="nim" class="form-control" id="nim" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="jurusan">Jurusan</label>
                    <select name="jurusan" class="form-control" id="jurusan" required>
                      <option value="Teknik Informatika">Teknik Informatika</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="prodi">Program Studi</label>
                    <select name="prodi" class="form-control" id="prodi" required>
                      <option value="Manajemen Informatika">Manajemen Informatika</option>
                      <option value="Ilmu Komputer">Ilmu Komputer</option>
                      <option value="Sistem Informasi">Sistem Informasi</option>
                      <option value="Pendidikan Teknik Informatika">Pendidikan Teknik Informatika</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label" for="gambar">Foto</label>
                    <div style="padding-bottom:5px">
                      <img src="" width="80px" id="pict">
                    </div>
                    <input type="file" name="gambar" class="form-control" id="gambar">
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Simpan" class="btn btn-success" name="tambah">
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <script src="assets/js/jquery-1.10.2.js"></script>
      <script type="text/javascript">
        $(document).on("click", "#edit_mhs", function () {
          var id = $(this).data('id');
          var nim = $(this).data('nim');
          var nama = $(this).data('nama');
          var jurusan = $(this).data('jurusan');
          var prodi = $(this).data('prodi');
          var gambar = $(this).data('gambar');
          $("#modal-edit #id").val(id);
          $("#modal-edit #nim").val(nim);
          $("#modal-edit #nama").val(nama);
          $("#modal-edit #jurusan").val(jurusan);
          $("#modal-edit #prodi").val(prodi);
          $("#modal-edit #pict").attr("src","assets/img/gambarmhs/"+gambar);
        })

        $(document).ready(function (e) {
            $("#form").on("submit", (function (e) {
                e.preventDefault();
                $.ajax({
                  url : 'models/proses_edit_mhs.php',
                  type : 'POST',
                  data : new FormData(this),
                  contentType : false,
                  cache : false,
                  processData : false,
                  success : function(msg) {
                    $('.table').html(msg);
                  }
                });
            }));
        })
      </script>

  </div>
</div>
<?php
  } else if (@$_GET['act'] == 'del'){
    $gbr_awal = $mhs->tampil($_GET['id'])->fetch_object()->gambar;
    unlink("assets/img/gambarmhs/".$gbr_awal);

    $mhs->hapus($_GET['id']);
    header("location: ?page=mahasiswa");
  }
?>