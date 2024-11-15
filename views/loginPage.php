<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Section Login -->
    <div class="bg-gradient-to-b from-indigo-800 to-indigo-950 h-screen flex justify-center items-center">
        <div class="bg-[#A5B3F133] p-10 rounded-lg w-80 text-center shadow-lg">
            <img src="../Public/Logo.png" alt="Logo" class="mx-auto w-24 mb-6">
            <form action="#" method="POST">
                <div class="mb-4">
                    <input type="text" placeholder="NIM/NIP" class="w-full px-4 py-2 rounded bg-gray-300 focus:outlane-none focus:ring-2 focus:ring-indigo-500 shadow-lg">
                    <input type="password" placeholder="Password" class="w-full px-4 py-2 mt-4 rounded bg-gray-300 focus:outlane-none focus:ring-2 focus:ring-indigo-500 shadow-lg">
                </div>
                <div class="mb-4">
                    <button type="submit" class="w-full px-4 py-2 rounded bg-amber-500 text-white">Login</button>
                </div>
                <a href="./signUpPage.php" class="text-white">Sign Up</a>
            </form>
        </div>
    </div>
</body>
</html>