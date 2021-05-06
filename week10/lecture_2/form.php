<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

$count = count($_GET['courses']);
$coursesForQuery = implode(', ', $_GET['courses']);
for($i = 0; $i < $count; $i++) {
    echo $_GET['courses'][$i];
}

$query = "select * from reports where course_id in ({$coursesForQuery})";

echo $query;

$count = count($_GET['courses_alt']);
for($i = 0; $i < $count; $i++) {
    echo $_GET['courses_alt'][$i];
}

$years = range(1900, 2021);

?>
<form action="">
    <div>
        <label>Courses</label>
        <div>
            <label for="cs270">CS270</label>
            <input type="checkbox" name="courses[]" id="cs270" value="1">
        </div>
        <div>
            <label for="cs240">CS240</label>
            <input type="checkbox" name="courses[]" id="cs240" value="2">
        </div>
        <div>
            <label for="cs200">CS200</label>
            <input type="checkbox" name="courses[]" id="cs200" value="3">
        </div>
        <div>
            <label for="cs215">CS215</label>
            <input type="checkbox" name="courses[]" id="cs215" value="4">
        </div>
        <div>
            <label for="courses_alt">Courses</label>
            <select name="courses_alt[]" id="courses_alt" multiple>
                <option value="cs270">CS270</option>
                <option value="cs240">CS240</option>
                <option value="cs200">CS200</option>
                <option value="cs215">CS215</option>
                <option value="cs215">CS215</option>
            </select>
        </div>
        <div>
            <label for="year">Year</label>
            <select name="year" id="year">
                <?php for ($i = 0; $i < count($years); $i++): ?>
                    <option value="<?= $years[$i] ?>">Year: <?= $years[$i] ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <button type="submit">Submit</button>
    </div>
</form>
</body>
</html>
