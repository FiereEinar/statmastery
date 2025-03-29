<footer class="footer sm:footer-horizontal bg-base-content text-base-300 p-10">
    <aside>
        <img class="w-14 rounded-full" src="{{ asset('images/app-logo.jpg') }}" alt="Logo">
        <p>
            Stat<span class="text-blue-500">Mastery</span>
            <br />
            Teaching mathematics since <span class="text-blue-500">1992</span>
        </p>
        <div>
            <div class="space-x-2">
                <a href="#">
                    <x-button sm outline primary label="Browse Courses" />
                </a>
                @auth
                @else
                <a href="/signup">
                    <x-button sm primary label="Sign Up Now" />
                </a>
                @endauth
            </div>
        </div>
    </aside>
    <nav>
      <h6 class="footer-title">Services</h6>
      <a class="link link-hover">Branding</a>
      <a class="link link-hover">Design</a>
      <a class="link link-hover">Marketing</a>
      <a class="link link-hover">Advertisement</a>
    </nav>
    <nav>
      <h6 class="footer-title">Company</h6>
      <a class="link link-hover">About us</a>
      <a class="link link-hover">Contact</a>
      <a class="link link-hover">Jobs</a>
      <a class="link link-hover">Press kit</a>
    </nav>
    <nav>
      <h6 class="footer-title">Legal</h6>
      <a class="link link-hover">Terms of use</a>
      <a class="link link-hover">Privacy policy</a>
      <a class="link link-hover">Cookie policy</a>
    </nav>
  </footer>