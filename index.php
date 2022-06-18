<?php 
include('functions.php') 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="image/favicon.png" size="16x16" type="image/x-icon"/>
<meta name="viewport" content="width=devive-width, initial-scale=1">
<title>home</title>
<style>

/* Slideshow container */
.slideshow-container {
  max-width: 100%;
  position: relative;
  margin: auto;
}

/* Fading animation */
.fade-in {
  -webkit-animation: fadeinout 10s linear;
  -moz-animation: fadeinout 10s linear forwards;
  -o-animation: fadeinout 10s linear forwards;
  -ms-animation: fadeinout 10s linear forwards;
  animation: fadeinout 10s easy-ease;
 
}

@-webkit-keyframes fadeinout {
  0% {opacity: 0}
  12.5% {opacity: 1}
  87.5% {opacity: 1}
  100% {opacity: 0}
}

@-moz-keyframes fadeinout {
  0% {opacity: 0} 
  12.5% {opacity: 1}
  87.5% {opacity: 1}
  100% {opacity: 0}
}

@-o-keyframes fadeinout {
  0% {opacity: 0} 
  12.5% {opacity: 1}
  87.5% {opacity: 1}
  100% {opacity: 0}
}

@-ms-keyframes fadeinout {
  0% {opacity: 0} 
  12.5% {opacity: 1}
  87.5% {opacity: 1}
  100% {opacity: 0}
}

@keyframes fadeinout {
  0% {opacity: 0} 
  12.5% {opacity: 1}
  87.5% {opacity: 1}
  100% {opacity: 0} 
}
a {text-decoration:none;
color:#f9f6f3;
margin: 20px;
transition: color 1s;

}
ul {
	display: inline;
	margin: 0;
	padding: 0;
	}
ul li {
		display: inline-block;
		padding: 10px;
		}
ul li:hover {
			background: #998675;
			color: #c7b299;
			
			}


a:hover {
		color: #c7b299;
		}

@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>


<script type="text/javascript">
var bodyText=["Always have a layer more prepared - just in case, it is never wrong to move with a thin jacket.", "Wear comfortable clothes.", "Have a daypack with you.", "Mark your luggage.", "</p><p>Sit in front of the bus.", "Enter the bus as early as possible.", "<h3>Be on time</h3><p>It's logical - If you arrive too late, your bus is probably already gone. Especially those who leave from places they aren't familiar with should arrive at the terminal at least half an hour before departure."]
function generateText(sentenceCount){
for (var i=0; i<sentenceCount; i++)
document.write(bodyText[Math.floor(Math.random()*7)]+" ")
}
</script>




</head>
<body>

<div style="position:absolute; top:0px; width:auto; height:800px; background: #f4e6d5; z-index:1">
			<div style="position:relative; top:10px; width:100%">
				<img src="image/Kayoola.jpg" alt="travel banner" style="width:auto; zoom:113%">
				<div style="position:absolute; top:0px; width:100%; height:182px; border-bottom:5px solid #736357" >
					<div style="position:absolute; bottom:0px; right:80px; width:auto">
					  <ul>
						<li><a href="login.php"><b><span >Sign In</span></b></a></li> 
						<li><a href="register.php"><b><span >Sign Up</span></b></a></li>
						
						
					  </ul>
					</div>
				</div>
				<div style="position:absolute; top:200px; width:100%">
				<div class="slideshow-container">

<div class="mySlides fade-in">
 
  <img src="image/KAYO.jpg" alt="travel back ground 1" style="width:auto; zoom:113%">
  
</div>


<div class="mySlides fade-in">
 
  <img src="image/GAL.jpg" alt="travel back ground 2" style="width:auto; zoom:113%">
  
</div>



<div class="mySlides fade-in">
 
  <img src="image/KAYO.jpg" alt="travel back ground 3" style="width:auto; zoom:113%">
  
</div>


<div class="mySlides fade-in">
  
  <img src="image/GAL.jpg" alt="travel back ground 4" style="width:auto; zoom:113%">
  
</div>


</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 

</div>
					<!-- Routes table section -->
					<div style="position:absolute; left:2px; top:10px; width:50%; height:280px; background: rgba(244, 230, 213, 0.7); padding: 20px;">
						<div style="position:absolute; left:42%; top:10px;">
							<ul>
						<li><a href="addres"><b><span >ROUTES</span></b></a></li> 
					  </ul>
						</div>
						<br><br>
						<hr>
<!-------------------------------------------------------------------------->
                        <table border="1">
	<tr>
		<th>#</th>
		<th>Route Name</th>
		<th>Time</th>
		<th>Amount</th>
	</tr>
	<?php
	
	$sql = "SELECT * FROM routes ORDER BY time";
	
	$result = mysqli_query($db, $sql);
	$count = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$count."</td>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['time']."</td>";
		echo "<td>".$row['amount']."</td>";
		?>
	<?php
		echo "</tr>";
		$count++;
	}
	
	?>
</table>

					</div>
					
					//Travel tips section
					
					<div style="position:absolute; right:2px; top:10px; width:40%; height:200px; background-color:rgba(244, 230, 213, 0.7); padding: 20px;">
						<div style="position:absolute; left:42%; top:10px;">
							<b style="color:#736357; padding: 10px;">TRAVEL TIPS </b>
						</div>
						<br><br>
						<hr>
						
						<p><script>generateText(1)</script></p>
					</div>
				
				</div>
			</div>
			<div style="position:absolute; bottom:0px; width:100%; height:190px; background: #736357; text-align:center;">
				<br>
				<h4>&copy; BY Buwembo Julius. All rights reserved.</h4>
			</div>
		
		
		</div>



<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 10000); // Change image every 10 seconds
}



</script>

</body>
</html>