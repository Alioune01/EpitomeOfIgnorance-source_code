<?php
	session_start();
	
	$conn = mysqli_connect("localhost", "root", "", "hackathon2018");
	
	//print all the questions
	$questionArray = array(); //array of questions
	$rootQuery = "SELECT * FROM questions WHERE question != \" \"";
	$outcome = mysqli_query($conn, $rootQuery);
	
	while($questionsEntered = mysqli_fetch_assoc($outcome))
	{
		$questionArray[] = $questionsEntered;
	}
	
	if(isset($_POST['question']))
	{
		if($_POST['question'] !== "")
		{
			$question = $_POST['question'];
			$query = "INSERT INTO questions (question) VALUES ('$question');";
			mysqli_query($conn, $query);
			header("Refresh:0");
		}
	}
?>
<!Doctype html>
<html>
        <!--<audio autoplay>-->
            <embed  src = "virtualResorts.mp3" <!--type = "audio/mpeg--> loop= "true" hidden = "true" autostart = "true">
       <!-- </audio>-->
	<title>
            Nope....
	</title>
	
	<head>
	</head>
	
	<style>
		html, body
		{
			width: 100%;
			height: 100%;
			background-color: #ffff80;
		}
		
		h1
		{
			color: red;
		}
		
		#ask
		{
			width: 40%;
			height: 6.5%;
			border: none;
		}
		
		#everything
		{
			height: 50%;
			width: 50%;
			margin: auto;
		}
		
		.btnDesign:hover
		{
			cursor: pointer;
		}
		
		.divDesign
		{
			width: 100%;
			height: 20%;
		}
		
		.shorten
		{
			width: 12%;
		}
		
		.textRules
		{
			
		}
	</style>
	
	<body>
               <img src = "12giphy.gif" />
		<h1><em>The Epitome of Ignorance: Stupid Answers to Stupid Questions</em></h1></br></br>
		<form id = "everything" method = "POST" action = "">
			<p class = "shorten">Ask: </p><input id = "ask" type = "text" name = "question"></input> </br></br>
		</form>
	</body>
	
	<script>
		<?php
			$i = 0;
			for(; $i < sizeof($questionArray); $i++)
			{
				echo "var everything = document.getElementById(\"everything\");
					 var newDiv = document.createElement(\"div\");
					newDiv.clasName = \"divDesign\";
					
					var q1 = document.createElement(\"p\");
					var qContent = document.createTextNode(\"Question: " . $questionArray[$i]['question'] . "\");
					q1.appendChild(qContent);
					
					var btn = document.createElement(\"input\");
					btn.className = \"btnDesign\";
					btn.type = \"submit\";
					btn.name = \"btn" . $i . "\";
					btn.value = \"Submit an Answer\";
					
					var textarea = document.createElement(\"TEXTAREA\");
					textarea.className = \"textRules\";
					textarea.name = \"area" . $i . "\";
					textarea.maxLength = \"250\";
					
				everything.appendChild(newDiv);
				newDiv.appendChild(q1);
				newDiv.appendChild(btn);
				newDiv.appendChild(textarea);
				";
			}
			
			for($j = 0; $j < $i; $j++)
			{
				$submitVal = 'btn' . $j;
				$textVal = 'area' . $j;
				if(isset($_POST[$submitVal]))
				{
					if($_POST[$textVal] !== "")
					{
						$qid = $questionArray[$j]['id'];
						$answer = $_POST[$textVal];
						$lastQuery = "INSERT INTO answers (qid, answer) VALUES ('$qid', '$answer');";
						mysqli_query($conn, $lastQuery);
						
						echo "alert(\"Submit Successful!\");";
						header("Refresh:0");
					}
				}
			}
		?>
	</script>
</html>