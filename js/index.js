$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "http://192.168.3.148/Events.csv",
        dataType: "text",
        success: function(data) { renderPage(data);}
     });
});




			
function renderPage( data ){
	
	var itemData = processData( data );
	var entries = "";
	for (var q in itemData){
		var entryObject = itemData[q];
		if (undefined != entryObject['photo']) {
			var imgURL = entryObject['photo'];
			var timeStamp = entryObject['time'];
			entries += "<div class='entry'> \
				<img class='historyPhoto' src='" + imgURL + "'>\
				<div>" + timeStamp + "</div>\
			</div>";
			console.log(entries);
		}
	}
	all_entries.innerHTML = entries;
}

var importedData = [];
function processData(allText) {
	
    var allTextLines = allText.split(/\r\n|\n/);

    var lines = [];

	var results = [];
    for (var i=1; i<allTextLines.length; i++) {
        var data = allTextLines[i].split(', ');
        
		results.push(		
		{
			date : new Date(),
			time : data[1],
			photo : data[2]
		}
		);
    }
	return results;

}
