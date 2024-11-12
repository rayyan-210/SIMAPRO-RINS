<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAPRO</title>
    <link rel="website icon" type="image/jpeg" href="AsetFoto/Login/rins_logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/tailwind.css">
    <script src="js\SIMASTOK.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--navbar-->
    <nav class="bg-red-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <img class="h-8 w-auto" src="AsetFoto/Produk/LOGO_RINS.png" alt="Your Company">
                </div>
                <div class="hidden sm:block">
                    <div class="flex space-x-10">
                        <a href="admin_chart.php" class="text-gray-300 hover:text-amber-300 px-3 py-2 rounded-md text-xl font-medium">Chart</a>
                        <a href="#" class="text-white underline underline-offset-8 px-3 py-2 rounded-md text-xl font-medium" aria-current="page">Catalog</a>
                        <a href="admin_image.php" class="text-gray-300 hover:text-amber-300 px-3 py-2 rounded-md text-xl font-medium">Image</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="home_customer.php">
                        <i class='bx bxs-user-circle text-4xl px-7 text-gray-300 hover:text-amber-300'></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="p-6">
        <div class="grid grid-cols-8 md:grid-cols-4 lg:grid-cols-6 gap-6">

            <!-- Upload Section -->
            <div class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-400 bg-gray-200 rounded-lg h-36 cursor-pointer">
                <div class="text-4xl">⬆️</div>
                <button
                    class="absolute bg-red-600 text-white rounded-full px-3 py-1 transform translate-y-24"
                    onclick="window.location.href='admin_catalog_input.php'">+</button>
            </div>

            <!-- Product Card -->
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmp4mt.png" alt="Product Image" class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>

            <!-- Duplicate Product Cards -->
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmpmt1.png" alt="Product " class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmp4mt.png" alt="Product Image" class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>


            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmpmt1.png" alt="Product " class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>


            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmp4mt.png" alt="Product Image" class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmp4mt.png" alt="Product Image" class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="AsetFoto/Catalog/kmp4mt.png" alt="Product Image" class="w-full h-36 object-cover">
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">
                        ✏️
                    </button>
                    <button
                        class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700"
                        onclick="showdel()">
                        🗑️
                    </button>
                </div>
            </div>

            <!-- Additional Product Cards as needed... -->

        </div>
    </main>
</body>

</html>