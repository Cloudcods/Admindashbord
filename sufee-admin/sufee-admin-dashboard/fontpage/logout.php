<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<script>
    function logout() {
        // Display a confirmation alert
        var confirmLogout = confirm("Are you sure you want to log out?");

        // Check user's choice
        if (confirmLogout) {
            // Perform logout action or redirect to logout page
            // For example: window.location.href = "/logout";
            alert("Logout successful"); // Replace with actual logout action
        } else {
            // User clicked "Cancel" - do nothing or handle accordingly
            alert("Logout canceled");
        }
    }
</script>


<div class="logout">
<!-- Example logout button -->
<button onclick="logout()">Logout</button>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-e7N/E8aJeVRtIh8I5wkw85FkXoRHIJqUCBrapFQdA6dp5RT+Ry4gDaG9t9FoQ8Xj" crossorigin="anonymous"></script>

</body>
</html>
