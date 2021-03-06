<!DOCTYPEhtml>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/app/assets/css/main.css" media="all">
		<script src="/app/assets/js/prefixfree/prefixfree.min.js" type="application/javascript"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
		<!--script type="text/javascript" src="./../app/assets/js/script_main.js"> </script> -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
		<title>Embargo Portal</title>

		<script type="text/javascript">
			//Aesthetics script for the buttons on the left bar

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
				displayContent(selectedElementID);

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
					//alert("selected element is: "+selectedElementID);
					logClick(selectedElementID);
					displayContent(selectedElementID);
				}

				//function for logging - done through call to REST API on server
				function logClick(id){
						
						//get time and date
						var today = new Date();
						var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(); //Y-M-D format
						var time = today.getHours()+":"+today.getMinutes()+":"+today.getSeconds();
						var timeDate = date+ ' ' + time;
						//create json data
						var jsonData = {};
						jsonData["clicked_element"] = id;
						jsonData["time"] = timeDate;

						var jsonString = JSON.stringify(jsonData);

						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function(){
								if(this.readyState == 4 && this.status == 200){
										//for debugging
										//alert(this.responseText);
								}
						};

				
						var url = "142.93.32.127/../web/api/logs/create.php"; //change to match external URL of production server
						xhttp.open("POST",url,true);
						xhttp.setRequestHeader("Content-type", "application/json; charset=UTF-8");
						xhttp.send(jsonString);

						xhttp.onloadend = function(){
		
						};
						

				}

				//Content display based on what has been clicked
				function displayContent(selectedElementID){
					
					switch(selectedElementID){
						case "overview_element":
							//open html file
							callPHP("overview.php");
							setChart();
							break;

						case "click_logs":
							//open html file
							callPHP("click_logs.php");
							break;

						case "rss_feed":
							//open html file
							callPHP("rss_feed.php");
							break;

						case "analytics_element":
							//open html file
							callPHP("analytics.php");
							break;

						case "customers_element":
							//open html file
							callPHP("customers.php");
							break;

						case "rewards_element":
							//open html file
							callPHP("rewards.php");
							break;

						case "notifications_element":
							//open html file
							callPHP("notifications.php");
							break;

						case "marketing_element":
							//open html file
							callPHP("marketing.php");
							break;

					}
					
				}

				function callPHP(path){
					$.ajax({
						url: path,
						success: function(data){
							$('#main_content').html(data);
						}
					});
				}

				function setChart(){


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

					<div class="flexbox_section_element" id="click_logs">
						<div class="highlight_strip"></div>
						<i id="marketing_icon" class="material-icons section_icons">local_library</i>
						<div id="marketing_text" class="section_text">
							Click Logs
						</div>
					</div>

					<div class="flexbox_section_element" id="rss_feed">
						<div class="highlight_strip"></div>
						<i id="marketing_icon" class="material-icons section_icons">local_library</i>
						<div id="marketing_text" class="section_text">
							RSS Feed
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
			
							
			
				</div>
			</div>

			
		</div>
	</body>
</html>
