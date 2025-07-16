<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Exercise 1</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
<?php include 'header.php'; ?>
    <!-- Page content-->
    <div class="container-fluid">
        <div>
            <h1 class="mt-4">Exercise 1 Content</h1>
        </div>
            <div style = "padding: 1%">
                <?php
                // 1.  Print “Hello World” using echo only.
                echo "Hello World<br>";

                // 2. Use a variable named message, initialize it with the text, "Welcome to the PHP World" then print the content of a variable.
                $message = "Welcome to the PHP World<br>";
                echo $message;

                /* 3. Do: 
                First variable have text “Good Morning.”
                Second variable have text “Have a nice day!”
                Your output should be “Good morning. Have a nice day!”
                You are allowed to use only one echo statement in this program.
                */
                $text1 = "Good Morning.";
                $text2 = "Have a nice day!";
                echo $text1 . $text2;

                // 4. Display the PHP configuration and modules information by calling the function phpinfo();
                phpinfo();
                    ?>
                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>
