<?php
function generate_portfolio($url, $first_name, $last_name,$talent, $description, $price, $available, $id){
     echo '<head>
        <link rel="stylesheet" type="text/css" href="../css/portfolio.css">
    </head>
        <div class="main_container">
            <img src="../img/'.$url.'">
            <h2>'.$first_name.' '.$last_name.'</h2>
            <div id="description"> 
                <h4>Talent: '.$talent.'</h4>   
                <h4>'.$description.'</h4>
            </div>
            <h4>Price: '.$price.' &euro;</h4>
            <h4>Available: '.$available.'</h4>
            <a href="../display-profile.php?id='.$id.'"><button>View More</button></a>
        </div>';
    }
?>