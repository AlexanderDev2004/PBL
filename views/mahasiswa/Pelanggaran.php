<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggaran</title>
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
    <div id="Pelanggaran" class=" flex justify-center pt-8 ">
        <p class="font-bold text-3xl flex text-center items-center text-[#132145] py-auto pl-64 mb-8 flex flex-col justify-center">Tabel Pelanggaran</p>
    </div>
    <!-- Content End -->

    <!-- Table Start -->
    <div class="bg-white p-6 rounded-lg shadow-md w-11/12 lg:w-3/4 ml-80">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-[#132145] text-sm text-left">
                <thead class="bg-white text-gray-800">
                    <tr>
                        <th class="border border-[#132145] px-4 py-2">No</th>
                        <th class="border border-[#132145] px-4 py-2">Tanggal Pelanggaran</th>
                        <th class="border border-[#132145] px-4 py-2">Deskripsi Pelanggaran</th>
                        <th class="border border-[#132145] px-4 py-2">Tingkat</th>
                        <th class="border border-[#132145] px-4 py-2">Sanksi</th>
                        <th class="border border-[#132145] px-4 py-2">Tanggal Sanksi</th>
                        <th class="border border-[#132145] px-4 py-2">Status Pelanggaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="border border-[#132145] px-4 py-2 text-center">1</td>
                        <td class="border border-[#132145] px-4 py-2">12-11-2024</td>
                        <td class="border border-[#132145] px-4 py-2">Berk komunikasi dengan tidak sopan kepada mahasiswa, dosen, atau karyawan</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">V</td>
                        <td class="border border-[#132145] px-4 py-2">Teguran lisan disertai surat pernyataan bermaterai yang ditandatangani mahasiswa dan DPA</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">12-11-2024</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">Selesai</td>
                    </tr>
                    <tr class="bg-[#F9FAFB]">
                        <td class="border border-[#132145] px-4 py-2 text-center">2</td>
                        <td class="border border-[#132145] px-4 py-2">12-11-2024</td>
                        <td class="border border-[#132145] px-4 py-2">Berbusana tidak sopan dan tidak rapi (misalnya memakai kaos tidak berkerah, rok mini, sandal, dll)</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">IV</td>
                        <td class="border border-[#132145] px-4 py-2">Teguran tertulis, pemanggilan orang tua/wali, serta surat pernyataan tidak mengulangi bermaterai</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">-</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">Belum Selesai</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="border border-[#132145] px-4 py-2 text-center">3</td>
                        <td class="border border-[#132145] px-4 py-2">12-11-2024</td>
                        <td class="border border-[#132145] px-4 py-2">Tidak menjaga kebersihan di seluruh area Polinema</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">III</td>
                        <td class="border border-[#132145] px-4 py-2">Surat pernyataan, tugas khusus seperti membersihkan area tertentu</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">12-11-2024</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">Selesai</td>
                    </tr>
                    <tr class="bg-[#F9FAFB]">
                        <td class="border border-[#132145] px-4 py-2 text-center">4</td>
                        <td class="border border-[#132145] px-4 py-2">12-11-2024</td>
                        <td class="border border-[#132145] px-4 py-2">Mengakses materi pornografi di kelas atau area kampus</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">I</td>
                        <td class="border border-[#132145] px-4 py-2">Penggantian kerugian dan tugas layanan sosial</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">-</td>
                        <td class="border border-[#132145] px-4 py-2 text-center">Belum Selesai</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Table End -->

    <!-- Footer -->
     <?php include "../components/Footer.php"?>
    <!-- Footer End -->
</body>
</html>