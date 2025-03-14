<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Login</h2>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="text-center mt-3">Belum punya akun? <a href="#" onclick="toggleForm()">Registrasi</a></p>

                <h2 class="text-center mt-5">Registrasi</h2>
                <form id="registerForm" style="display: none;">
                    <div class="mb-3">
                        <label for="registerNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="registerNama" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registerPassword" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrasi</button>
                </form>
                <p class="text-center mt-3"><a href="#" onclick="toggleForm()">Kembali ke Login</a></p>
            </div>
        </div>
    </div>

    <script>
        const API_URL = "http://localhost/backend_native/api/auth.php"; // Sesuaikan dengan path API-mu

        function toggleForm() {
            document.getElementById('loginForm').style.display = document.getElementById('loginForm').style.display === 'none' ? 'block' : 'none';
            document.getElementById('registerForm').style.display = document.getElementById('registerForm').style.display === 'none' ? 'block' : 'none';
        }

        document.getElementById('loginForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            const response = await fetch(`${API_URL}?action=login`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    email,
                    password
                })
            });

            const result = await response.json();
            alert(result.message || result.error);

            if (result.token) {
                localStorage.setItem('token', result.token);
                window.location.href = "dashboard.html"; // Redirect ke dashboard jika login sukses
            }
        });

        document.getElementById('registerForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const nama = document.getElementById('registerNama').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;

            const response = await fetch(`${API_URL}?action=register`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    nama,
                    email,
                    password
                })
            });

            const result = await response.json();
            alert(result.message || result.error);

            if (result.message) {
                toggleForm(); // Kembali ke login setelah registrasi berhasil
            }
        });
    </script>
</body>

</html>