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
    <header class="w-full max-w-screen-xl h-24 bg-[#132145] text-white flex flex-col items-center py-6 transform translate-x-64">
        <div class="container mx-auto flex px-8 py-2 items-center justify-between">
            <div class="flex items-center justify-between py-[-6] text-4xl font-bold text-primary ml-0"><span class="text-yellow-400">Reg</span>IT</div>
        </div>

        <!-- User Information -->
        <div class="flex-col self-end space-x-3 px-8">
        <!-- User Icon -->
             <div class="bg-indigo-950 rounded-full p-1 my-[-4] relative mr-32">
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
      <div class = "flex-col self-end space-x-3 px-8">
        <p class="text-black font-semibold">Mahasiswa 123</p>
        <p class="text-black">29827166789</p>
      </div>
    </div>
    </div>
    </header>
    <!-- Navbar End -->

    <!-- SideBar -->
    <div class="flex">
        <div class="w-64 h-screen bg-[#132145] text-white flex flex-col items-center py-6 absolute top-[-20px]">
            <div class="mb-6">
                <div class="w-20 h-20 flex items-center justify-center rounded-lg mt-6">
                    <img src="../Public/LogoSide.png" alt="logo" class="w-20 h-20 object-contain">
                </div>
            </div>
            <nav class="w-full">
                <a href="#" class="flex items-center gap-3 px-6 py-3 mb-2 bg-[#FEC01A] rounded-lg text-white rounded-lg text-sm font-bold hover:bg-yellow-600">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="bg-white rounded-full">
                    <g clip-path="url(#clip0_6_8345)">
                    <path d="M11 15H13V17H11V15ZM11 7H13V13H11V7ZM11.99 2C6.47 2 2 6.48 2 12C2 17.52 6.47 22 11.99 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 11.99 2ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20Z" fill="#323232"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_6_8345">
                    <rect width="24" height="24" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>
                    <span class="">Informasi</span>                   
                </a>
            </nav>
        </div>
    </div>
</body>
</html>