$(function(){
	var note = $('#note'),
  	
  	//date - year, month, day - the month is zero based - i.e. 0 = jan, 1 = feb etc
  	//you'll want to edit this to be your blast off date
	ts = new Date(2014,8,12);

	$('#countdown').countdown({
		timestamp   : ts,
		callback    : function(days, hours, minutes, seconds){
			var message = "";
			message += days + " DAY" + ( days==1 ? '':'S' ) + ", ";
			message += hours + " HOUR" + ( hours==1 ? '':'S' ) + ", ";
			message += minutes + " MINUTE" + ( minutes==1 ? '':'S' ) + " & ";
			message += seconds + " SECOND" + ( seconds==1 ? '':'S' ) + "</br></br>";
			note.html(message);
		}
	});
 });