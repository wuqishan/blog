<div class="container demo-2" id="home">
    <header>
        <nav class="cd-stretchy-nav">
            <a class="cd-nav-trigger" href="#0">
                <h6>Menu</h6>
                <span aria-hidden="true"></span>
            </a>
            <ul class="side_nav">
                <li><a href="{{ route('index') }}" @if($current == 'index')class="active"@endif><span>Home</span></a></li>
                <li><a href="{{ route('single') }}" @if($current == 'single')class="active"@endif><span>Single</span></a></li>
                <li><a href="{{ route('blog') }}" @if($current == 'blog')class="active"@endif><span>Blog</span></a></li>
                <li><a href="{{ route('gallery') }}" @if($current == 'gallery')class="active"@endif><span>Gallery</span></a></li>
                <li><a href="{{ route('contact') }}" @if($current == 'contact')class="active"@endif><span>Contact</span></a></li>
            </ul>

            <span aria-hidden="true" class="stretchy-nav-bg"></span>
        </nav>
    </header>
    <!--#carbonads-container-->
    <div class="content">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <h1 class="main-title">
                <a class="link link--takiri" href="{{ route('index') }}">Go Easy On<span class="wow fadeInUp animated animated" data-wow-delay=".5s">Where do you want to be?</span></a>
            </h1>
        </div>
    </div>
</div>