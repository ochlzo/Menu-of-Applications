<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Exercise 4</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="../js/ex4script.js"></script>
        <script src="../js/script.js"></script>
        <link href="../css/ex4styles.css" rel="stylesheet"/>
    </head>

<?php include 'header.php'; ?>

<div class="form-container">
        <h2>Registration Form</h2>
        <form id="registrationForm" onsubmit="return validateForm()">
            <div class="form-row">
                <div>
                    <label>Username:</label>
                    <input type="text" id="username" name="username" required oninput="validateUsername()">
                    <span id="username-error" class="error">Invalid username.</span>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="text" id="email" name="email" required oninput="validateEmail()">
                    <span id="email-error" class="error"></span>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Password:</label>
                    <input type="password" id="password" name="password" required oninput="validatePassword()">
                    <span id="password-error" class="error">Weak password.</span>
                </div>
                <div>
                    <label>Confirm Password:</label>
                    <input type="password" id="confpass" name="confpass" required oninput="validateConfirmPassword()">
                    <span id="confpass-error" class="error"></span>
                </div>
            </div>
            
            <div class="form-row">
                <div>
                    <label>Gender:</label>
                    <select id="gender" name="gender" onchange="validateGender()">
                        <option value="" disabled selected>Select an option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span id="gender-error" class="error">Please select a gender.</span>
                </div>

                <div>
                    <label>Date of Birth:</label>
                    <input type="date" id="birthdate" name="birthdate" required onchange="validateDOB()">
                    <span id="dob-error" class="error"></span>
                </div>

                <div>
                    <label>Country:</label>
                    <select id="country" name="country" onchange="validateCountry()">
                        <option value="" disabled selected>Select an option</option>
                        <option value="Philippines">Philippines</option>
                        <option value="South Korea">South Korea</option>
                        <option value="Japan">Japan</option>
                        <option value="Singapore">Singapore</option>
                        <option value="India">India</option>
                    </select>
                    <span id="country-error" class="error"></span>
                </div>
            </div>
            
            <div>
                <label>Interests:</label>
                <span class="error" id="interests-error"></span>
                <div class="interests-grid">
                    <input type="checkbox" name="interests[]" value="Web Development"> Web Development  
                    <input type="checkbox" name="interests[]" value="Mobile App Development"> Mobile App Development  
                    <input type="checkbox" name="interests[]" value="Game Development"> Game Development  
                    <input type="checkbox" name="interests[]" value="Data Science"> Data Science  
                    <input type="checkbox" name="interests[]" value="Machine Learning"> Machine Learning  
                    <input type="checkbox" name="interests[]" value="Cybersecurity"> Cybersecurity  
                    <input type="checkbox" name="interests[]" value="Blockchain"> Blockchain  
                    <input type="checkbox" name="interests[]" value="Artificial Intelligence"> Artificial Intelligence  
                    <input type="checkbox" name="interests[]" value="Competitive Programming"> Competitive Programming  
                    <input type="checkbox" name="interests[]" value="Algorithm Design"> Algorithm Design  
                    <input type="checkbox" name="interests[]" value="UI/UX Design"> UI/UX Design  
                    <input type="checkbox" name="interests[]" value="Embedded Systems"> Embedded Systems  
                    <input type="checkbox" name="interests[]" value="Cloud Computing"> Cloud Computing  
                    <input type="checkbox" name="interests[]" value="Database Management"> Database Management  
                </div>
            </div>
            <div>
                <button type="submit">Submit</button>
                <button type="reset" class="reset" onclick="resetForm()">Clear</button>
            </div>
        </form>
    </div>
    <div id="submittedData"></div>
</div>        
<?php include 'footer.php'; ?>