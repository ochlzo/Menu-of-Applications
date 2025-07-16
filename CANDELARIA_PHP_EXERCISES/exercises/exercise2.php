<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //grab the data
        $students = isset($_POST['students']) ? $_POST['students'] : [];

        // if add student button was triggered, add a blank value to students array
        if (isset($_POST['add_student'])) {
            $students[] = ["name" => "", "english" => "", "filipino" => "", "math" => "", "science" => "", "pe" => ""];
        }
    } else { // display blank fields by default
        $students = [["name" => "", "english" => "", "filipino" => "", "math" => "", "science" => "", "pe" => ""]];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Exercise 2</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <?php include 'header.php'; ?>
        <!-- Page content-->
            <div class="container-fluid">
                <div class="container" style="padding: 1%; margin-top: 5%;">
                    <h3>Student Grading System</h3>
                    <form method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>English</th>
                                <th>Filipino</th>
                                <th>Math</th>
                                <th>Science</th>
                                <th>PE</th>
                            </tr>
                            <?php foreach ($students as $index => $student): // Generate rows?>
                                <tr>
                                    <td><input type="text" name="students[<?= $index ?>][name]" autocomplete="off" class="form-control" min="0" max="100" value="<?= htmlspecialchars($student['name']) ?>" required></td>
                                    <td><input type="number" name="students[<?= $index ?>][english]" class="form-control" min="0" max="100" value="<?= $student['english'] ?>" required></td>
                                    <td><input type="number" name="students[<?= $index ?>][filipino]" class="form-control" min="0" max="100" value="<?= $student['filipino'] ?>" required></td>
                                    <td><input type="number" name="students[<?= $index ?>][math]" class="form-control" min="0" max="100" value="<?= $student['math'] ?>" required></td>
                                    <td><input type="number" name="students[<?= $index ?>][science]" class="form-control" min="0" max="100" value="<?= $student['science'] ?>" required></td>
                                    <td><input type="number" name="students[<?= $index ?>][pe]" class="form-control" min="0" max="100" value="<?= $student['pe'] ?>" required></td>
                                </tr>
                            <?php endforeach; ?>
                            </table>
                            <button type="submit" name="add_student" class="btn btn-success">Add Student</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href=window.location.href">Restart</button>
                        </form>
                        <?php
                        // if add student was triggered (submit type) - executes this php code
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['students'])) {
                                $students = $_POST['students'];
                                $grades = [];
                                
                                // Function to get the equivalent mark and remarks based on the average
                                function getEquivalentMark($average) {
                                    if ($average >= 90) return ['A+', 'Excellent'];
                                    elseif ($average >= 85) return ['A', 'Very Good'];
                                    elseif ($average >= 80) return ['A-', 'Good'];
                                    elseif ($average >= 75) return ['B+', 'Above Average'];
                                    elseif ($average >= 70) return ['B', 'Average'];
                                    elseif ($average >= 65) return ['B-', 'Below Average'];
                                    elseif ($average >= 60) return ['C+', 'Satisfactory'];
                                    elseif ($average >= 55) return ['C', 'Needs Improvement'];
                                    elseif ($average >= 50) return ['C-', 'Poor'];
                                    else return ['F', 'Fail'];
                                }
                                
                                // iterate through the student array data and calculate the average
                                foreach ($students as $key => $student) {
                                    $name = htmlspecialchars($student['name']);
                                    $english = (int)$student['english'];
                                    $filipino = (int)$student['filipino'];
                                    $math = (int)$student['math'];
                                    $science = (int)$student['science'];
                                    $pe = (int)$student['pe'];

                                    // compute the average and call the function to get the mark and remark values from the indexed array returned by the function
                                    $average = ($english + $filipino + $math + $science + $pe) / 5;
                                    list($mark, $remarks) = getEquivalentMark($average);

                                    $grades[] = [
                                        'name' => $name,
                                        'english' => $english,
                                        'filipino' => $filipino,
                                        'math' => $math,
                                        'science' => $science,
                                        'pe' => $pe,
                                        'average' => $average,
                                        'mark' => $mark,
                                        'remarks' => $remarks
                                    ];
                                }
                                
                                // Sort
                                usort($grades, function ($a, $b) {
                                    return $b['average'] <=> $a['average'];
                                });

                                // Display results
                                echo "<h2>Grading Results</h2>";
                                echo "<table class='table table-bordered table-striped'>
                                    <thead class='table-dark'>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Name</th>
                                            <th>English</th>
                                            <th>Filipino</th>
                                            <th>Math</th>
                                            <th>Science</th>
                                            <th>PE</th>
                                            <th>Average</th>
                                            <th>Mark</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                $rank = 1;
                                foreach ($grades as $student) {
                                    echo "<tr>
                                        <td>{$rank}</td>
                                        <td>{$student['name']}</td>
                                        <td>{$student['english']}</td>
                                        <td>{$student['filipino']}</td>
                                        <td>{$student['math']}</td>
                                        <td>{$student['science']}</td>
                                        <td>{$student['pe']}</td>
                                        <td>" . number_format($student['average'], 2) . "</td>
                                        <td>{$student['mark']}</td>
                                        <td>{$student['remarks']}</td>
                                    </tr>";
                                    $rank++;
                                }

                                echo "</tbody></table>";
                            }
                        ?>
                    </div>
                </div>
            </div>
<?php include 'footer.php'; ?>
