/**
 * Theme: Zircos Admin Template
 * Author: Coderthemes
 * Form Advanced
 */


 jQuery(document).ready(function () {

});

// Restricts input for the set of matched elements to the given inputFilter function.
(function($) {
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
  }(jQuery));

//Bootstrap-TouchSpin
$(".vertical-spin").TouchSpin({
    verticalbuttons: true,
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom",
    verticalupclass: 'ion-plus-round',
    verticaldownclass: 'ion-minus-round'
});

$("input[name='kapasitasIbadah']").TouchSpin({
    min: 5,
    max: 1000000,
    // step: 0.1,
    // decimals: 2,
    // boostat: 5,
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom",
    // maxboostedstep: 10,
});

$("input[name='demo1']").TouchSpin({
    min: 0,
    max: 100,
    step: 0.1,
    decimals: 2,
    boostat: 5,
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom",
    maxboostedstep: 10,
    postfix: '%'
});
$("input[name='demo2']").TouchSpin({
    min: -1000000000,
    max: 1000000000,
    stepinterval: 50,
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom",
    maxboostedstep: 10000000,
    prefix: '$'
});
$("input[name='demo3']").TouchSpin({
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom"
});
$("input[name='demo3_21']").TouchSpin({
    initval: 40,
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom"
});
$("input[name='demo3_22']").TouchSpin({
    initval: 40,
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom"
});

$("input[name='demo5']").TouchSpin({
    prefix: "pre",
    postfix: "post",
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom"
});
$("input[name='demo0']").TouchSpin({
    buttondown_class: "btn btn-custom",
    buttonup_class: "btn btn-custom"
});