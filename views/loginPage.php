<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <body class="bg-gray-100">
        <div class="flex h-screen ">
            <!-- Left Section -->
            <div class="w-1/2 bg-white flex flex-col md:flex-row justify-start items-start md:space-x-4">
                <img src="../Public/Logo.png" alt="logo" class="w-16 mb-4 justify-start items-start md:flex-row">
                <img src="../Public/jti.png" alt="jti" class="w-16 mb-4 justify-start items-start md:flex-row">
                <div class="flex flex-col justify-center items-center h-screen">
                    <img src="../Public/LogoReg.png" alt="RegIT" class=" md:flex-row mb-4 justify-center items-center md:flex-row">
                    <h1 class="text-6xl font-bold text-yellow-500 mt-4">Reg<span class="text-blue-900">IT</span></h1>
                </div>
            </div>

            <!-- Right Section -->
            <div class="w-1/2 bg-[#132145] flex flex-col justify-center items-center px-20">
                <h2 class="text-4xl font-bold text-[#FEC01A] mb-8">LOG IN</h2>

                <!-- Login Form -->
                 <form action="login.php" method="POST" class="space-y-4">
                    <div>
                        <input type="text" name="username" placeholder="NIM/NIP" 
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-non focus:ring-2 focus:ring-[#FEC01A]">
                    </div>
                    <div>
                        <input type="text" name="password" placeholder="Password"
                            class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-non focus:ring-2 focus:ring-[#FEC01A]">
                    </div>
                    <div>
                        <p class="text-gray-200 mt-4 mb-4">
                            Don't have an account? <a href="signUpPage.php" class="text-[#FEC01A] underline">Sign Up</a>
                        </p>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-[#FEC01A] hover:bg-yellow-500 text-black font-bold py-2 rounded-lg transition">
                            Log In
                        </button>
                    </div>
                 </form>
            </div>
        </div>
    </body>
</body>
</html>