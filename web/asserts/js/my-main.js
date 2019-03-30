// JavaScript Document
			 d = new Date();
			if((d.getMonth()+1) < 9){
				month = "0"+(d.getMonth()+1);
			}else{
				month = (d.getMonth()+1);
			}
			var date = d.getDate() + "" + month + "" + d.getFullYear();
		

		function getdatesub(tag){
			var date = d.getDate() - tag + "" + month + "" + d.getFullYear();
			return date;
		}
		
		function getdateadd(tag){
			var date = d.getDate() + tag + "" + month + "" + d.getFullYear();
			return date;
		}

	

		


