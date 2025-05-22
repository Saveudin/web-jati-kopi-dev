@vite('resources/css/app.css')
<section class="bg-gray-200 flex flex-col items-center justify-center min-h-screen">

<form method="POST" action="/login" class="flex flex-col w-full max-w-sm mx-auto mt-10 bg-gray-100 p-8 rounded shadow">
    <img src="{{ asset('/logo.png') }}" class="self-center max-w-32" alt="">
    <span class="text-center text-gray-800 font-bold text-2xl mb-4">
        Informasi penjualan dan persediaan stok barang
    </span>
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" required class="text-gray-800 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" required class="text-gray-800 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
</form>
<div class="text-center mt-4">
    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
</div>

</section>