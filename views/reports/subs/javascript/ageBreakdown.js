$(document).ready(function(){

  $.get("index.php?section=reports&action=agesBreakDown",
        {
      
        },
         function (ageBreak, status) {
         ageBreak = JSON.parse(ageBreak);

    
    		$("#label1").text(ageBreak['14_20']);
    		$("#label2").text(ageBreak['21_30']);
    		$("#label3").text(ageBreak['31_40']);
    		$("#label4").text(ageBreak['41_50']);
    		$("#label5").text(ageBreak['50+']);
           
            var data = [
				{
					value:ageBreak['14_20'],
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "גילאי 14-20"
				},
				{
					value: ageBreak['21_30'],
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "גילאי 21-30"
				},
				{
					value: ageBreak['31_40'],
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "גילאי 31-40"
				},
				{
					value: ageBreak['41_50'],
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "גילאי 41-50"
				},
				{
					value: ageBreak['50+'],
					color: "#4D5360",
					highlight: "#616774",
					label: "גילאי 50 ומעלה"
				}

			];	

		var options ={
			animationEasing: "easeInOutQuint"

		};	

		var ctx = $("#agesBreakDown").get(0).getContext("2d");
		window.myPie = new Chart(ctx).Pie(data,options);
            	
       
         }); 








		});