<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Animarl</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../assets/cms/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../assets/cms/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../assets/cms/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../assets/cms/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../assets/cms/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- full calender Css -->
    <link href='../assets/cms/plugins/fullcalendar-3.9.0/fullcalendar.min.css' rel='stylesheet' />

    <!-- Custom Css -->
    <link href="../assets/cms/css/style.css" rel="stylesheet" />

    <!-- Datatable Css -->
    <link href="../assets/cms/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../assets/cms/css/themes/all-themes.css" rel="stylesheet" />
    <style>
    /* モーダルCSS */
    .modalArea {
    display: none;
    position: fixed;
    z-index: 11; /*サイトによってここの数値は調整 */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    }

    .modalBg {
    width: 100%;
    height: 100%;
    background-color: rgba(30,30,30,0.9);
    }

    .modalWrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    width: 70%;
    max-width: 500px;
    padding: 10px 30px;
    background-color: #fff;
    }

    .modalWrapper_staff_list {
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    width: 70%;
    max-width: 90%;
    padding: 10px 30px;
    background-color: #fff;
    }

    .modalWrapper_event {
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    width: 70%;
    max-width: 350px;
    padding: 10px 30px;
    background-color: #fff;
    }

    .closeModal {
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    cursor: pointer;
    }


    /* 以下ボタンスタイル */
    button {
    padding: 10px;
    background-color: #fff;
    border: 1px solid #282828;
    border-radius: 2px;
    cursor: pointer;
    }

    #openModal {
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    }

    .table > tbody > tr.active > td,
    .table > tbody > tr.active > th {
        background-color: #e1f2fe;
    }
</style>
</head>

<body class="theme-red">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar" id="header">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="main">Animarl CRM Program</a>
            </div>
        </div>
    </nav>