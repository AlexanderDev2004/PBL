<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          },
          fontFamily: {
            poppins: ['Poppins', 'sans-serif'],
          }
        }
      }
    }
    </script>
</head>
<body class="bg-[#EBEEF5] scale font-poppins">
    <!-- Header -->
    <?php include "components/Header.php"?>
    <!-- Header End -->

    <!-- SideBar -->
    <?php include "components/Sidebar.php"?>
    <!-- Sidebar End -->

    <!-- Content -->
    <div id="Profile" class=" flex justify-center pt-8 ">
        <p class="font-bold text-3xl flex text-center items-center text-[#132145] py-auto pl-64 mb-8 flex flex-col justify-center">Profil Saya</p>
    </div>
    <!-- Content End -->

    <!-- Profile -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-3/4 ml-80 mt-14">
        <!-- Edit Password -->
        <div class="flex flex-end justify-end">
            <a href="ubahPassword.php" class="w-48 bg-[#132145] text-white py-2 px-4 rounded-md hover:bg-blue-700 flex items-center">
            <i class="fa-solid fa-pen pl-0 pr-2"></i>
            <span class="pl-2">Ubah Password</span>
            </a>
        </div>
        <!-- Edit Button End -->
        <div class="overflow-x-auto grid grid-cols-2 gap-x-0 gap-y-8">
            <div>
                <span class="font-bold text-[#132145]">NIM</span>
                <p>2341720220</p>
            </div>
            <div>
                <span class="font-bold text-[#132145]">Nama Prodi</span>
                <p>DIV Teknik Informatika</p>
            </div>
            <div>
                <span class="font-bold text-[#132145]">Nama</span>
                <p>Fiera Ziadattun Nisa'</p>
            </div>
            <div>
                <span class="font-bold text-[#132145]">Nama Kelas</span>
                <p>2H</p>
            </div>
            <div>
                <span class="font-bold text-[#132145]">Angkatan</span>
                <p>2023</p>
            </div>
            <div>
                <span class="font-bold text-[#132145] ">Status Mahasiswa</span>
                <p>Aktif</p>
            </div>

            <!-- Logout Button -->
            <div class="flex mt-6 ">                
            <a href="../loginPage.php" class="flex flex-row bg-red-500 w-28 text-white py-2  rounded-md hover:bg-red-600 px-auto">
            <img src="../../public/logout.svg" alt="" class="ml-2">
                <span class="ml-4">Keluar</span>
            </a>
            </div>
            <!-- Logout Button End -->
            
        </div>
    </div>
    <!-- Profile End -->

    <!-- Footer -->
    <?php include "../components/Footer.php"?>
    <!-- Footer End -->
</body>
</html>