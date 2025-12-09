<?php
session_start();
$_SESSION['user'] = true;
if (!isset($_SESSION['user'])) {
    header("Location: ../index.html");
    exit();
}
include '../private/controller/conexion.php'; // Asegúrate de que este archivo use MySQL y PDO
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/ELLE_justLogo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../private/css/style.css" />
    <link rel="stylesheet" href="../private/css/style_inspina.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace-theme-default.min.css" />
    <link rel="stylesheet" href="../private/css/style_animate.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/f352c3a994.js" crossorigin="anonymous"></script>
    <script src="../private/js/inspina.js"></script>
    <script src="../private/js/popper.min.js"></script>
    <script src="../private/js/metismenu.js"></script>
    <script src="../private/js/slimcontrol.min.js"></script>
    <script src="../private/js/bootstrap.js"></script>

</head>

<body>
    <div class="containerbody" style="padding-top: 10px;">
        <div class="header-row">
            <button class="btn" id="Logout">Logout</button>
        </div>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">User management</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">Reviews</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-3">Gallery</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-4">Job offers</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <!-- listado de usuarios -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add
                                user</button>
                            <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
                                aria-labelledby="addUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addUserForm" method="post"
                                                action="../private/controller/user.php">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.querySelector('.btn').addEventListener('click', function () {
                                    new bootstrap.Modal(document.getElementById('addUserModal')).show();
                                });
                            </script>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">User ID</th>
                                            <th style="text-align: center;">Username</th>
                                            <th style="text-align: center;">Email</th>
                                            <th style="text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tbl_user ORDER BY id_user ASC";
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->execute();
                                            $resultado_query = $stmt->get_result();
                                            $stmt->close(); 
                                            
                                            if ($resultado_query->num_rows > 0) {
                                                while ($row = $resultado_query->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['id_user']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['name_user']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['mail_user']) . "</td>
                                                        <td style='text-align: center;'>";

                                                    if ($row['id_user'] != 1) {
                                                        echo "<button class='btn btn-sm btn-danger' onclick='deleteuser(" . htmlspecialchars($row['id_user']) . ")'>Delete</button>";
                                                    }
                                                    echo "</td></tr>";
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <!-- listado de reviews -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th style='text-align: center;'>Review ID</th>
                                            <th style='text-align: center;'>User</th>
                                            <th style='text-align: center;'>Message</th>
                                            <th style='text-align: center;'>Mail</th>
                                            <th style='text-align: center;'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        // Reviews
                                        $sql = 'SELECT * FROM tbl_review'; 
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->execute();
                                            $resultado_view = $stmt->get_result();
                                            $stmt->close(); 

                                            if ($resultado_view->num_rows > 0) {
                                                while ($row = $resultado_view->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['id']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['name']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['message']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['mail']) . "</td>
                                                        <td style='text-align: center;'>";
                                                    if ($row['status']) {
                                                        echo "<button class='btn btn-sm btn-danger' onclick='deletereview(" . htmlspecialchars($row['id']) . ")'>Delete</button>";
                                                    } else {
                                                        echo "<button class='btn btn-sm btn-success' onclick='deletereview(" . htmlspecialchars($row['id']) . ")'>Approve</button>";
                                                    }
                                                    echo "</td></tr>";
                                                }
                                            } 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <!-- listado de galería -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">Add
                                Image</button>
                            <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog"
                                aria-labelledby="addImageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addImageModalLabel">Add New Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addImageForm" method="post"
                                                action="../private/controller/galery.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="imageTitle" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="imageTitle"
                                                        name="imageTitle" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="imageFile" class="form-label">Select Image</label>
                                                    <input type="file" class="form-control" id="imageFile"
                                                        name="imageFile" accept="image/*" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload Image</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th style='text-align: center;'>Image ID</th>
                                            <th style='text-align: center;'>Title</th>
                                            <th style='text-align: center;'>Image</th>
                                            <th style='text-align: center;'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        // Gallery
                                        $sql = 'SELECT * FROM tbl_imgs'; 
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->execute();
                                            $resultado_query = $stmt->get_result();
                                            $stmt->close(); 

                                            if ($resultado_query->num_rows > 0) {
                                                while ($row = $resultado_query->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['id']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['comments']) . "</td>
                                                        <td style='text-align: center;'> 
                                                        <a href='" . htmlspecialchars($row['path_img']) . "'>
                                                        <img src='" . htmlspecialchars($row['path_img']) . "' alt='" . htmlspecialchars($row['id']) . "' style='width: 150px; height: 150px;'>
                                                        </a>
                                                        </td>
                                                        <td style='text-align: center;'>";

                                                    if ($row["status"]) {
                                                        echo "<button class='btn btn-sm btn-danger' onclick='deletegalery(" . htmlspecialchars($row['id']) . ")'>Delete</button>";
                                                    } else {
                                                        echo "<button class='btn btn-sm btn-success' onclick='deletegalery(" . htmlspecialchars($row['id']) . ")'>Approve</button>";
                                                    }
                                                    echo "</td></tr>";
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            <!-- listado de ofertas de trabajo -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th style='text-align: center;'>Job ID</th>
                                            <th style='text-align: center;'>Position</th>
                                            <th style='text-align: center;'>Mail</th>
                                            <th style='text-align: center;'>Phone</th>
                                            <!-- <th style='text-align: center;'>Actions</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        // Job offers
                                        $sql = 'SELECT * FROM tbl_jobs'; 
                                        if ($stmt = $conn->prepare($sql)) {
                                            $stmt->execute();
                                            $resultado_query = $stmt->get_result();
                                            $stmt->close(); 

                                            if ($resultado_query->num_rows > 0) {
                                                while ($row = $resultado_query->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['id']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['name']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['mail']) . "</td>
                                                        <td style='text-align: center;'>" . htmlspecialchars($row['phone']) . "</td>
                                                        </tr>";
                                                }
                                            } 
                                        }
                                        ?>
                                        <!-- <td style='text-align: center;'>
                                        <button class='btn btn-sm btn-danger'>Delete</button>
                                    </td> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script src="../private/js/admindash.js"></script>
<script>
    $(document).ready(function () {
        $('.table').DataTable();
    });
</script>

</html>