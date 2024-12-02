<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style type="text/tailwindcss">
        @layer utilities {
        body {
            font-family: "Poppins";
        }
        }
    </style>
</head>
<body class="bg-[#EBEEF5] font-poppins">
    <!-- Header -->
    <?php include "components/Header.php"?>
    <!-- Header End -->

    <!-- Sidebar -->
    <?php include "components/Sidebar.php"?>
    <!-- Sidebar End -->
    
    <!-- Content -->
    <div id="UbahPassword" class=" flex justify-center pt-8 ">
        <p class="font-bold text-3xl flex text-center items-center text-[#132145] py-auto pl-64 mt-8 mb-16 flex flex-col justify-center">Ubah Password</p>
    </div>
    <!-- Content End -->

    <!-- Edit Password -->
    <div class="bg-white p-6 border border-grey-800 rounded-xl shadow-xl w-11/12 lg:w-3/4 ml-80">
        <form action="POST">
            <!-- Password Lama -->
            <div class="mb-4">
                <label for="password-lama" class="block text-[#132145] font-bold mb-2">Password Lama</label>
                <input type="password" id="password-lama" class="w-full border border-blue-400 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" placeholder="********">
            </div>

            <!-- Password Baru -->
            <div class="mb-4">
                <label for="password-baru" class="block text-[#132145] font-bold mb-2">Password Baru</label>
                <input type="password" id="password-baru" class="w-full border border-blue-400 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" placeholder="********">
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="konfirmasi-password" class="block text-[#132145] font-bold mb-2">Konfirmasi Password</label>
                <input type="password" id="konfirmasi-password" class="w-full border border-blue-400 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" placeholder="********">
            </div>
            
            <!-- Tombol Aksi -->
            <div class="flex justify-between w-72">
                <button type="submit" onclick="window.location.href='../loginPage.php'" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                    <i class="fa-solid fa-circle-check"></i>
                    <span class="font-semibold ml-2">Simpan</span>
                </button>
                <button type="button" onclick="window.location.href='Profile.php'" class="bg-[#132145] text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                    <i class="fa-solid fa-arrow-turn-up -rotate-90"></i>
                    <Span class="font-semibold ml-2">Kembali</Span>
                </button>
            </div>
        </form>
    </div>
    <!-- Edit Password End -->
</body>
</html>