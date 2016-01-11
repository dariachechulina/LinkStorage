<h1>Hello!!!!!!!!!!!!!!!!!!!!</h1>
<link href="../ball/css/bootstrap.css" rel="stylesheet">

<link href="../style.css" rel="stylesheet">
<?php

#var_dump($data);

if (is_object($data[0])) {
    for ($i = 0; $i < count($data); $i++) {
        echo $data[$i]->get_title();
        echo "</br>";
    }
}

echo "</br>";
echo "</br>";
var_dump($data);

?>
