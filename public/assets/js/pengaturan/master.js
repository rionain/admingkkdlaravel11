let id_kop = "",
    id_body1 = "",
    id_body2 = "",
    id_body3 = "",
    id_body4 = "",
    id_body5 = "",
    id_approval1 = "",
    id_approval2 = "";
let id_approval3 = "",
    id_tembusan = "",
    id_footer = "";

$("#masterModal" + " .body-picker-2").css("display", "none");
$("#masterModal" + " .body-picker-3").css("display", "none");
$("#masterModal" + " .body-picker-4").css("display", "none");
$("#masterModal" + " .body-picker-5").css("display", "none");
$("#masterModal" + " .approval-2").css("display", "none");
$("#masterModal" + " .approval-3").css("display", "none");

$("#bodyPicker1").on(
    "changed.bs.select",
    function (e, clickedIndex, newValue, oldValue) {
        console.log(this.value, clickedIndex, newValue, oldValue);
        if (this.value != 0) {
            $("#masterModal" + " .body-picker-2").css("display", "block");
        } else {
            $("#masterModal" + " .body-picker-2").css("display", "none");
            spVal("bodyPicker2", "0");
            $("#masterModal" + " .body-picker-3").css("display", "none");
            spVal("bodyPicker3", "0");
            $("#masterModal" + " .body-picker-4").css("display", "none");
            spVal("bodyPicker4", "0");
            $("#masterModal" + " .body-picker-5").css("display", "none");
            spVal("bodyPicker5", "0");
        }
    }
);
$("#bodyPicker2").on(
    "changed.bs.select",
    function (e, clickedIndex, newValue, oldValue) {
        console.log(this.value, clickedIndex, newValue, oldValue);
        if (this.value != 0) {
            $("#masterModal" + " .body-picker-3").css("display", "block");
            // $('#bodyPicker1').prop('disabled', true);
            // $('#bodyPicker1').selectpicker('refresh');
        } else {
            $("#masterModal" + " .body-picker-3").css("display", "none");
            spVal("bodyPicker3", "0");
            $("#masterModal" + " .body-picker-4").css("display", "none");
            spVal("bodyPicker4", "0");
            $("#masterModal" + " .body-picker-5").css("display", "none");
            spVal("bodyPicker5", "0");
        }
    }
);
$("#bodyPicker3").on(
    "changed.bs.select",
    function (e, clickedIndex, newValue, oldValue) {
        console.log(this.value, clickedIndex, newValue, oldValue);
        if (this.value != 0) {
            $("#masterModal" + " .body-picker-4").css("display", "block");
        } else {
            $("#masterModal" + " .body-picker-4").css("display", "none");
            spVal("bodyPicker4", "0");
            $("#masterModal" + " .body-picker-5").css("display", "none");
            spVal("bodyPicker5", "0");
        }
    }
);
$("#bodyPicker4").on(
    "changed.bs.select",
    function (e, clickedIndex, newValue, oldValue) {
        console.log(this.value, clickedIndex, newValue, oldValue);
        if (this.value != 0) {
            $("#masterModal" + " .body-picker-5").css("display", "block");
            // $('#bodyPicker1').prop('disabled', true);
            // $('#bodyPicker1').selectpicker('refresh');
        } else {
            $("#masterModal" + " .body-picker-5").css("display", "none");
            spVal("bodyPicker5", "0");
        }
    }
);

$("#approval1").on(
    "changed.bs.select",
    function (e, clickedIndex, newValue, oldValue) {
        console.log(this.value, clickedIndex, newValue, oldValue);
        if (this.value != 0) {
            $("#masterModal" + " .approval-2").css("display", "block");
        } else {
            $("#masterModal" + " .approval-2").css("display", "none");
            spVal("approval2", "0");
            $("#masterModal" + " .approval-3").css("display", "none");
            spVal("approval3", "0");
        }
    }
);
$("#approval2").on(
    "changed.bs.select",
    function (e, clickedIndex, newValue, oldValue) {
        console.log(this.value, clickedIndex, newValue, oldValue);
        if (this.value != 0) {
            $("#masterModal" + " .approval-3").css("display", "block");
        } else {
            $("#masterModal" + " .approval-3").css("display", "none");
            spVal("approval3", "0");
        }
    }
);

