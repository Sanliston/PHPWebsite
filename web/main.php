<!DOCTYPEhtml>
<html>
	<head>
		<!--<link rel="stylesheet" type="text/css" href="./../app/assets/css/main.css" media="all"> -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
		<!--script type="text/javascript" src="./../app/assets/js/script_main.js"> </script> -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
		<title>Embargo Portal</title>
		<style>
					/*@font-face{
					font-family: alegreyaSansBold;
					src: url(../app/assets/fonts/alegreya-sans-sc.bold.ttf);
				}

				@font-face{
					font-family: kimberleyBlack;
					src: url(../app/assets/fonts/kimberley.black.ttf);
				}*/

				body{ /*body margin seems to vary from browser to browser */
					margin: 0;
					width: 100%;
					overflow-x: hidden;
				}

				#flexbox_main_global{
					display: flex;
					flex-direction: column;
					height: 99vh;
					width: 100%;
					justify-content: space-between;
	
				}

				#flexbox_main_header{
					display: flex;
					flex-direction: row;
					width: 100%;
					min-height: 30px;
					flex: 1.4;
					align-items: center;
					box-shadow: 0px 3px 7px rgba(0, 0, 0, .2);
					z-index: 2;
				}

				#header_logo_icon{
					font-size: 40px;
					margin-left: 10px;
					margin-right: 10px;
					color: #F11F62;
				}

				#header_title_text{
					color: #F11F62;
					font-size: 24px;
					font-family: alegreyaSansBold;
				}

				#flexbox_main_body{
					display: flex;
					flex-direction: row;
					width: 100%;
					min-height: 200px;
					flex: 19;
				}

				#flexbox_main_sections{
					display: flex;
					flex-direction: column;
					flex: 1;
					height: 100%;
					box-shadow: 1px 5px 7px rgba(0, 0, 0, .2);
					z-index: 0;
				}

				#main_content{
					flex: 4;
					height: 100%;
				}

				.flexbox_section_element{
					display: flex;
					flex-direction: row;
					width: 100%;
					height: 30px;
					padding-top: 10px;
					padding-bottom: 10px;
					align-items: center;
					transition: 0.00s;
				}

				.flexbox_section_element:hover{ /*When hovered icons and text should be set to black. When clicked - highlight strip should be set to color, and text and icons black */
					background: #F5F5F5;
				}

				i.section_icons{ /*Was having problems when just referring to the class, so decided to refer to the element type as well, hence i.section_icons as opposed to just .section_icons */
					font-size: 20px;
					margin-left: 10px;
					margin-right: 10px;
					margin-top: 7px;
					height: 100%;
					align-items: center;
					color: #95A0A8; 
				}

				.section_text{
					color: #6C727A;
					font-size: 14px; 
				}

				.highlight_strip{ /*Highlight strip color will need to be changed by JS, when the whole element is clicked, and removed when another element is clicked. */
					height: 100%;
					padding-top: 10px;
					padding-bottom: 10px;
					width: 4px;
					transition: 0.05s;
					background: #FFFFFF;
					align-self: center;
				}

				
		</style>

		<script type="text/javascript">
			//call JQUERY	


			$(document).ready(function(){

	
				//set global variables
				var selectedElementID = "";

				//set event handler for when section element is clicked
				var sectionElements = $(".flexbox_section_element");
	
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
		</script>
		
	</head>

	<body>
		<div id="flexbox_main_global"> <!--column -->

			<div id="flexbox_main_header"> <!-- row -->
				<i id="header_logo_icon" class="material-icons">terrain</i>
				<div id="header_title_text">
					EMBARGO	
				</div>
			</div>

			<div id="flexbox_main_body"> <!--row -->

				<div id="flexbox_main_sections"> <!-- column -->

					<div class="flexbox_section_element" id="overview_element">
						<div class="highlight_strip" id="overview_highlight_strip"></div>
						<i id="overview_icon" class="section_icons material-icons ">home</i>
						<div id="overview_text" class="section_text">
							Overview
						</div>
					</div>

					<div class="flexbox_section_element" id="analytics_element">
						<div class="highlight_strip"></div>
						<i id="analytics_icon" class="material-icons section_icons">bar_chart</i>
						<div id="analytics_text" class="section_text">
							Analytics
						</div>
					</div>

					<div class="flexbox_section_element" id="customers_element">
						<div class="highlight_strip"></div>
						<i id="customers_icon" class="material-icons section_icons">group</i>
						<div id="customers_text" class="section_text">
							Customers
						</div>
					</div>

					<div class="flexbox_section_element" id="rewards_element">
						<div class="highlight_strip"></div>
						<i id="rewards_icon" class="material-icons section_icons">card_giftcard</i>
						<div id="rewards_text" class="section_text">
							Rewards
						</div>
					</div>

					<div class="flexbox_section_element" id="notifications_element">
						<div class="highlight_strip"></div>
						<i id="notifications_icon" class="material-icons section_icons">notifications</i>
						<div id="notifications_text" class="section_text">
							Notifications
						</div>
					</div>

					<div class="flexbox_section_element" id="marketing_element">
						<div class="highlight_strip"></div>
						<i id="marketing_icon" class="material-icons section_icons">local_library</i>
						<div id="marketing_text" class="section_text">
							Marketing
						</div>
					</div>

				</div>

				<div id="main_content"> <!-- This will display content based on what section is clicked -->

						<?php
							//include("overview.php");
							include("web/api/members/read.php");

						?>				

				</div>
			</div>

			
		</div>
	</body>
</html>
