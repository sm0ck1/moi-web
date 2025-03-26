<footer class="bg-gray-800 text-white mt-8">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">About Us</h3>
                <p class="text-gray-400">
                    A news portal with the most current and interesting news from around the world.
                </p>
            </div>
            <div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Useful Links</h3>
                <ul class="text-gray-400">
                    <li class="mb-2"><a href="/about" class="hover:text-white">About us</a></li>
                    <li class="mb-2"><a href="/privacy" class="hover:text-white">Privacy Policy</a></li>
                    <li class="mb-2"><a href="/terms" class="hover:text-white">Terms of Use</a></li>
                    <li class="mb-2"><a href="/contact" class="hover:text-white">Contacts</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Subscribe</h3>
                <p class="text-gray-400 mb-4">
                    Subscribe to our newsletter to receive the latest news.
                </p>
                <form>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l focus:outline-none text-gray-900">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ $_SERVER['HTTP_HOST'] }}. All rights reserved.</p>
        </div>
    </div>
</footer>
