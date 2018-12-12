// On page load
$(window).load(columnHeight);

// On window resize
$(window).resize( function () {
    // Clear all forced column heights before recalculating them after window resize
    $("#primary").css("height", "");  
    $("#secondary").css("height", "");
    $("#tertiary").css("height", "");
    columnHeight();
});

// Make columns 100% in height
function columnHeight() {
    // Column heights should equal the document height minus the header height and footer height
    var newHeight = $(document).height() - $(".site-header").height() - $(".site-footer").height() + "px";
    $("#primary").css("height", newHeight);
    $("#secondary").css("height", newHeight);
    $("#tertiary").css("height", newHeight);
}

// *********************** FormFields js***************
// $(document).ready(function(){
//     var next = 1;
//     $(".add-more").click(function(e){
//         e.preventDefault();
//         var addto = "#field" + next;
//         var addRemove = "#field" + (next);
//         next = next + 1;
//         var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
//         var newInput = $(newIn);
//         var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
//         var removeButton = $(removeBtn);
//         $(addto).after(newInput);
//         $(addRemove).after(removeButton);
//         $("#field" + next).attr('data-source',$(addto).attr('data-source'));
//         $("#count").val(next);
//
//         $('.remove-me').click(function(e){
//             e.preventDefault();
//             var fieldNum = this.id.charAt(this.id.length-1);
//             var fieldID = "#field" + fieldNum;
//             $(this).remove();
//             $(fieldID).remove();
//         });
//     });
//
//
//
// });

