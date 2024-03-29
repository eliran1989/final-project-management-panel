


$(document).ready(function () {

$("#subDetails .modal").bind('hidden.bs.modal',function(){
$("#subDetails").load("views/subs/subDetails.html");
});  



 $(".showSubDetails").click(function () {
        $.post("index.php?section=subs&action=showSubDetails",{

            id: $(this).attr('id')

        }, function (data, status) {
                 var data =JSON.parse(data);
                 var icon ='<span class="glyphicon glyphicon-list-alt"></span> ';
             //check if subscriber is active and active/disabled tabs
             if (data['active']){
                 var status = '<td><span class="label label-success">פעיל</span></td>';
                 $("#registerStudio input[name='id']").val(data['id'])
                 disableTab("updateReg");
                 showTab("profile");
             }
             else{
                 var status = '<td><span class="label label-danger">לא פעיל</span></td>';
                 showTab("updateReg");
                 disableTab("registerStudio");
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
                      "minDate": moment().subtract(70, 'year'),
                     "showDropdowns": true
                    });

 
                }


                $(this).val(data[$(this).attr("id")]);
             });



             
         });


    $.post("index.php?section=studio&action=getStudioBySub",{

        id: $(this).attr('id')


    }, function (data, status){

           var data =JSON.parse(data);
           if (data.length == 0 )
           {
            $("#currentStudios").html("<strong>המנוי אינו רשום לאף שיעור סטודיו</strong>");
           }
           else{

            $("#currentStudios").html("<strong>שיעורי סטודיו פעילים: </strong>");

             for (i=0 ;i<data.length ;i++){
                     $("#currentStudios").append(' <span class="label label-info" id="'+data[i]['id']+'">'+data[i]['lesson']+'</div>');

                 

             }

           }

    });




    $.post("index.php?section=studio&action=getStudioList",{


    }, function (data, status){
           var data =JSON.parse(data);
            $("#studio-list").empty();
            $("#studio-list").append("<option value='' display selected style='display:none;'> רשימת שיעורים</option>");

            for (var cat in data) {
               

                currentStudios = $("#currentStudios").text();

                for (i=0; i<data[cat].length ; i++){

                     if(i==0 && !currentStudios.includes(data[cat][i].lesson_name)){
                        $("#studio-list").append('<optgroup label = "'+cat+'"></optgroup>');
                     }

                 if (!currentStudios.includes(data[cat][i].lesson_name))
                 $("#studio-list").append('<option value="'+data[cat][i].id+'">'+data[cat][i].lesson_name+'</option>');  
                 }

            }
  
    });






    $("#subDetails .modal").modal("show");

       

    });




    $("#studio-list").change(function(){
        $("#lessons-time table tbody").empty();

    $.post("index.php?section=studio&action=getLessonByStudioId",{
        studioID: $(this).val()
    }, function (data, status){

           var data =JSON.parse(data);

            for (i=0 ;i<data.length ;i++){


                $("#lessons-time table tbody").append("<tr><td class='text-center'>"+data[i].day+"</td><td class='text-center'>"+data[i].time+"</td></tr>");

            }

  
    });




        $("#lessons-time").fadeIn();
        $("#btn-studio-register").fadeIn();



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




function showTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};


function disableTab(tab){

    $( 'a[href*="#'+tab+'"]' ).parent().addClass("disabled");
    $( 'a[href*="#'+tab+'"]' ).removeAttr("data-toggle"); 
    $( 'a[href*="#'+tab+'"]' ).removeAttr("href"); 

}


});