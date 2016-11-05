$(document).ready(function(){

  $.get("index.php?section=reports&action=sexBreakDown",
        {
      
        },
         function (sexBreak, status) {
         sexBreak = JSON.parse(sexBreak);
            
    		$("#label1").text(sexBreak['man']);
    		$("#label2").text(sexBreak['woman']);
           
            var data = [
				{
					value:sexBreak['man'],
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "גברים"
				},
				{
					value: sexBreak['woman'],
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "נשים"
				}

			];	

		var options ={
			animationEasing: "easeInOutQuint"

		};	

		var ctx = $("#myChart").get(0).getContext("2d");
		window.myPie = new Chart(ctx).Pie(data,options);
            	
       
         }); 








		});