<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<style>

	/*Main Overview */

	#overview_flex{
		display: flex;
		flex-direction: column;
		height: 100%;
		width: 100%;
		justify-content: space-between;
		background: #F5F5F5;
	}

	#overview_totals{
		display: flex;
		flex-direction: row;
		width: 100%;
	  justify-content: space-evenly;
	}

	.overview_containers{
		display: flex;
		flex-direction: column;
		margin: 20px;
		padding:10px;
		border-radius: 5px;
		box-shadow: 0px 3px 7px rgba(0, 0, 0, .2);
		height: 50px;
		width: 50%;
		background: #FFFFFF;
	}

	.total_containers{
		display: flex;
		flex-direction: column;
		width: 100%;
	}

	#chart_container{
		background: #FFFFFF;
		box-shadow: 0px 3px 7px rgba(0, 0, 0, .2);
		margin: 20px;
		border-radius: 5px;
		
	}

	#chart_title{
		color: #6C727A;
		margin: 20px;
	}

	#overview_header{
		width:100%;
		height: 20px;
		padding: 20px;
		box-shadow: 0px 1px 2px rgba(0, 0, 0, .2);
		align-self: start;
		background: #FFFFFF;
		
	}


</style>

<div id="overview_flex">

	<div id="overview_header">
		Blueprint Cafe Overview
	</div>

	<div id="overview_totals"> 

		<div class="overview_containers">
			<div class="overview_strip"> </div> 
			<div id="total_visits" class="total_containers">
				<div id="total_visits_text">Total visits </div>
				<div id="total_visits_value"> </div>
			</div>
		</div>


		<div class="overview_containers">
			<div class="overview_strip"> </div> 
			<div id="total_claims" class="total_containers">
				<div id="total_claims_text">Total claims </div>
				<div id="total_claims_value"> </div>
			</div>
		</div>

	</div>



	<div id="chart_container" height: 60vh; width: 80%;">
			<div id="chart_title">Total Visits</div>
			<div class="ct-chart"></div>
	</div>


	<script type="text/javascript">
				//chart
			var data = {
				labels: ["May 2018","","","","","","","","","","", "Jun 2018","","","","","","","","", "Jul 2018","","","","","","","","", "Aug 2018","","","","","","","","", "Sep 2018"],
				series: [
					[0,2,4,4,5,5,6,7,8,9,15,29,60,120,130,150,151,153,153,155,160,170,190,210,215,220,225,230,232,233,239,250,252,253,254,255,259,260,261]
				]
			};

			var options={
				width: 1000,
				height: 350,
				showArea: true
			}

			new Chartist.Line('.ct-chart',data, options);
		</script>
	
</div>
