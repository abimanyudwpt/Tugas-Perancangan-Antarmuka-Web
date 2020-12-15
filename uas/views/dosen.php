<?php
  if (!isset($_SESSION["login"])) {
        session_start();
        header("Location: ../login/login.php");
        exit;
    }
  include "models/m_dosen.php";

  $dsn = new dosen($connection);
  if (@$_GET['act'] == '') {
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Dosen <small>Data Dosen</small></h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <div class="table-responsive">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button><br><br>
          <table class="table table-bordered table-hover table-striped">
              <tr>
                  <th>No</th>
                  <th>Nip</th>
                  <th>Foto</th>
                  <th>Nama Dosen</th>
                  <th>Jenis Kelamin</th>
                  <th>Action</th>
              </tr>
              <?php
                $no = 1;
                $tampil = $dsn->tampil();
                while ($data = $tampil->fetch_object()) {
              ?>
              <tr>
                  <td align="center"><?php echo $no++; ?></td>
                  <td><?php echo $data->nip; ?></td>
                   <td align="center">
                    <img src="assets/img/gambardsn/<?php echo $data->gambar_dsn; ?>" width="70px">
                  </td>
                  <td><?php echo $data->nama_dsn; ?></td>
                  <td><?php echo $data->j_kelamin; ?></td>
                  
                  <td align="center">
                      <a id="edit_dsn" data-toggle="modal" data-target="#edit" data-id_dsn="<?php echo $data->id_dsn; ?>"  data-nip="<?php echo $data->nip; ?>" data-nama_dsn="<?php echo $data->nama_dsn; ?>" data-j_kelamin="<?php echo $data->j_kelamin; ?>" data-gambar_dsn="<?php echo $data->gambar_dsn; ?>">
                        <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
                      </a>
                      <a href="?page=dosen&act=del&id_dsn=<?php echo $data->id_dsn; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
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
              <h4 class="modal-title">Tambah Data Dosen</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label" for="nip">NIP</label>
                    <input type="number" name="nip" class="form-control" id="nip" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="nama_dsn">Nama Dosen</label>
                    <input type="text" name="nama_dsn" class="form-control" id="nama_dsn" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="j_kelamin">Jenis Kelamin</label>
                    <select name="j_kelamin" class="form-control" id="j_kelamin" required>
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="gambar_dsn">Foto</label>
                    <input type="file" name="gambar_dsn" class="form-control" id="gambar_dsn" required>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" value="Simpan" class="btn btn-success" name="tambah">
                  </div>
                </div>
            </form>
            <?php
              if (@$_POST['tambah']) {
                  $nip = $connection->conn->real_escape_string($_POST['nip']);
                  $nama_dsn = $connection->conn->real_escape_string($_POST['nama_dsn']);
                  $j_kelamin = $connection->conn->real_escape_string($_POST['j_kelamin']);
                
                  $extensi = explode(".", $_FILES['gambar_dsn']['name']);
                  $gambar_dsn = "gbr-".round(microtime(true)).".".end($extensi);
                  $sumber = $_FILES['gambar_dsn']['tmp_name'];
                  $upload = move_uploaded_file($sumber, "assets/img/gambardsn/".$gambar_dsn);
                  if ($upload) {
                      $dsn->tambah($nip, $nama_dsn, $j_kelamin, $gambar_dsn);
                      header("location: ?page=dosen");
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
              <h4 class="modal-title">Edit Data Dosen</h4>
            </div>
            <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-label" for="nip">NIP</label>
                    <input type="hidden" name="id_dsn" id="id_dsn">
                    <input type="number" name="nip" class="form-control" id="nip" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="nama_dsn">Nama Dosen</label>
                    <input type="text" name="nama_dsn" class="form-control" id="nama_dsn" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="j_kelamin">Jenis Kelamin</label>
                    <select name="j_kelamin" class="form-control" id="j_kelamin" required>
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="gambar_dsn">Foto</label>
                    <div style="padding-bottom:5px">
                      <img src="" width="80px" id="pict">
                    </div>
                    <input type="file" name="gambar_dsn" class="form-control" id="gambar_dsn">
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
        $(document).on("click", "#edit_dsn", function () {
          var id_dsn = $(this).data('id_dsn');
          var nip = $(this).data('nip');
          var nama_dsn = $(this).data('nama_dsn');
          var j_kelamin = $(this).data('j_kelamin');
          var gambar_dsn = $(this).data('gambar_dsn');
          $("#modal-edit #id_dsn").val(id_dsn);
          $("#modal-edit #nip").val(nip);
          $("#modal-edit #nama_dsn").val(nama_dsn);
          $("#modal-edit #j_kelamin").val(j_kelamin);
          $("#modal-edit #pict").attr("src","assets/img/gambardsn/"+gambar_dsn);
        })

        $(document).ready(function (e) {
            $("#form").on("submit", (function (e) {
                e.preventDefault();
                $.ajax({
                  url : 'models/proses_edit_dsn.php',
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
    $gbr_awal = $dsn->tampil($_GET['id_dsn'])->fetch_object()->gambar_dsn;
    unlink("assets/img/gambardsn/".$gbr_awal);

    $dsn->hapus($_GET['id_dsn']);
    header("location: ?page=dosen");
  }
?>