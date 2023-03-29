<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PAG MISSION HOSPITAL</title>
    <link rel="stylesheet" href="assets/style.css"/>
    <link
            href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
            rel="stylesheet"
    />
</head>
<body>
<header>
    <div class="nav container">
        <a href="index.php" class="logo">PAG MISSION HOSPITAL</a>
        <a href="index.php" class="navigation ">Home</a>
        <a href="receipts.php" class="navigation ">Admin</a>
        <a href="newPatient.php" class="navigation navigation_active">New Patient</a>
        <a href="logout.php" class="navigation">Logout</a>
    </div>
</header>

<section class="shop container">
    <h2 class="section-title">Add New Patient</h2>

    <!-- Container element to hold the search results -->
    <!-- content -->
    <div id="results" class="PatientContainer">

        <form action="" method="post">

            <label for="name" class="labeltext">Name</label>
            <input id="name" type="text"  style="margin-bottom: 2em;" name="name" class="inputbox" placeholder="Patient Name"
                   required/>
            <label for="contact" class="labeltext">Contact</label>
            <input id="contact" style="margin-bottom: 2em;" type="number" name="contact" class="inputbox"
                   placeholder="Phone Number" required/>
            <label for="email" class="labeltext">Email</label>
            <input id="email" style="margin-bottom: 2em;" type="email" name="email" class="inputbox"
                   placeholder="Email address" required/>
            <label for="dob" class="labeltext">Date of Birth</label>
            <input id="dob" style="margin-bottom: 2em;" type="date" name="dob" class="inputbox"
                   placeholder="Date of Birth" required/>
            <label for="gender" class="labeltext">Gender</label>
            <select id="gender" style="margin-bottom: 2em;" name="gender" class="inputbox">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <label for="address" class="labeltext">Address</label>
            <input id="address" style="margin-bottom: 2em;" type="text" name="address" class="inputbox"
                   placeholder="Address" required/>

            <label for="gname" class="labeltext">Guardian Name</label>
            <input id="gname" style="margin-bottom: 2em;" type="text" name="gname" class="inputbox"
                   placeholder="Guardian Name" required/>
            <br/>
            <input class="addPatient" type="submit" value="Save New Patient"/>

        </form>

    </div>

    <div id="overlay">
        <div id="overlayContent">
            <i class="bx bx-x" id="close-overlay"></i>
            <button class="print_btn" onclick="window.print()">Print Receipt</button>

            <div id="card_heading">

            </div>
            <div id="overlayResult">

            </div>
            <table id="receipt" class="table_reciept">

            </table>
        </div>
    </div>
</section>


</body>
</html>
