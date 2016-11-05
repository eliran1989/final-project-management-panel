$(document).ready(function(){




  $.get("index.php?sectiotraining&action=getMuscles",{},function (data, status)
      {
            data = JSON.parse(data);


            $(".muscles").each(function(){

             for (var i=0 ; i<data.length ; i++)
              {
                if ($(this).find("option").val()==data[i].name)
                  continue;
                $(this).append("<option value='"+data[i].name+"'>"+data[i].name+"</option>");
              }

            });


                panelTraining = $("#training .col-md-12:first").clone();
                C = setType(panelTraining ,"C");
                D = setType(panelTraining ,"D");

      });  




  $(".exercises").each(function(){
        var exerciseList =$(this);

        $.get("index.php?sectiotraining&action=getExercise",
        {muscleName: exerciseList.parent().prev().find(".muscles").val()},
        function (data, status) {
            data = JSON.parse(data);

            for (var i=0 ; i<data.length ; i++)
            {
            if (exerciseList.find("option").val()==data[i].name)
             continue;

             exerciseList.append("<option value='"+data[i].name+"'>"+data[i].name+"</option>");
            }

         });  
        
}); 



  $("select[name='purpose']").change(function(){
    if ($(this).val()=="other")
    {
   	  $(this).parent().next().removeAttr("disabled");
      $(this).parent().next().attr("value" , "");
    }
    else
    {
      $(this).parent().next().attr("disabled" , "");
      $(this).parent().next().attr("value" , "");
    }
   	  

    });




  $("select[name='trainingType']").change(function(){
      var typeLength = $("#training .col-md-12").length;
      

      switch($(this).val()) {

          case "AB":
             if (typeLength==2)
                return false;
             $("#training .col-md-12:eq(1)").nextAll().remove();
          break;

          case "ABC":
              if (typeLength==3)
                return false;

              if (typeLength==2)
                $("#training").append(C);

              if (typeLength==4)
                $("#training .col-md-12:eq(2)").nextAll().remove();
          break;

          case "ABCD":
               if (typeLength==4)
                 return false;

               if (typeLength==3)
                 $("#training").append(D);

               if (typeLength==2)
                $("#training").append(C+D);
          break;

           default:
      }

});

 $("#training").on("click" , ".plusBtn", function (){
   var row = $(this).parent().prev().find("tbody tr:first").clone();
   var table =$(this).parent().prev().find("tbody");

   $(this).next().removeClass("disabled");

   var numOfRow = $(this).parent().prev().find("tbody tr").length;

   for (j=0 ; j<2 ; j++)
    for (i=0 ; i<2; i++)
    {
      select_input = (j==1) ? "select": "input";
        row.find(select_input+":eq("+i+")").attr("name" , row.find(select_input+":eq("+i+")").attr("name").replace("1", ""+(numOfRow+1)));
    }
    

   row.find("input").attr("value" , "");

    row.find("td:first").text(numOfRow+1);

   row.find(".muscles").prepend("<option value='' selected style='display:none;' ></option");
   row.find(".exercises").prepend("<option value='' selected style='display:none;'></option").attr("disabled" ,"");

table.append("<tr>"+row.html()+"</tr>");

});


$(".minusBtn").each(function(){

if ($(this).parent().prev().find("tbody tr").length>1)
  $(this).removeClass("disabled");

});



$("#training").on("click" , ".minusBtn", function (){
    $(this).parent().prev().find("tbody tr:last").hide();
    $(this).parent().prev().find("tbody tr:last").remove();

    if ($(this).parent().prev().find("tbody tr").length == 1)
     $(this).addClass("disabled");
});



function setType (panel , letter)
{
  panel.find(".panel-heading").text("אימון "+letter);
  panel.find("select:eq(0)").attr("name" , letter+"_muscle_1");
  panel.find("select:eq(1)").attr("name" , letter+"_exercise_1");
  panel.find("input:eq(0)").attr("name" , letter+"_sets_1").attr("value","");
  panel.find("input:eq(1)").attr("name" , letter+"_repeated_1").attr("value","");

  panel.find(".minusBtn").addClass("disabled");

  panel.find("input:eq(1)").parent().parent().nextAll().remove();

   panel.find(".muscles").append("<option selected style='display:none;' value=''></option");
   panel.find(".exercises").append("<option selected style='display:none;' value=''></option").attr("disabled" ,"");


  return "<div class='col-md-12'>"+panel.html()+"</div>"
} 

    $("#training").on("change" ,".muscles" , function(){

       var muscle =$(this).val();
       var exerciseSelect = $(this).parent().next().find(".exercises");
       exerciseSelect.removeAttr("disabled");

       exsriceList(muscle , exerciseSelect);

      });


    function exsriceList(muscle , exerciseSelect){
       $.get("index.php?sectiotraining&action=getExercise",
        {muscleName: muscle},
        function (data, status) {
            data = JSON.parse(data);

            exerciseSelect.html("");
            for (var i=0 ; i<data.length ; i++)
              exerciseSelect.append("<option value='"+data[i].name+"'>"+data[i].name+"</option>");
         }); 
         }





});