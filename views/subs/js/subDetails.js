


$(document).ready(function () {

$("#subDetails .modal").bind('hidden.bs.modal',function(){
$("#subDetails").load("views/subs/subDetails.html");
});  


 $(".showSubDetails").click(function () {
        $.post("index.php?section=subs&action=showSubDetails",
        {
            id: $(this).attr('id')
        },
         function (data, status) {
             var data =JSON.parse(data);
             var icon ='<span class="glyphicon glyphicon-list-alt"></span> ';

             if (data['active']){
             var status = '<td><span class="label label-success">פעיל</span></td>';
             $( 'a[href*="#updateReg"]' ).parent().addClass("disabled");
             $( 'a[href*="#updateReg"]' ).removeAttr("data-toggle"); 
            $( 'a[href*="#updateReg"]' ).removeAttr("href"); 
             activaTab("profile");
             }
             else{
             var status = '<td><span class="label label-danger">לא פעיל</span></td>';
             activaTab("updateReg");
             $("#updateRegForm input[name='id']").val(data['id'])
             }
             $("#subName").html(icon+data["firstName"]+" "+data["lastName"]+"<div><small>"+data["id"]+"<br>"+status+"</small></div>");

             $("#detailsUpdate input").each(function (){

                if ($(this).attr("type")=="hidden")
                    return ;

                if ($(this).attr("id")=="birthDate"){
                    $(".birthDatePicker").daterangepicker({
                     "autoApply": true, 
                     "opens": "center",
                     singleDatePicker: true,
                     "maxDate": moment().subtract(14, 'year'),
                     "locale": {"format": "DD-MM-YYYY"},
                     "startDate": data["birthDate"],
                     "showDropdowns": true
                    });

 
                }


                $(this).val(data[$(this).attr("id")]);
             });


             $("#subDetails .modal").modal("show");
             
         });




    });




$("#editDetails").click(function (){


             $("#detailsUpdate input").each(function (){
                if ($(this).attr("id")!= "id" )
                    $(this).removeAttr("readonly");

                if ($(this).attr("id")== "birthDate" )
                    $(this).removeAttr("disabled");

             });
             $(this).parent().html("<button class='btn btn-info' type='submit' form='detailsUpdate'><span class='glyphicon glyphicon-ok'></span> שמור שינויים</button>");
             $(this).remove();





});


$("#updateBtn").click(function(){


             $("#detailsUpdate input").each(function (){
                if ($(this).attr("id")!= "id" )
                    $(this).removeAttr("readonly");

                if ($(this).attr("id")== "birthDate" )
                    $(this).removeAttr("disabled");

             });

})




function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};


});