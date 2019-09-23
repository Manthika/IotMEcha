function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
		
		var ap;
		var sal;
		
        if(h<10)
        {
               h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
		if(h<12 &&m<60 &&s<60)
		{
			
			ap='AM';
			//sal='Good Morning!';
		}
			else
			{
				
				ap='PM';
				if(h>=13)
				{
					h=h-12;
					//sal='Good Afternoon!';
					if(h>5 &&s>0)
					{
						//sal='Good Evening!';
					}
				}
			}  
			
		 
		
       // result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
       // document.getElementById(id).innerHTML = result;
		
		document.getElementById('time').innerHTML=""+h+" : "+ m +" : "+s+" " +ap ; 
		
		document.getElementById('dt').innerHTML= days[day]+" ,"+months[month]+" "+d+", "+year;
		//document.getElementById('salute').innerHTML=sal;
		
        setTimeout('date_time("'+id+'");','1000');
        return true;
}