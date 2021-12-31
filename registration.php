<!-- Header -->
<?php include('./includes/header.php')?>
<!-- Navigation -->
<?php include('./includes/navigation.php')?>

<!-- Page Content -->
<form action="index.html" method="post">
    
    <h1>Registration Form</h1>

    <label for="name">Name</label>
    <input type="text" name="name" id="name">

    <label for="mobileNo">Mobile No</label>
    <input type="tel" name="mobileNo" id="mobileNo" pattern="[1-9]{1}[0-9]{9}">
    
    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <label for="confirmPassword">Confirm Password</label>
    <input type="password" name="confirmPassword" id="confirmPassword">

    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" id="dob">

    <label for="gender">Gender</label>
    <input type="radio" name="gender" id="male" value="male">
    <label for="male" class="light">Male</label>
    <input type="radio" name="gender" id="female" value="female">
    <label for="female" class="light">Female</label>

    <br><br>
    <label for="bloodGroup">Blood Group</label>
    <select name="bloodGroup" id="bloodGroup">
        <option value="">--- Choose Blood Group ---</option>
        <option value="A+">A+</option>
        <option value="B+">B+</option>
        <option value="O+">O+</option>
        <option value="AB+">AB+</option>
        <option value="A-">A-</option>
        <option value="B-">B-</option>
        <option value="O-">O-</option>
        <option value="AB-">AB-</option>
    </select>

    <label for="aadharNo">Aadhar Card No</label>
    <input type="text" name="aadharNo" id="aadharNo" pattern="[0-9]{12}">

    <label for="aadharDocName">Aadhar Card Photo</label>
    <input type="file" name="aadharDocumentName" id="aadharDocumentName" accept="image/png, image/jpeg">

    <button type="submit">Register</button>
</form>

<!-- Footer -->
<?php include('./includes/footer.php')?>