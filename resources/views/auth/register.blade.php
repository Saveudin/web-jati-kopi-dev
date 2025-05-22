@vite('resources/css/app.css')
<section class="bg-gray-200 flex flex-col items-center justify-center min-h-screen">
<form method="POST" action="/register" class="w-full max-w-sm max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Name</label>
        <input type="text" name="name" required class="text-gray-700 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" required class="text-gray-700 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" required class="text-gray-700 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 mb-2">Confirm Password</label>
        <input type="password" name="password_confirmation" required class="text-gray-700 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Register</button>
</form>
<div class="text-center mt-4">
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Back to Login</a>
</div>
</section>