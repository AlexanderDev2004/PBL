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
                    <h1 class="text-6xl font-bold text-yellow-500 mt-4">Reg<span class="text-[#132145]">IT</span></h1>
                </div>
            </div>

            <!-- Right Section -->
            <div class="w-1/2 bg-[#132145] flex flex-col justify-center items-center px-20">
                <h2 class="text-4xl font-bold text-[#FEC01A] mb-8">SIGN UP</h2>

                <!-- Sign Up Form -->
                 <form action="register.php" method="POST" class="space-y-4">
                    <div>
                        <input type="text" name="email" placeholder="Email" 
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-non focus:ring-2 focus:ring-[#FEC01A]">
                    </div>
                    <div>
                        <input type="text" name="username" placeholder="NIM/NIP" 
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-non focus:ring-2 focus:ring-[#FEC01A]">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-non focus:ring-2 focus:ring-[#FEC01A]">
                    </div>
                    <div>
                        <input type="password" name="confirm password" placeholder="Confirm Password" 
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-non focus:ring-2 focus:ring-[#FEC01A]">
                    </div>
                    <div class="w-full px-4 py-2 rounded border border-gray-300 bg-gray-100">
                        <p class="text-gray-400 mb-4">Foto KTM/Kartu Tanda Pegawai</p>
                        <input type="file" name="image" class="text-sm text-black file:mr-5 file:py-2 file:px-6 file:rounded-full file:border-0
                        file:text-sm file:font-medium file:bg-[#FEC01A] file:text-black hover:file:cursor-pointer hover:file:bg-yellow-500 hover:file:text-black">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-[#FEC01A] hover:bg-yellow-500 text-black font-bold py-2 rounded-lg transition">
                            Sign Up
                        </button>
                    </div>
                 </form>
            </div>
        </div>
    </body>
</body>
</html>