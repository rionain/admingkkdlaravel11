<?php
function generate_string($strength = 16)
{
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for ($a = 0; $a < 3; $a++) {
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        if ($a != 2) {
            $random_string .= '-';
        }
    }
    return $random_string;
}
function format_json($status = true, $message = null, $data = null, $token = null)
{
    if ($token == null) {
        $json = [
            'status' => $status,
            'message' => $message,
            // 'token' => $token,
            'data' => $data,
        ];
    } else {
        $json = [
            'status' => $status,
            'message' => $message,
            'token' => $token,
            'data' => $data,
        ];
    }
    return $json;
}

function bgCard()
{
    return 'primary';
}

function bgColor()
{
    return 'secondary';
}

function title()
{
    return 'O3BLAST';
}

function getDateLink()
{
    return '?' . md5(date('dmYHis'));
}

function addButton($id, $text, $modal, $title)
{
    $data = '<button id="' . $id . '" class="btn btn-sm btn-primary" title="' . $title . '" data-toggle="modal" data-target="#' . $modal . '"><i class="fas fa-pencil-alt"></i> ' . $text . '</button>';
    return $data;
}

function search($link, $q)
{
    $data = '<form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="q" class="form-control o-search-input" placeholder="Search" value="' . $q . '">
        <span class="input-group-append">';
    if ($q <> '') {
        $data = $data . '<a href="' . $link . '" class="btn btn-secondary btn-sm" title="Reset">Reset</button></a>';
    }
    $data = $data . '<button type="submit" class="btn btn-warning btn-sm" title="Search"><i class="fas fa-search"></i></button>
        </span>
        </div>
        </form>';
    return $data;
}

function footer($total, $links)
{
    $data = '
        <div class="row">
            <div class="col-md-6">
                <small class="font-weight-bold">Total Record : ' . $total . '</small>
            </div>
            <div class="col-md-6">
                ' . $links . '
            </div>
        </div>';
    return $data;
}

function modalFooter()
{
    $data = '<div class="col-md-12 text-center">
                <button type="button" class="btn btn-action-modal btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-action-modal btn-sm btn-' . bgCard() . '">Simpan</button>
                </form>
            </div>';
    return $data;
}

function modalFooterZircos()
{
    $data = '<div class="col-sm-12 text-center">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
            </div>';
    return $data;
}

function modalFooterDetail()
{
    $data = '<div class="col-md-12 text-center">
                <button type="button" class="btn btn-action-modal btn-secondary" data-dismiss="modal">Kembali</button>
            </div>';
    return $data;
}

function modalFooterDetailZircos()
{
    $data = '<div class="col-md-12 text-center">
                <button type="button" class="btn btn-action-modal btn-secondary" data-dismiss="modal">Kembali</button>
            </div>';
    return $data;
}

function footerExport($total, $links, $export)
{
    $data = '
        <div class="row">
            <div class="col-md-6 mb-2">
                <a href="' . $export . '">
                    <button class="btn btn-sm btn-success"><i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel</button>
                </a>
            </div>
            <div class="col-md-6 mb-2">
                ' . $links . '
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2" style="margin-top: -10px;">
                <small class="font-weight-bold">Total Record : ' . $total . '</small>
            </div>
        </div>

        ';
    return $data;
}

function kosong()
{
    return '<span class="badge badge-danger">Kosong</span>';
}

function badge($color, $text)
{
    return '<span class="badge badge-' . $color . '">' . $text . '</span>';
}

function format_angka($angka)
{
    $hasil = number_format($angka, 0, ',', '.');
    return $hasil;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function format_date($date, $format = 'Y-m-d')
{
    return date($format, strtotime($date));
}

function hari($date)
{
    $day = date('l', strtotime($date));
    switch ($day) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}

function styletable()
{
    return 'table table-striped add-edit-table table-bordered';
}

function editText()
{
    return 'Edit';
}

function deleteText()
{
    return 'Delete';
}

function showText()
{
    return 'Show';
}

function listText()
{
    return 'List';
}

function detailText()
{
    return 'Detail';
}

function addText()
{
    return 'Add';
}

function tanggal_indonesia($tanggal)
{
    $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
    );

    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function nullNumber($num)
{
    if($num == null || $num == '') {
        return 0;
    } else {
        return $num;
    }
}

function AcceptImage() {
    return 'accept="image/jpg, image/jpeg, image/png"';
}

function DescriptionImage() {
    return '<small class="text-danger">max: 1mb ( jpg/jpeg/png )</small>';
}

function AcceptFile() {
    return 'accept=".pdf, .doc, .docx"';
}

function DescriptionFile() {
    return '<small class="text-danger">max: 2mb ( pdf/doc )</small>';
}

function url_image($data) {
    return 'https://admin.sinodegkkd.org/'.$data;
}

function setMaxChar($max, $data) {
    if(strlen($data) > $max) {
        // $pos = strpos(substr($data, $pos, $max), ' ');
        return substr($data, 0, $max).'...';
    } else {
        return $data;
    }
}
