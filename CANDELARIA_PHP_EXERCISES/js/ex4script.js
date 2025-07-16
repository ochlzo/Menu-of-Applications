document.addEventListener("DOMContentLoaded", () => {
    document.getElementById('username-error').style.opacity = '0';
    document.getElementById('password-error').style.opacity = '0';
    document.getElementById('gender-error').style.opacity = '0';
});

// Validate Username
function validateUsername() {
    const username = document.getElementById('username');
    const error = document.getElementById('username-error');

    if (username.value.length < 4 || username.value.length > 20 || !/^[a-zA-Z0-9_]+$/.test(username.value)) {
        error.textContent = "Invalid username.";
        error.style.opacity = "1";
        username.style.borderColor = "red";
        return false;
    }
    
    error.style.opacity = "0"; 
    username.style.borderColor = "green";
    return true;
}

// Validate Email
function validateEmail() {
    const email = document.getElementById('email');
    const error = document.getElementById('email-error');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        error.textContent = "Invalid email format.";
        email.style.borderColor = "red";
        return false;
    }
    error.textContent = "";
    email.style.borderColor = "green";
    return true;
}

// Validate Password
function validatePassword() {
    const password = document.getElementById('password');
    const error = document.getElementById('password-error');

    if (password.value.length < 8 || 
        !/[A-Z]/.test(password.value) || 
        !/[a-z]/.test(password.value) || 
        !/\d/.test(password.value) || 
        !/[\W_]/.test(password.value)) {
        error.style.opacity = "1";
        password.style.borderColor = "red";
        return false;
    }

    error.style.opacity = "0"; 
    password.style.borderColor = "green";
    return true;
}

// Validate Confirm Password
function validateConfirmPassword() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confpass');
    const error = document.getElementById('confpass-error');
    if (confirm.value !== password) {
        error.textContent = "Passwords do not match.";
        confirm.style.borderColor = "red";
        return false;
    }
    error.textContent = "";
    confirm.style.borderColor = "green";
    return true;
}

// Validate Gender
function validateGender() {
    const gender = document.getElementById('gender');
    const error = document.getElementById('gender-error');

    if (!gender.value) {
        error.style.opacity = '1';
        gender.style.borderColor = "red";
        return false;
    } 

    error.style.opacity = "0"; 
    gender.style.borderColor = "green";
    return true;
}

// Validate Date of Birth
function validateDOB() {
    const dob = document.getElementById('birthdate');
    const error = document.getElementById('dob-error');
    const minDate = new Date();
    minDate.setFullYear(minDate.getFullYear() - 18);
    if (new Date(dob.value) > minDate) {
        error.textContent = "Must be 18 or older.";
    } else {
        error.textContent = "";
    }
}

// Validate Country
function validateCountry() {
    const country = document.getElementById('country');
    const error = document.getElementById('country-error');

    if (country.value === "") { 
        error.textContent = "Please select a country.";
        country.style.borderColor = "red";
        return false;
    } else {
        error.textContent = "";
        country.style.borderColor = "green";
        return true; 
    }
}

// Validate Interests
function validateInterests() {
    const interests = document.querySelectorAll('input[name="interests[]"]:checked');
    const error = document.getElementById('interests-error');

    if (interests.length < 1) {
        error.textContent = "Please select at least one interest.";
        return false;
    } else {
        error.textContent = "";
        return true; 
    }
}

// Reset Form
function resetForm() {
    location.href = location.href;
}

// Validate Form Before Submission
function validateForm() {
    return (
        validateUsername() &&
        validateEmail() &&
        validatePassword() &&
        validateConfirmPassword() &&
        validateGender() && 
        validateCountry() &&
        validateInterests()
    );
}

//display and storage
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('registrationForm');
    const submittedData = document.getElementById('submittedData');

    loadData();

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!validateForm()) return;

        const formData = {
            username: document.getElementById('username').value.trim(),
            email: document.getElementById('email').value.trim(),
            password: document.getElementById('password').value.trim(),
            gender: document.getElementById('gender').value,
            birthdate: document.getElementById('birthdate').value,
            country: document.getElementById('country').value,
            interests: Array.from(document.querySelectorAll('input[name="interests[]"]:checked')).map(input => input.value)
        };

        saveData(formData);

        displayData(formData);

        form.reset();
    });

    function saveData(data) {
        let storedData = JSON.parse(localStorage.getItem("storedData")) || [];
        storedData.push(data);
        localStorage.setItem("storedData", JSON.stringify(storedData));
    }

    function loadData() {
        let storedData = JSON.parse(localStorage.getItem("storedData")) || [];
        submittedData.innerHTML = ""; 
        storedData.forEach(displayData);
    }

    function displayData(data) {
        const dataDiv = document.createElement("div");
        dataDiv.classList.add("data"); 

        const content = document.createElement("p");
        content.innerHTML = `
            <strong>Username:</strong> ${data.username} <br>
            <strong>Email:</strong> ${data.email} <br>
            <strong>Password:</strong> ${data.password} <br>
            <strong>Gender:</strong> ${data.gender} <br>
            <strong>Birthdate:</strong> ${data.birthdate} <br>
            <strong>Country:</strong> ${data.country} <br>
            <strong>Interests:</strong> ${data.interests.join(", ")} <br>
        `;

        const deleteBtn = document.createElement("button");
        deleteBtn.innerText = "✖";
        deleteBtn.classList.add("delete-btn");
        deleteBtn.addEventListener("click", () => deleteData(data, dataDiv));

        const dataWrapper = document.createElement("div");
        dataWrapper.classList.add("data-wrapper");
        dataWrapper.appendChild(content);
        dataWrapper.appendChild(deleteBtn);

        dataDiv.appendChild(dataWrapper);
        submittedData.appendChild(dataDiv);
    }

    function deleteData(dataObject, dataDiv) {
        let storedData = JSON.parse(localStorage.getItem("storedData")) || [];
        storedData = storedData.filter(
            data => data.username !== dataObject.username || 
                    data.email !== dataObject.email || 
                    data.password !== dataObject.password
        );
        localStorage.setItem("storedData", JSON.stringify(storedData));
        dataDiv.remove();
    }
});