function lihatSurat() {
    let stringSurat;
    let upperinput;

    let kop = jsonParsing("kopPicker");
    if (kop != "0") {
        id_kop = kop.kop_id;
        kop = kop.headerdescription;
    }
    let body1 = jsonParsing("bodyPicker1");
    if (body1 != "0") {
        id_body1 = body1.template_body_id;
        body1 = body1.html_body;
    }
    let body2 = jsonParsing("bodyPicker2");
    if (body2 != "0") {
        id_body2 = body2.template_body_id;
        body2 = body2.html_body;
    }
    let body3 = jsonParsing("bodyPicker3");
    if (body3 != "0") {
        id_body3 = body3.template_body_id;
        body3 = body3.html_body;
    }
    let body4 = jsonParsing("bodyPicker4");
    if (body4 != "0") {
        id_body4 = body4.template_body_id;
        body4 = body4.html_body;
    }
    let body5 = jsonParsing("bodyPicker5");
    if (body5 != "0") {
        id_body5 = body5.template_body_id;
        body5 = body5.html_body;
    }

    let approval1 = jsonParsing("approval1");
    if (approval1 != "0") {
        id_approval1 = approval1.ttd_id;
        approval1 = approval1.ttd;
    }
    let approval2 = jsonParsing("approval2");
    if (approval2 != "0") {
        id_approval2 = approval2.ttd_id;
        approval2 = approval2.ttd;
    }
    let approval3 = jsonParsing("approval3");
    if (approval3 != "0") {
        id_approval3 = approval3.ttd_id;
        approval3 = approval3.ttd;
    }
    let tembusan = jsonParsing("tembusan");
    if (tembusan != "0") {
        id_tembusan = tembusan.tembusan_id;
        tembusan = tembusan.tembusan_text;
    }
    let footer = jsonParsing("footer");
    if (footer != "0") {
        id_footer = footer.template_footer_id;
        footer = footer.footer;
    }

    // let approval2 = jsonParsing('approval2')
    // let approval3 = jsonParsing('approval3')
    // let tembusan = jsonParsing('tembusan')
    // let footer = jsonParsing('footer')

    upperinput = `<table><tr><td style='padding: 4px 16px 4px 4px'>No</td><td>:${nosurat}</td></tr><tr><td style='padding: 4px 16px 4px 4px'>Perihal</td><td>:${perihal}</td></tr></table><br>`;
    greetinginput = `<p>Kepada Yth, <br><b>${tujuan}</b><br>Di Tempat</p>`;
    tanggalinput = `<p style='text-align: center'>Bandung, ${tanggalapprove}<br>BADAN PENGURUS HARIAN SINODE GKKD</p>`;
    tandaTangan =
        `<div style="padding: 12px;display: flex; flex-direction: row; justify-content: center">
    ` +
        ttdAda("approval1") +
        ttdAda("approval2") +
        ttdAda("approval3") +
        `
    </div>`;
    tembusantext =
        `<table style='vertical-align: top'><tr><td style='vertical-align: top'>Tembusan</td><td style= 'vertical-align: top; padding: 0 12px'>:</td><td>` +
        isNull(tembusan) +
        `</td></tr></table>`;

    stringSurat =
        isNull(kop) +
        upperinput +
        isNull(body1) +
        isNull(body2) +
        isNull(body3) +
        isNull(body4) +
        isNull(body5) +
        tanggalinput +
        tandaTangan +
        tembusantext +
        isNull(footer);
    // stringSurat = isNull(kop.headerdescription)+upperinput+isNull(body1.html_body)+isNull('bodyPicker2')+isNull('bodyPicker3')+tanggalinput+tandaTangan+tembusan+isNull('footer');
    $(".panel-body").html(stringSurat);
}

function simpanMaster() {
    console.log($("#kopPicker").val());
}

function isNull(html) {
    if (html != "0") {
        return html;
    }
    return "";
}

function jsonParsing(id) {
    if ($("#" + id).val() != "0") {
        let data = JSON.parse($("#" + id).val());
        return data;
    }
    return $("#" + id).val();
}

function ttdAda(id) {
    if ($("#" + id).val() != "0") {
        let ttd = JSON.parse($("#" + id).val());
        const image = s3_url + ttd.ttd;
        return (
            `<div style="flex: 1; text-align: center">
        <img style='padding: 8px;object-fit:contain;' src='${image}' height='120px'><br>
        <p><b>` +
            ttd.nama_ttd +
            `</b><br>` +
            ttd.jabatan_ttd +
            `</p></div>`
        );
    }
    return "";
}
// $(document).ready(function () {

// });
