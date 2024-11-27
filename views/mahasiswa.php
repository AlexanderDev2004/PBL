<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <!-- Navbar -->
        <header class="flex bg-indigo-950 py-3 px-6 fixed w-full z-10 text-white w-full-right">
        <div class="container mx-auto flex px-8 py-2 items-center justify-between">
            <div class="flex flex-wrap text-3xl font-bold text-primary ml-24">SI TT</div>
        </div>

        <!-- User Information -->
        <div class="flex item-end space-x-3">
        <!-- User Icon -->
             <div class="bg-indigo-950 rounded-full p-1 mx-auto relative  lg:right-0">
                 <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <g clip-path="url(#clip0_2_84)">
                 <path d="M25 4.16667C13.5 4.16667 4.16667 13.5 4.16667 25C4.16667 36.5 13.5 45.8333 25 45.8333C36.5 45.8333 45.8333 36.5 45.8333 25C45.8333 13.5 36.5 4.16667 25 4.16667ZM25 10.4167C28.4583 10.4167 31.25 13.2083 31.25 16.6667C31.25 20.125 28.4583 22.9167 25 22.9167C21.5417 22.9167 18.75 20.125 18.75 16.6667C18.75 13.2083 21.5417 10.4167 25 10.4167ZM25 40C19.7917 40 15.1875 37.3333 12.5 33.2917C12.5625 29.1458 20.8333 26.875 25 26.875C29.1458 26.875 37.4375 29.1458 37.5 33.2917C34.8125 37.3333 30.2083 40 25 40Z" fill="white"/>
                 </g>
                 <defs>
                 <clipPath id="clip0_2_84">
                 <rect width="50" height="50" fill="white"/>
                 </clipPath>
                 </defs>
                 </svg>
             </div>
      </div>
      <!-- User Info Text -->
      <div>
        <p class="text-sm font-semibold">Mahasiswa 123</p>
        <p class="text-sm">29827166789</p>
      </div>
    </div>
    </div>
    </header>
    
    <!-- SideBar -->
    <div class="flex pt-16 h-screen">
        <div class="w-64 bg-indigo-950 text-white flex flex-col">
            <div class="p-4 text-xl font-semibold text-center mb-6">
                <img src="../Public/Logo.png" alt="Logo" class="mx-auto w-24 mb-6 ">
                <nav class="flex-1 p-4 space-y-2">
                    <div class="flex items-center space-x-2">
                        <a href="#Dashboard" class="flex items-center p-2 rounded hover:bg-indigo-800">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-wrap">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.27446 10.1262C5 10.7229 5 11.4018 5 12.7595V16.9999C5 18.8856 5 19.8284 5.58579 20.4142C6.11733 20.9457 6.94285 20.9949 8.5 20.9995V16C8.5 14.8954 9.39543 14 10.5 14H13.5C14.6046 14 15.5 14.8954 15.5 16V20.9995C17.0572 20.9949 17.8827 20.9457 18.4142 20.4142C19 19.8284 19 18.8856 19 16.9999V12.7595C19 11.4018 19 10.7229 18.7255 10.1262C18.4511 9.52943 17.9356 9.08763 16.9047 8.20401L15.9047 7.34687C14.0414 5.74974 13.1098 4.95117 12 4.95117C10.8902 4.95117 9.95857 5.74974 8.09525 7.34687L7.09525 8.20401C6.06437 9.08763 5.54892 9.52943 5.27446 10.1262ZM13.5 20.9999V16H10.5V20.9999H13.5Z" fill="white"/>
                        </svg>Dashboard</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="Pelanggaran" class="flex items-center p-2 rounded hover:bg-indigo-800">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21ZM7 13H17V11H7V13Z" fill="white"/>
                        </svg>Pelanggaran</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="Profil" class="flex items-center p-2 rounded hover:bg-indigo-800 mr-px">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 15.0141 20.6665 17.7167 18.5573 19.5501C18.0996 18.3251 17.306 17.2481 16.2613 16.4465C15.0388 15.5085 13.5409 15 12 15C10.4591 15 8.96118 15.5085 7.73867 16.4465C6.69405 17.2481 5.90038 18.3251 5.44269 19.5501C3.33349 17.7167 2 15.0141 2 12ZM16.8296 20.7059C16.8337 20.7212 16.8381 20.7363 16.8429 20.7512C15.4081 21.5469 13.757 22 12 22C10.243 22 8.59193 21.5469 7.15711 20.7512C7.16185 20.7363 7.16628 20.7212 7.17037 20.7059C7.45525 19.6427 8.08297 18.7033 8.95619 18.0332C9.82942 17.3632 10.8993 17 12 17C13.1007 17 14.1706 17.3632 15.0438 18.0332C15.917 18.7033 16.5448 19.6427 16.8296 20.7059ZM10 9C10 7.89543 10.8954 7 12 7C13.1046 7 14 7.89543 14 9C14 10.1046 13.1046 11 12 11C10.8954 11 10 10.1046 10 9ZM12 5C9.79086 5 8 6.79086 8 9C8 11.2091 9.79086 13 12 13C14.2091 13 16 11.2091 16 9C16 6.79086 14.2091 5 12 5Z" fill="white"/>
                        <rect x="2.5" y="2.5" width="19" height="19" rx="9.5" stroke="white"/>
                        </svg> Profil Saya</a>
                </nav>
            </div>
        </div>
        <!-- Dashboard -->
        <div id="Dashboard" class="flex-1 flex items-start justify-center pt-8">
            <p class="font-bold text-3xl text-center text-indigo-950 ">Tata Tertib Kehidupan Kampus</p>
            </div>
            <div class="bg-grey-500 h-screen flex justify-center items-center">
                <div class="border-2 bg-grey-200">

                </div>
            </div>

        </div>
    </div>
</body>
</html>