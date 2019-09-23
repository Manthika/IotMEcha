$(document).ready(function(){
	$.ajax({
		url : "data.php",
		type : "GET",
		//dataType:'jsonp',
		//crossDomain:true,
		headers: {"X-My-Custom-Header": "some value"},
		success : function(data){
			console.log(data);
            var idt = []
			var sensors1 =[]
			var sensors2 =[]
			var sensors3 =[]
			var date=[]

       var  dat=$.parseJSON(data);
for (var key in dat) {
    if (dat.hasOwnProperty(key)) {
      idt.push(dat[key]["id"]  );
	  sensors1.push(dat[key]["sensor1"]);
	  date.push(dat[key]["event"]  );
	  sensors3.push(dat[key]["sensor3"]);
	  sensors2.push(dat[key]["sensor2"]);
    }
  }
			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "Machine State",
						fill: false,
						lineTension: 0.1,
						backgroundColor: 'rgba(50, 255, 0, 0.75)',
						borderColor: 'rgba(50, 255, 0, 0.75)',
						pointHoverBackgroundColor: "rgba(50, 255, 0, 1)",
						pointHoverBorderColor: "rgba(50, 255, 0, 1)",
						data: sensors1
					},
					/*{
						label: "Temperature",
						fill: false,
						lineTension: 0.1,
						backgroundColor: 'rgba(255, 100, 0, 0.75)',
						borderColor: 'rgba(255, 100, 0, 0.75)',
						pointHoverBackgroundColor: "rgba(255, 100, 0, 1)",
						pointHoverBorderColor: "rgba(255, 100, 0, 1)",
						data: sensors2
					},
					 {
					   label: "sensor3",
						fill: false,
						lineTension: 0.1,
						backgroundColor: 'rgba(50, 50, 255, 0.75)',
						borderColor: 'rgba(50, 50, 255, 0.75)',
						pointHoverBackgroundColor: "rgba(50, 50, 255, 1)",
						pointHoverBorderColor: "rgba(50, 50, 255, 1)",
						data: sensors3
					}
					*/
					
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error : function(data) {

		}
	});
});

var xhr = new XMLHttpRequest();
xhr.open("GET", "data.php", true);
xhr.setRequestHeader("X-My-Custom-Header", "some value");
xhr.onload = function () {
    console.log(xhr.responseText);
};
xhr.send();