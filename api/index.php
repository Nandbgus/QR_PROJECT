<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-5xl mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800">QR Code API Documentation</h1>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700">Authentication</h2>
            <div class="mt-4">
                <h3 class="text-lg font-medium text-gray-800">Register User</h3>
                <p class="text-gray-600">Registers a new user.</p>
                <div class="bg-gray-50 p-4 rounded-lg mt-2">
                    <p class="font-mono text-sm text-gray-700">POST /api/auth.php?action=register</p>
                    <p class="text-gray-700 text-sm">Body:</p>
                    <pre class="bg-gray-200 p-3 rounded text-sm overflow-auto">{
  "nama": "John Doe",
  "email": "johndoe@example.com",
  "password": "password123"
}</pre>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="text-lg font-medium text-gray-800">Login User</h3>
                <p class="text-gray-600">Logs in a user and returns a JWT token.</p>
                <div class="bg-gray-50 p-4 rounded-lg mt-2">
                    <p class="font-mono text-sm text-gray-700">POST /api/auth.php?action=login</p>
                    <p class="text-gray-700 text-sm">Body:</p>
                    <pre class="bg-gray-200 p-3 rounded text-sm overflow-auto">{
  "email": "johndoe@example.com",
  "password": "password123"
}</pre>
                </div>
            </div>
        </div>
    </div>
</body>

</html>