function login() {
            // Your login logic here (replace with actual implementation)
            var branch = document.getElementById("BRANCH").value.toLowerCase();
            var username = document.getElementById("username").value.toLowerCase();
            var password = document.getElementById("password").value;

            // Sample user data for the given usernames and passwords
            var users = [
                { branch: branch, username: "", password: "Kantanka&1" },
                { branch: branch, username: "", password: "Kantanka&13" },
                { branch: branch, username: "", password: "Kantanka&22" },
                { branch: branch, username: "", password: "Kantanka&28" },
                { branch: branch, username: "", password: "Kantanka&20" },
                { branch: branch, username: "", password: "Kantanka&21" },
                { branch: branch, username: "", password: "Kantanka&24" },
                { branch: branch, username: "", password: "Kantanka&27" },
                { branch: branch, username: "", password: "Kantanka&29" },
                { branch: branch, username: "", password: "Kantanka&2" },
            ];

            var user = users.find(u => u.username === username);

            if (user && user.password === password) {
                // Redirect to the specified page
                window.location.href = "go:S123";
            } else {
                alert("Invalid credentials. Please try again.");
            }
        }

        function showRegistrationForm() {
            document.getElementById("registrationContainer").style.display = "block";
            document.getElementById("loginContainer").style.display = "none";
        }

        function showLogin() {
            document.getElementById("loginContainer").style.display = "block";
            document.getElementById("registrationContainer").style.display = "none";
        }