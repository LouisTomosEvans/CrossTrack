<div class="d-flex justify-content-end" style="width: 100vw; height: 100vh; background-color: #f05628; background-image: linear-gradient(128deg, #fd7b35, #f95e4e); overflow: hidden; background-size: cover;">
    <div class="hidden md:block fixed left-0 bottom-0 rounded-lg" style="z-index: 1; margin: 0.8rem; background-color: black;">
        <div style="margin: 0.3rem; margin-left: 0.5rem; margin-right: 0.4rem; font-size: 0.65rem; color: #28323b;">
        <span style="color: white">Powered By <a href="https://www.badmoon.io" style="text-decoration: underline; color: white;"><b>Bad Moon</b></a></span>
        </div>
    </div>
    <div class="d-flex col-12 col-md-6 col-xl-4" style="z-index: 1; background-color: white; height: 100vh; overflow-x: hidden; align-items: center; justify-content: center; flex-wrap: wrap; background-size: cover;">
    <div class="d-flex justify-content-center align-self-end" style="width: 35%; padding: 24px; margin-top: 48px;">
            {{ $logo }}
    </div>
        <div class="align-self-start" style="width: 75%; max-width: 550px; margin-bottom: 48px;">
            {{ $slot }}
        </div>
    </div>
</div>
