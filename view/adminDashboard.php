<?php
session_start();
$_SESSION['user'] = true;
if (!isset($_SESSION['user'])) {
    header("Location: ../index.html");
    exit();
}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
</head>

<body>
  <div class="containerbody" style="padding-top: 10px;">
    <div class="header-row">
        <button class="btn">Logout</button>
    </div>
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">User management</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2">Reviews</a></li>
                <li class=""><a data-toggle="tab" href="#tab-3">Gallery</a></li>
                <li class=""><a data-toggle="tab" href="#tab-4">Job offers</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <!-- listado de usuarios -->
                        <table class="">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos de los usuarios desde la base de datos -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <!-- listado de reviews -->
                        <table class="">
                            <thead>
                                <tr>
                                    <th>Review ID</th>
                                    <th>User</th>
                                    <th>Content</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos de las reviews desde la base de datos -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <!-- listado de galería -->
                        <table class="">
                            <thead>
                                <tr>
                                    <th>Image ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos de la galería desde la base de datos -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <!-- listado de ofertas de trabajo -->
                        <table class="">
                            <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>Position</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos de las ofertas de trabajo desde la base de datos -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://kit.fontawesome.com/f352c3a994.js" crossorigin="anonymous"></script>
<script src="../private/js/index.js"></script>
<script src="../private/js/inspina.js"></script>
<script src="../private/js/popper.min.js"></script>
<script src="../private/js/metismenu.js"></script>
<script src="../private/js/slimcontrol.min.js"></script>
</html>