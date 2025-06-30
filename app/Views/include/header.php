<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Users Saas</title>
    <link rel="icon" href="<?= base_url('assets/img/favicon.ico') ?>" type="image/ico">
    <link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</head>

<body>

    <div aria-live="polite" aria-atomic="true" style="position: relative;">
        <div class="toast me-3" style="position: absolute; top: 0; right: 0; z-index:10000099;">
            <div class="toast-header d-flex justify-content-between bg-success " id="header-alerta">
                <strong class="mr-auto text-light" id="titulo-alerta"></strong>
                <i class="bi bi-check-circle text-light" id="icone-alerta"></i>
            </div>
            <div class="toast-body" id="mensagem-alerta"></div>
        </div>
    </div>