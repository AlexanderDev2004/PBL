<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
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
    <!-- Header -->

    <!-- SideBar -->
    <?php include "components/Sidebar.php"?>
    <!-- Sidebar End -->

    <!-- Content -->
    <div id="Beranda" class=" flex justify-center pt-8 ">
        <p class="font-bold text-3xl flex text-center items-center text-[#132145] py-auto pl-64 mb-8 flex flex-col justify-center">Analisis Data Pelanggaran</p>
    </div>

    <!-- Chart -->
    <?php include "../components/Chart.php"?>
    <!-- Chart End -->

    <!-- Footer -->
    <?php include "../components/Footer.php"?>
    <!-- Footer End -->
</body>
</html> 