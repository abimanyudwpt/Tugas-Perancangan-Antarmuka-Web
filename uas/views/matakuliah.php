<?php
  if (!isset($_SESSION["login"])) {
        session_start();
        header("Location: ../login/login.php");
        exit;
    }
  include "models/m_matakuliah.php";

  $mk = new matakuliah($connection);
  if (@$_GET['act'] == '') {
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Matakuliah <small>Daftar Matakuliah</small></h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <div class="table-responsive">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Matakuliah</button><br><br>
          <table class="table table-bordered table-hover table-striped">
              <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Matakuliah</th>
                  <th>sks</th>
                  <th>Action</th>
              </tr>
              <?php
                $no = 1;
                $tampil = $mk->tampil();
                while ($data = $tampil->fetch_object()) {
              ?>
              <tr>
                  <td align="center"><?php echo $no++; ?></td>
                  <td><?php echo $data->kode; ?></td>
                  <td><?php echo $data->matakuliah; ?></td>
                  <td><?php echo $data->sks; ?></td>
                  
                  <td align="center">
                      <a id="edit_mk" data-toggle="modal" data-target="#edit" data-id_mk="<?php echo $data->id_mk; ?>" data-kode="<?php echo $data->kode; ?>"  data-matakuliah="<?php echo $data->matakuliah; ?>" data-sks="<?php echo $data->sks; ?>">
                        <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
                      </a>
                      <a href="?page=matakuliah&act=del&id_mk=<?php echo $data->id_mk; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
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
              <h4 class="modal-title">Tambah Daftar Makakuliah</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label" for="kode">Kode Matakuliah</label>
                    <input type="text" name="kode" class="form-control" id="kode" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="matakuliah">Nama Matakuliah</label>
                    <input type="text" name="matakuliah" class="form-control" id="matakuliah" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="sks">SKS</label>
                    <select name="sks" class="form-control" id="sks" required>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" value="Simpan" class="btn btn-success" name="tambah">
                  </div>
                </div>
            </form>
            <?php
              if (@$_POST['tambah']) {
                  $kode = $connection->conn->real_escape_string($_POST['kode']);
                  $matakuliah = $connection->conn->real_escape_string($_POST['matakuliah']);
                  $sks = $connection->conn->real_escape_string($_POST['sks']);

                  $mk->tambah($kode, $matakuliah, $sks);
                      header("location: ?page=matakuliah");
              } else {
                
              } 
            ?>
          </div>
        </div>
      </div>

<!-- EDIT DATA -->
      <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Matakuliah</h4>
            </div>
            <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-label" for="kode">Kode Matakuliah</label>
                    <input type="hidden" name="id_mk" id="id_mk">
                    <input type="text" name="kode" class="form-control" id="kode" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="matakuliah">Nama Matakuliah</label>
                    <input type="text" name="matakuliah" class="form-control" id="matakuliah" required>
                  </div>
                 <div class="form-group">
                    <label class="control-label" for="sks">SKS</label>
                    <select name="sks" class="form-control" id="sks" required>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
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
        $(document).on("click", "#edit_mk", function () {
          var id_mk = $(this).data('id_mk');
          var kode = $(this).data('kode');
          var matakuliah = $(this).data('matakuliah');
          var sks = $(this).data('sks');
          $("#modal-edit #id_mk").val(id_mk);
          $("#modal-edit #kode").val(kode);
          $("#modal-edit #matakuliah").val(matakuliah);
          $("#modal-edit #sks").val(sks);
        })

        $(document).ready(function (e) {
            $("#form").on("submit", (function (e) {
                e.preventDefault();
                $.ajax({
                  url : 'models/proses_edit_mk.php',
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
    $mk->hapus($_GET['id_mk']);
    header("location: ?page=matakuliah");
  }
?>