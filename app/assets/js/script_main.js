//call JQUERY	


$(document).ready(function(){

	
	//set global variables
	var selectedElementID = "";

	//set event handler for when section element is clicked
	var sectionElements = $(".flexbox_section_element");
	alert("document loaded, section elements obtained: "+ sectionElements.length);
	
	//set initial section element
	var sectionElement = $("#overview_element");
	var highlightStrip = sectionElement.children(".highlight_strip");
	var sectionIcon = sectionElement.children(".section_icons");
	var sectionText = sectionElement.children(".section_text");
			
	sectionElement.css({"background":"#F5F5F5"});
	sectionIcon.css({"color":"#000000"});
	highlightStrip.css({"background":"#F11F62"});
	sectionText.css({"color":"#000000"});

	selectedElementID = sectionElement.attr("id");

	//set event listeners
	for(var i=0; i<sectionElements.length; i++){
		sectionElements.eq(i).on("click", sectionElements.eq(i) ,sectionClickEvent);
		sectionElements.eq(i).on("mouseenter", sectionElements.eq(i) ,sectionMouseEnterEvent);
		sectionElements.eq(i).on("mouseleave", sectionElements.eq(i) ,sectionMouseLeaveEvent);
	}

	function sectionMouseEnterEvent(element){

		//get the hovered section element and set the color to #F5F5F5
		var sectionElement = $(this);

		sectionElement.css({"background":"#F5F5F5"});
	}

	function sectionMouseLeaveEvent(element){
				//Set all other section elements to white background, with exception of currently selected element.
		var arrayLength = sectionElements.length;

		for(var i = 0; i<arrayLength; i++){
			var sectionElementOld = sectionElements.eq(i);
			
			if(selectedElementID != sectionElementOld.attr("id")){
				sectionElementOld.css({"background":"#FFFFFF"});
			}
			

		}
	}

	
	function sectionClickEvent(element){

		
		console.log("clicked"+$(this).attr("id"));
		
		//Set all other highlight strips to default color (white).
		var arrayLength = sectionElements.length;

		for(var i = 0; i<arrayLength; i++){
			var sectionElementOld = sectionElements.eq(i);
			var highlightStripOld = sectionElementOld.children(".highlight_strip");
			var sectionIconOld = sectionElementOld.children(".section_icons");
			var sectionTextOld = sectionElementOld.children(".section_text");
			
			sectionElementOld.css({"background":"#FFFFFF"});
			sectionIconOld.css({"color":"#95A0A8"});
			highlightStripOld.css({"background":"#FFFFFF"});
			sectionTextOld.css({"color":"#6C727A"});

			
		}


		//get the current highlight strip, and set color to pink/red
		var sectionElement = $(this);
		var highlightStrip = sectionElement.children(".highlight_strip");
		var sectionIcon = sectionElement.children(".section_icons");
		var sectionText = sectionElement.children(".section_text");
			
		sectionElement.css({"background":"#F5F5F5"});
		sectionIcon.css({"color":"#000000"});
		highlightStrip.css({"background":"#F11F62"});
		sectionText.css({"color":"#000000"});

		selectedElementID = sectionElement.attr("id");
	}

	//function for logging
	function logClick(id){

		switch(id){
			
		}

	}


});


