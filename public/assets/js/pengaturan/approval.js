const modalApproval = "approvalModal";
// const modalDetailKop    = 'modalDetailKop'
const formApproval = "formApproval";

$("#tambahApproval").on("click", function () {
    titleAction(
        "Form Tambah Approval",
        base_url("superadmin/approval-surat/tambah-approval")
    );
    $("#" + modalApproval + " .password-field").css("display", "block");
});

$("#" + modalApproval).on("hidden.bs.modal", function () {
    titleAction("", base_url(""));
    tutupModal(modalApproval, "nama");
    tutupModal(modalApproval, "email");
    tutupModal(modalApproval, "password");
    tutupModal(modalApproval, "password_confirmation");
    $("#genderl").prop("checked", true);
    tutupModal(modalApproval, "gender");
    tutupModal(modalApproval, "phone");
    tutupModal(modalApproval, "jabatan");
    tutupModal(modalApproval, "ttd");
    $("#ttd-edit-text").css("display", "none");
    $("#ttd-edit-img").css("display", "none");
});

function editApproval(id) {
    titleAction(
        "Edit Approval",
        base_url("superadmin/approval-surat/edit-approval/" + id)
    );
    $("#" + modalApproval + " .password-field").css("display", "none");
    startloading("#" + modalApproval + " .modal-dialog");
    var settings = {
        url: base_url("api/v1/superadmin/approval-surat/" + id),
        method: "GET",
        dataType: "json",
        timeout: timeOut(),
    };

    $.ajax(settings)
        .done(function (response) {
            setVal(modalApproval, "nama", response?.data?.nama);
            setVal(modalApproval, "email", response?.data?.email);
            if (response?.data?.gender == "l") {
                $("#genderl").prop("checked", true);
            } else {
                $("#genderp").prop("checked", true);
            }
            setVal(modalApproval, "phone", response?.data?.phone);
            setVal(modalApproval, "jabatan", response?.data?.ttd?.jabatan_ttd);
            $("#ttd-edit-text").css("display", "inline");
            $("#ttd-edit-img").css("display", "block");
            $("#ttd-edit-img").attr("src", s3_url + response?.data?.ttd?.ttd);
            stoploading("#" + modalApproval + " .modal-dialog");
        })
        .fail(function (data, status, error) {
            stoploading("#" + modalApproval + " .modal-dialog");
        });
}

function hapusApproval(id) {
    link = base_url("superadmin/approval-surat/hapus/" + id);
    delConf(link);
}

// function deleteKop(id){
//     delConf(base_url('admin/mode_setting/delete/'+id))
// }

// function detailKop(id){
//     console.log(id)
//     startloading('#'+modalDetailKop+' .modal-content')
//     var settings = {
//         'url': base_url('admin/mode_setting/'+id),
//         'method': 'GET',
//         'dataType': 'json',
//         'timeout': timeOut()
//     };
//     $.ajax(settings).done(function (response) {
//         setHtmlVal(modalDetailKop, 'time', response?.data?.time/60+' Menit')
//         if(response?.data?.active == '1'){
//             var status = badge('success', 'Aktif')
//         } else {
//             var status = badge('danger', 'Non-Aktif')
//         }
//         setHtmlVal(modalDetailKop, 'active', status)
//         setHtmlVal(modalDetailKop, 'created_at', response?.data?.created_at)
//         setHtmlVal(modalDetailKop, 'update_at', response?.data?.update_at)
//         stoploading('#'+modalDetailKop+' .modal-content')
//     }).
//     fail(function(data, status, error){
//         if(status == 'timeout'){
//             CekKonfirmasi('Timeout!', '')
//         } else if(data.responseJSON.status == false){
//             CekKonfirmasi(data.responseJSON.message, '')
//         }
//         stoploading('#'+modalDetailKop+' .modal-content')
//     });
// }

function titleAction(title, action) {
    $("#" + modalApproval + " .modal-title").html(title);
    $("#" + modalApproval + " #" + formApproval).attr("action", action);
}

function tutupModal(modal, id) {
    $("#" + modal + " #" + id).val("");
    $("#" + modal + " #" + id).removeClass("is-invalid");
}
