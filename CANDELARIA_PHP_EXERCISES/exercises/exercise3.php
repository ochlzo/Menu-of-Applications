<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Exercise 3</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>

<?php include 'header.php'; ?>

<?php
$erra = $errh = $errw = $errg = "";
$unith = $unitw = $age = $height = $weight = $gender = "";
$bmi = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['height'])) {
        $errh = "<p class='text-danger'>Height is required</p>";
    } else {        
        $height = filter_input(INPUT_POST, "height", FILTER_VALIDATE_FLOAT);
        if (empty($height)) {
            $errh = "<p class='text-danger'>Invalid input.</p>";
        }
    }

    if (empty($_POST['weight'])) {
        $errw = "<p class='text-danger'>Weight is required</p>";
    } else {
        $weight = filter_input(INPUT_POST, "weight", FILTER_VALIDATE_FLOAT);
        if (empty($weight)) {
            $errw = "<p class='text-danger'>Invalid input.</p>";
        }
    }

    if (empty($_POST['age'])) {
        $erra = "<p class='text-danger'>Age is required</p>";
    } else {
        $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_FLOAT);
        if (empty($age)) {
            $erra = "<p class='text-danger'>Invalid input.</p>";
        }

        if ($age < 19) {
            if (empty($_POST['gender'])) {
                $errg = "<p class='text-danger'>Gender is required for children</p>";
            } else {
                $gender = $_POST['gender'];
            }
        }
    }

    // BMI Calculation
    if (!empty($age) && !empty($height) && !empty($weight)) {
        $unitw = $_POST['unitw'];
        $unith = $_POST['unith'];

        if ($unith == 'cm') {
            $height = $height * 0.01; // cm to meters
        } elseif ($unith == 'feet') {
            $height = $height * 0.3048; // feet to meters
        } elseif ($unith == 'inches') {
            $height = $height * 0.0254; // inches to meters
        }

        if ($unitw == 'pounds') {
            $weight = $weight * 0.45359237; // pounds to kg
        }

        if ($unitw == 'kg' && $unith == 'm') {
            $bmi = ($weight / ($height * $height));
        } else {
            $bmi = ($weight / ($height * $height));
        }
    }

}
?>

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4">BMI Calculator</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Height: </label>
                <select name="unith" style = "border-radius: 5px;">
                    <option value="m" <?php if ($unith == 'm') echo 'selected'; ?>>m</option>
                    <option value="cm" <?php if ($unith == 'cm') echo 'selected'; ?>>cm</option>
                    <option value="feet" <?php if ($unith == 'feet') echo 'selected'; ?>>feet</option>
                    <option value="inches" <?php if ($unith == 'inches') echo 'selected'; ?>>inches</option>
                </select>
                <input type="text" class="form-control" name="height" autocomplete="off" value="<?php echo $height; ?>">
                <?php echo $errh; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Weight: </label>
                <select name="unitw" style = "border-radius: 5px;">
                    <option value="kg" <?php if ($unitw == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="pounds" <?php if ($unitw == 'pounds') echo 'selected'; ?>>pounds</option>
                </select>
                <input type="text" class="form-control" name="weight" autocomplete="off" value="<?php echo $weight; ?>">
                <?php echo $errw; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Age:</label>
                <input type="text" class="form-control" name="age" autocomplete="off" value="<?php echo $age; ?>">
                <?php echo $erra; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender:</label>
                <select class="form-select" name="gender">
                    <option value="" disabled selected>select an option</option>
                    <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                </select>
                <?php echo $errg; ?>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" name="submit">Check BMI</button>
                <button type="reset" class="btn btn-secondary" onclick="resetForm()">Clear</button>
            </div>
            <script>
                function resetForm() {
                    location.href = location.href;               
                }
            </script>
        </form>
    </div>
    
    <?php if (!empty($bmi)): ?>
        <div class="mt-4 alert alert-info">
            <strong>Your BMI is:</strong> <?php echo number_format($bmi, 2); ?>
            <?php
            if (isset($_POST['submit'])) {
                if ($age > 18) {
                    // Adult BMI Categories
                    if ($bmi < 18.5) {
                        echo "<span> (Underweight)</span>";
                    } else if ($bmi >= 18.5 && $bmi < 25.0) {
                        echo "<span> (Normal)</span>";
                    } else if ($bmi >= 25.0 && $bmi < 30.0) {
                        echo "<span> (Overweight)</span>";
                    } else {
                        echo "<span> (Obese)</span>";
                    }
                } else if ($age >= 2 && $age <= 12) {
                    // Younger Children BMI Categories
                    if ($gender == 'Male') {
                        if ($bmi < 14.0) {
                            echo "<span> (Underweight)</span>";
                        } else if ($bmi >= 14.0 && $bmi < 18.0) {
                            echo "<span> (Normal)</span>";
                        } else if ($bmi >= 18.0 && $bmi < 20.0) {
                            echo "<span> (Overweight)</span>";
                        } else {
                            echo "<span> (Obese)</span>";
                        }
                    } else if ($gender == 'Female') {
                        if ($bmi < 14.0) {
                            echo "<span> (Underweight)</span>";
                        } else if ($bmi >= 14.0 && $bmi < 18.0) {
                            echo "<span> (Normal)</span>";
                        } else if ($bmi >= 18.0 && $bmi < 21.0) {
                            echo "<span> (Overweight)</span>";
                        } else {
                            echo "<span> (Obese)</span>";
                        }
                    }
                } else if ($age >= 13 && $age <= 18) {
                    // Older Children BMI Categories
                    if ($gender == 'Male') {
                        if ($bmi < 16.5) {
                            echo "<span> (Underweight)</span>";
                        } else if ($bmi >= 16.5 && $bmi < 21.5) {
                            echo "<span> (Normal)</span>";
                        } else if ($bmi >= 21.5 && $bmi < 24.0) {
                            echo "<span> (Overweight)</span>";
                        } else {
                            echo "<span> (Obese)</span>";
                        }
                    } else if ($gender == 'Female') {
                        if ($bmi < 16.0) {
                            echo "<span> (Underweight)</span>";
                        } else if ($bmi >= 16.0 && $bmi < 22.0) {
                            echo "<span> (Normal)</span>";
                        } else if ($bmi >= 22.0 && $bmi < 24.5) {
                            echo "<span> (Overweight)</span>";
                        } else {
                            echo "<span> (Obese)</span>";
                        }
                    }
                }
            }
            ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>