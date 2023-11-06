$(document).ready(function(){
    $(".save").on("click",function(e){
      var newSlots = $(e.target).parent().parent().children().find(".form-control-user").val();
      console.log(newSlots);
      $("#hiddenInput").val(newSlots);
      console.log($("#hiddenInput").val());
      var modal = $($(e.target).data("target"))
      console.log(modal)
      modal.children().find("#hiddenInput").val(newSlots);
    })
  })